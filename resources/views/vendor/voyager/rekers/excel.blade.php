<?php 

    use App\Models\Hris\MS_Department;
    use App\Models\Hris\MS_Karyawan;
    use App\Models\Reker\Reker;
    use App\Models\Reker\RekerDepartment;
    use App\Models\Reker\RekerPic;

    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=laporan_berkaitan_".date("YmdHis").".xls");  //File name extension was wrong
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);

    $objReker = new Reker;
    $objDepartment = new MS_Department;

?>

<table border="1px">
    <thead>
        <tr>
            <th>Periode</th>
            <th>Departemen</th>
            <th>Kategori</th>
            <th>Objective</th>
            <th>Target</th>
            <th>Q1</th>
            <th>Q2</th>
            <th>Q3</th>
            <th>Q4</th>
            <th>Department Terkait</th>
            <th>PIC Terkait</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($rekers as $key => $item)
            <tr>
                <td> {{ $item->periode_from }} s/d {{ $item->periode_until }} </td>
                <td> {{ $objDepartment->detail(['KodeSeksi' => $item->department_id])->namaSeksi }} </td>
                <td>
                    @if($item->category_id == 1)
                        Internal Business Process
                    @else
                        Learning & Growth
                    @endif
                </td>
                <td> {{ $item->objective }} </td>
                <td> {{ $item->target }} </td>
                <td> {{ $item->q1 }} </td>
                <td> {{ $item->q2 }} </td>
                <td> {{ $item->q3 }} </td>
                <td> {{ $item->q4 }} </td>
                <td>  
                    @php
                        $objTrxDepart = new RekerDepartment();

                        $details = $objTrxDepart->where('id', $item->id)->get();

                        $return_str = "";
                        foreach ($details as $key => $value) 
                        {
                            $objDepart = new MS_Department;
                            $depart = $objDepart->table()->where("KodeSeksi", $value->department_id)->first();

                            if( !empty(app('request')->input('department_id')) )
                            {
                                if( in_array($value->department_id, app('request')->input('department_id')) )
                                {
                                    $return_str .= "<strong> $depart->namaSeksi </strong>";
                                }else{
                                    $return_str .= $depart->namaSeksi;
                                }
                            }else{
                                $return_str .= $depart->namaSeksi;
                            }

                            if( ($key+1) != count($details) ){
                                $return_str .= ", ";
                            }
                        }

                        echo $return_str;
                    @endphp     
                </td>
                <td>  
                    @php
                        $objTrxPic = new RekerPic();

                        $details = $objTrxPic->where('id', $item->id)->get();

                        $return_str = "";
                        foreach ($details as $key => $value) 
                        {
                            $objEmp = new MS_Karyawan;
                            $employee = $objEmp->table()->where("NIK", $value->nik)->first();

                            if( !empty(app('request')->input('nik')) )
                            {
                                if( in_array($employee->NIK, app('request')->input('nik')) )
                                {
                                    $return_str .= "<strong> $employee->namaKaryawan </strong>";
                                }else{
                                    $return_str .= $employee->namaKaryawan;
                                }
                            }else{
                                $return_str .= $employee->namaKaryawan;
                            }

                            if( ($key+1) != count($details) ){
                                $return_str .= ", ";
                            }
                        }

                        echo $return_str;
                    @endphp 
                </td>
            </tr>
        @endforeach
    </tbody>
</table>