@php 
    use App\Models\Hris\Tbl_Level;

    if( isset($dataTypeContent->{$row->field}) ){
        $level_selected = old($row->field, $dataTypeContent->{$row->field});
    }else{
        $level_selected = old($row->field);
    }

    $levels = new Tbl_Level;
    $levels = $levels->table()->orderBy('nama_level')->get();
@endphp

<select data-live-search="true" class="form-control selectpicker" name="{{ $row->field }}" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
    <option value=""> -- Pilih -- </option>
    @foreach( $levels as $dep )
    <option value="{{ $dep->kode_level }}" {{ $level_selected == $dep->kode_level ? 'selected' : '' }}> 
        {{ $dep->nama_level }} 
    </option>
    @endforeach
</select>