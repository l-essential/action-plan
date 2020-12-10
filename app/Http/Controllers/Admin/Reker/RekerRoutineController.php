<?php

namespace App\Http\Controllers\Admin\Reker;

use DB;
use Auth;
use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Karyawan;
use App\Models\Reker\RekerRoutine;
use App\Models\Reker\RekerRoutineDepartment;
use App\Models\Reker\RekerPeriode;
use App\Models\Reker\RekerRoutinePic;
use Illuminate\Http\Request;

class RekerRoutineController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{

    public function detail_card($id)
    {
        # object
        $objTrx = new RekerRoutine();
        $objTrxPer = new RekerPeriode();
        $objDepart = new MS_Department();

        # param
        $periode_id = $id;
        $department_id = app('request')->input('department_id');
        $periode_from = app('request')->input('periode_from');
        $periode_until = app('request')->input('periode_until');
        $data['department_id'] = $department_id;

        if( !empty($periode_from) && !empty($periode_until) )
        {
            $query_periode = $objTrxPer->where('periode_from', $periode_from)
                                ->where('periode_until', $periode_until)
                                ->first();
            if( !empty($query_periode) ){
                $periode_id = $query_periode->id;
            }
        }

        $query = $objTrx->where('periode_id', $periode_id)
                    ->where('department_id', $department_id);

        $data['cards'] = $query->get();

        if( count($data['cards']) == 0 ){
            return abort(404);
        }

        # pecah 
        $data['card_cat1'] = [];
        $data['card_cat2'] = [];
        $data['card_cat3'] = [];
        foreach ($data['cards'] as $key => $value) 
        {
            $data['card_cat'. $value->category_id][] = $value;
        }

        $data['ms_periode'] = $objTrxPer->find($periode_id);

        return view('vendor/voyager/reker-routines.detail_card')->with($data);
    }

    public function index(Request $request)
    {
        # param 
        $data = [];

        $objTrx = new RekerRoutine();
        $objTrxPer = new RekerPeriode();

        $query = $objTrxPer->orderBy('periode_from', 'asc')
                            ->orderBy('periode_until', 'asc')
                            ->get();

        $data['periodes'] = $query;

        if( app('request')->input('mode_view') == 'card' )
        {
            $query = DB::table($objTrx->getTable() . " AS r")
                        ->leftJoin($objTrxPer->getTable() . " AS p", "p.id", "=", "r.periode_id");
        }
        else 
        {
            $query = DB::table($objTrx->getTable() . " AS r")
                    ->select('r.*', 'p.periode_from', 'p.periode_until')
                    ->orderBy('p.periode_from', 'asc')
                    ->orderBy('p.periode_until', 'asc')
                    ->orderBy('r.department_id', 'asc')
                    ->leftJoin($objTrxPer->getTable() . " AS p", "p.id", "=", "r.periode_id");
        }

        if( !empty($request->input('periode')) ){
            $query->where('r.periode_id', $request->input('periode'));
        }

        if( \ModelInit::canIAccess('browse_all_'.$objTrx->getTable()) )
        {
            if( !empty($request->input('department_id')) ){
                $query->where('r.department_id', $request->input('department_id'));
            }
        }else{
            $my_employee = new MS_Karyawan();
            $query->where('r.department_id', $my_employee->myData()->KodeSeksi);
        }

        $data['rekers'] = $query->get();

        return view('vendor/voyager/reker-routines.browse')->with($data);
    }

    public function store(Request $request)
    {
        # tangkap input 
        $input = $this->_getInput('store', $request);

        # simpan 
        DB::transaction(function() use ($input)
        {
            $objRekerRoutine = new RekerRoutine();
            $objRekerRoutinePic = new RekerRoutinePic();
            $objRekerRoutineDepart = new RekerRoutineDepartment();

            $objRekerRoutine->insert($input['input']);
            $objRekerRoutineDepart->insert($input['department']);
            $objRekerRoutinePic->insert($input['pic']);
        });
        
        $message = ['alert-type' => 'success', "message" => "Berhasil simpan data program kegiatan rutin"];
        return redirect('admin/reker-routines')->with($message);
    }

    public function update(Request $request, $id)
    {
        # tangkap input 
        $input = $this->_getInput('update', $request, $id);

        # object
        $objRekerRoutine = new RekerRoutine();
        $objRekerRoutinePic = new RekerRoutinePic();
        $objRekerRoutineDepart = new RekerRoutineDepartment();

        # ambil data header
        $card = $objRekerRoutine->find($id);

        if( $objRekerRoutine->canIEdit($card) !== True )
        {
            $message = ['alert-type' => 'error', "message" => "Anda tidak memiliki hak akses untuk memperbarui data ini"];
            return redirect()->back()->with($message);
        }

        # simpan 
        DB::transaction(function() use ($input, $id)
        {
            $objRekerRoutine = new RekerRoutine();
            $objRekerRoutinePic = new RekerRoutinePic();
            $objRekerRoutineDepart = new RekerRoutineDepartment();

            $objRekerRoutine->where('id', $id)->update($input['input']);

            $objRekerRoutineDepart->where('id', $id)->delete();
            $objRekerRoutineDepart->insert($input['department']);

            $objRekerRoutinePic->where('id', $id)->delete();
            $objRekerRoutinePic->insert($input['pic']);
        });
        
        $message = ['alert-type' => 'success', "message" => "Berhasil perbarui data program kegiatan rutin"];
        return redirect()->back()->with($message);
    }

    private function _getInput($event = 'store', $req, $id = '')
    {
        $objRekerRoutine = new RekerRoutine();
        $objDepart = new MS_Department();

        if( $event == 'store' )
        {
            $input['id'] = $objRekerRoutine->primaryKeyInc();
            $input['created_by'] = Auth::user()->id;
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['department_id'] = !empty( $objDepart->getDepartByNik( Auth::user()->nik )->KodeSeksi) 
                        ? $objDepart->getDepartByNik( Auth::user()->nik )->KodeSeksi : '';
        }else{
            $input['id'] = $id;
            $input['updated_at'] = date('Y-m-d H:i:s');
        }

        $input['category_id'] = trim( $req->input('category_id') );
        $input['objective'] = trim( $req->input('objective') );
        $input['target'] = trim( $req->input('target') );
        $input['m1'] = trim( $req->input('m1') );
        $input['m2'] = trim( $req->input('m2') );
        $input['m3'] = trim( $req->input('m3') );
        $input['m4'] = trim( $req->input('m4') );
        $input['m5'] = trim( $req->input('m5') );
        $input['m6'] = trim( $req->input('m6') );
        $input['m7'] = trim( $req->input('m7') );
        $input['m8'] = trim( $req->input('m8') );
        $input['m9'] = trim( $req->input('m9') );
        $input['m10'] = trim( $req->input('m10') );
        $input['m11'] = trim( $req->input('m11') );
        $input['m12'] = trim( $req->input('m12') );
        $input['periode_id'] = trim( $req->input('periode_id') );
        $input['description'] = trim( $req->input('description') );

        $department = [];
        $pic_department = $req->input('pic_department');
        foreach ($pic_department as $k => $v) 
        {
            $department[] = [
                'id' => $input['id'],
                'id_department' => ( $k+1 ),
                'department_id' => $v
            ];
        }

        $pic = [];
        $pic_pic = $req->input('pic');
        foreach ($pic_pic as $k => $v) 
        {
            $pic[] = [
                'id' => $input['id'],
                'id_pic' => ( $k+1 ),
                'nik' => $v
            ];
        }

        return ['input' => $input, 'department' => $department, 'pic' => $pic];
    }

}