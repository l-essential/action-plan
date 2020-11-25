@php 
    use App\Models\Hris\MS_Jabatan;

    if( isset($dataTypeContent->{$row->field}) ){
        $level_selected = old($row->field, $dataTypeContent->{$row->field});
    }else{
        $level_selected = old($row->field);
    }

    $jabatans = new MS_Jabatan;
    $jabatans = $jabatans->table()->orderBy('namaJabatan')->get();
@endphp

<select data-live-search="true" class="form-control selectpicker" name="{{ $row->field }}" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
    <option value=""> -- Pilih -- </option>
    @foreach( $jabatans as $dep )
    <option value="{{ $dep->kodeJabatan }}" {{ $level_selected == $dep->kodeJabatan ? 'selected' : '' }}> 
        {{ $dep->namaJabatan }} 
    </option>
    @endforeach
</select>