@php 
    use App\Models\Hris\MS_Division;

    if( isset($dataTypeContent->{$row->field}) ){
        $division_selected = old($row->field, $dataTypeContent->{$row->field});
    }else{
        $division_selected = old($row->field);
    }

    $divisions = new MS_Division;
    $divisions = $divisions->table()->where('kodeDepartment', '!=', '_mgr_')->orderBy('namaDepartment')->get();
@endphp

<select data-live-search="true" class="form-control selectpicker" name="{{ $row->field }}" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
    <option value=""> -- Pilih -- </option>
    @foreach( $divisions as $dep )
    <option value="{{ $dep->kodeDepartment }}" {{ $division_selected == $dep->kodeDepartment ? 'selected' : '' }}> 
        {{ $dep->namaDepartment }} 
    </option>
    @endforeach
</select>