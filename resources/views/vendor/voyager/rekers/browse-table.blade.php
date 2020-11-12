@php 
    use App\Models\Hris\MS_Department;
    use App\Models\Hris\MS_Karyawan;
    use App\Voyager\DepartmentField;
    use App\Models\Reker\Reker;
    use App\Models\Reker\RekerDepartment;
    use App\Models\Reker\RekerPic;

    $objReker = new Reker;
    $objDepartment = new MS_Department();
@endphp

<div class="table-responsive">
    <table id="dataTable" class="table table-hover">
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
                <th>Departemen Terkait</th>
                <th>PIC Terkait</th>
                <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
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
                                $return_str .= $depart->namaSeksi;

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
                                $return_str .= $employee->namaKaryawan;

                                if( ($key+1) != count($details) ){
                                    $return_str .= ", ";
                                }
                            }

                            echo $return_str;
                        @endphp 
                    </td>
                    <td>
                        <a href="{{ url("admin/rekers/". $item->id) }}" class="btn btn-sm btn-warning">
                            <i class="voyager-eye"></i> Lihat
                        </a>

                        @if( $objReker->canIEdit($item) )
                        <a href="{{ url("admin/rekers/". $item->id . "/edit") }}" class="btn btn-sm btn-primary">
                            <i class="voyager-edit"></i> Ubah
                        </a>
                        @endif

                        @if( $objReker->canIDelete($item) )
                        <a href="javascript:void(0);" title="Hapus" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}" id="delete-reker-{{ $item->id }}">
                            <i class="voyager-trash"></i> 
                            <span class="hidden-xs hidden-sm">Hapus</span>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
