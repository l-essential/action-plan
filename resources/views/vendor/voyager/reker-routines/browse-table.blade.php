@php 
    use App\Models\Hris\MS_Department;
    use App\Models\Hris\MS_Karyawan;
    use App\Voyager\DepartmentField;
    use App\Models\Reker\RekerRoutine;
    use App\Models\Reker\RekerRoutineDepartment;
    use App\Models\Reker\RekerRoutinePic;

    $objReker = new RekerRoutine();
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
                <th>M1</th>
                <th>M2</th>
                <th>M3</th>
                <th>M4</th>
                <th>M5</th>
                <th>M6</th>
                <th>M7</th>
                <th>M8</th>
                <th>M9</th>
                <th>M10</th>
                <th>M11</th>
                <th>M12</th>
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
                        @elseif($item->category_id == 2)
                            Learning & Growth
                        @else
                            Customer & Market
                        @endif
                    </td>
                    <td> {{ $item->objective }} </td>
                    <td> {{ $item->target }} </td>
                    <td> {{ $item->m1 }} </td>
                    <td> {{ $item->m2 }} </td>
                    <td> {{ $item->m3 }} </td>
                    <td> {{ $item->m4 }} </td>
                    <td> {{ $item->m5 }} </td>
                    <td> {{ $item->m6 }} </td>
                    <td> {{ $item->m7 }} </td>
                    <td> {{ $item->m8 }} </td>
                    <td> {{ $item->m9 }} </td>
                    <td> {{ $item->m10 }} </td>
                    <td> {{ $item->m11 }} </td>
                    <td> {{ $item->m12 }} </td>
                    <td>  
                        @php
                            $objTrxDepart = new RekerRoutineDepartment();

                            $details = $objTrxDepart->where('id', $item->id)->get();

                            $return_str = "";
                            foreach ($details as $key => $value) 
                            {
                                $objDepart = new MS_Department;
                                $depart = $objDepart->table()->where("KodeSeksi", $value->department_id)->first();
                                $return_str .= $depart->singkatan;

                                if( ($key+1) != count($details) ){
                                    $return_str .= ", ";
                                }
                            }

                            echo $return_str;
                        @endphp     
                    </td>
                    <td>  
                        @php
                            $objTrxPic = new RekerRoutinePic();

                            $details = $objTrxPic->where('id', $item->id)->get();

                            $return_str = "";
                            foreach ($details as $key => $value) 
                            {
                                $objEmp = new MS_Karyawan;
                                $employee = $objEmp->table()->where("NIK", $value->nik)->first();
                                $return_str .= !empty($employee->inisial) ? $employee->inisial : $employee->namaKaryawan;

                                if( ($key+1) != count($details) ){
                                    $return_str .= ", ";
                                }
                            }

                            echo $return_str;
                        @endphp 
                    </td>
                    <td>
                        <a href="{{ url("admin/reker-routines/". $item->id) }}" class="btn btn-sm btn-warning">
                            <i class="voyager-eye"></i> Lihat
                        </a>

                        @if( $objReker->canIEdit($item) )
                        <a href="{{ url("admin/reker-routines/". $item->id . "/edit") }}" class="btn btn-sm btn-primary">
                            <i class="voyager-edit"></i> Ubah
                        </a>
                        @endif

                        @if( $objReker->canIDelete($item) )
                        <a href="javascript:void(0);" title="Hapus" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}" id="delete-reker-routine-{{ $item->id }}">
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
