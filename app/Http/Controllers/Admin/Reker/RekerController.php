<?php

namespace App\Http\Controllers\Admin\Reker;

use DB;
use Auth;
use App\Models\Hris\MS_Department;
use App\Models\Hris\MS_Karyawan;
use App\Models\Reker\Reker;
use App\Models\Reker\RekerDepartment;
use App\Models\Reker\RekerPeriode;
use App\Models\Reker\RekerPic;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class RekerController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    
    public function detail_card($id)
    {
        # object
        $objTrx = new Reker();
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
        foreach ($data['cards'] as $key => $value) 
        {
            if($value->category_id == 1){
                $data['card_cat1'][] = $value;
            }else{
                $data['card_cat2'][] = $value;
            }
        }

        $data['ms_periode'] = $objTrxPer->find($periode_id);

        return view('vendor/voyager/rekers.detail_card')->with($data);
    }

    public function delete(Request $request, $id)
    {
        # object
        $objReker = new Reker();
        $objRekerPic = new RekerPic();
        $objRekerDepart = new RekerDepartment();

        # ambil data header
        $card = $objReker->find($id);

        if( $objReker->canIDelete($card) !== True )
        {
            $message = ['alert-type' => 'error', "message" => "Anda tidak memiliki hak akses untuk menghapus data ini"];
            return redirect()->back()->with($message);
        }

        # simpan 
        DB::transaction(function() use ($id)
        {
            $objReker = new Reker();
            $objRekerPic = new RekerPic();
            $objRekerDepart = new RekerDepartment();

            $objReker->where('id', $id)->delete();
            $objRekerPic->where('id', $id)->delete();
            $objRekerDepart->where('id', $id)->delete();
        });
        
        $message = ['alert-type' => 'success', "message" => "Berhasil menghapus data program kegiatan"];
        return redirect()->back()->with($message);
    }

    public function index(Request $request)
    {
        # param 
        $data = [];

        $objTrx = new Reker();
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

        return view('vendor/voyager/rekers.browse')->with($data);
    }

    public function store(Request $request)
    {
        # tangkap input 
        $input = $this->_getInput('store', $request);

        # simpan 
        DB::transaction(function() use ($input)
        {
            $objReker = new Reker();
            $objRekerPic = new RekerPic();
            $objRekerDepart = new RekerDepartment();

            $objReker->insert($input['input']);
            $objRekerDepart->insert($input['department']);
            $objRekerPic->insert($input['pic']);
        });
        
        $message = ['alert-type' => 'success', "message" => "Berhasil simpan data program kegiatan"];
        return redirect('admin/rekers')->with($message);
    }

    public function update(Request $request, $id)
    {
        # tangkap input 
        $input = $this->_getInput('update', $request, $id);

        # object
        $objReker = new Reker();
        $objRekerPic = new RekerPic();
        $objRekerDepart = new RekerDepartment();

        # ambil data header
        $card = $objReker->find($id);

        if( $objReker->canIEdit($card) !== True )
        {
            $message = ['alert-type' => 'error', "message" => "Anda tidak memiliki hak akses untuk memperbarui data ini"];
            return redirect()->back()->with($message);
        }

        # simpan 
        DB::transaction(function() use ($input, $id)
        {
            $objReker = new Reker();
            $objRekerPic = new RekerPic();
            $objRekerDepart = new RekerDepartment();

            $objReker->where('id', $id)->update($input['input']);

            $objRekerDepart->where('id', $id)->delete();
            $objRekerDepart->insert($input['department']);

            $objRekerPic->where('id', $id)->delete();
            $objRekerPic->insert($input['pic']);
        });
        
        $message = ['alert-type' => 'success', "message" => "Berhasil perbarui data program kegiatan"];
        return redirect()->back()->with($message);
    }

    private function _getInput($event = 'store', $req, $id = '')
    {
        $objReker = new Reker();
        $objDepart = new MS_Department();

        if( $event == 'store' )
        {
            $input['id'] = $objReker->primaryKeyInc();
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
        $input['q1'] = trim( $req->input('q1') );
        $input['q2'] = trim( $req->input('q2') );
        $input['q3'] = trim( $req->input('q3') );
        $input['q4'] = trim( $req->input('q4') );
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

    public function rpt_key()
    {
        $data = [];

        $request = app('request');
        $objTrx = new Reker();
        $objTrxPer = new RekerPeriode();
        $objTrxDept = new RekerDepartment();
        $objTrxPic = new RekerPic();

        $query = $objTrxPer->orderBy('periode_from', 'asc')
                            ->orderBy('periode_until', 'asc')
                            ->get();

        $data['periodes'] = $query;

        if( !empty(app('request')->input('submit')) )
        {
            $query = DB::table($objTrx->getTable() . " AS r")
                    ->select('r.*', 'p.periode_from', 'p.periode_until')
                    ->orderBy('p.periode_from', 'asc')
                    ->orderBy('p.periode_until', 'asc')
                    ->orderBy('r.department_id', 'asc')
                    ->leftJoin($objTrxPer->getTable() . " AS p", "p.id", "=", "r.periode_id");

            $ids = [];

            if( !empty($request->input('department_id')) )
            {
                $aku_lelah = $objTrxDept->whereIn('department_id', $request->input('department_id'))->get();
                foreach ($aku_lelah as $key => $value) 
                {
                    $ids[] = $value->id;
                }
            }

            if( !empty($request->input('nik')) )
            {
                $aku_lelah = $objTrxPic->whereIn('nik', $request->input('nik'))->get();
                foreach ($aku_lelah as $key => $value) 
                {
                    $ids[] = $value->id;
                }
            }

            if(!empty($ids)){
                $query->whereIn('r.id', $ids);
            }
    
            if( !empty($request->input('periode')) ){
                $query->where('r.periode_id', $request->input('periode'));
            }
    
            $data['rekers'] = $query->get();

            return view('vendor/voyager/rekers.excel')->with($data);
        }

        return view('vendor/voyager/rekers.rpt_key')->with($data);
    }

}