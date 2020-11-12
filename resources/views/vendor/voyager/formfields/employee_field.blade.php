@php 
    use App\Models\Hris\MS_Karyawan;
    use App\Models\Reker\RekerPic;

    // if( isset($dataTypeContent->{$row->field}) ){
    //     $department_selected = old($row->field, $dataTypeContent->{$row->field});
    // }else{
    //     $department_selected = old($row->field);
    // }

    $employee_selected = [];

    $employees = new MS_Karyawan;
    $employees = $employees->table()->whereRaw('tglPengunduranDiri IS NULL')->orderBy('namaKaryawan')->get();
@endphp

@if( !empty($options->multiple) && $options->multiple == "Y" )

    @php
        if(!empty($options->data_source) && $options->data_source == "reker")
        {
            $objReker = new RekerPic();
            $details  = $objReker->where('id', $dataTypeContent->id)->get();
            foreach ($details as $key => $value) {
                $employee_selected[] = $value->nik;
            }
        }
    @endphp

    <select data-live-search="true" class="form-control select2" multiple name="{{ $row->field }}[]" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
        <option value=""> -- Pilih -- </option>
        @foreach( $employees as $emp )
        <option value="{{ $emp->NIK }}" {{ in_array($emp->NIK, $employee_selected) ? 'selected' : '' }}> 
            {{ $emp->namaKaryawan }} 
        </option>
        @endforeach
    </select>

@else

    <select data-live-search="true" class="form-control selectpicker" name="{{ $row->field }}" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
        <option value=""> -- Pilih -- </option>
        @foreach( $employees as $emp )
        <option value="{{ $emp->NIK }}" {{ $employee_selected == $emp->NIK ? 'selected' : '' }}> 
            {{ $emp->namaKaryawan }} 
        </option>
        @endforeach
    </select>

@endif