@php 
    use App\Models\Hris\MS_Department;

    if( isset($dataTypeContent->{$row->field}) ){
        $department_selected = old($row->field, $dataTypeContent->{$row->field});
    }else{
        $department_selected = old($row->field);
    }

    $departments = new MS_Department;
    $departments = $departments->table()->where('KodeSeksi', '!=', '_mgr_')->orderBy('namaSeksi')->get();
@endphp

<select data-live-search="true" class="form-control selectpicker" name="{{ $row->field }}" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
    @foreach( $departments as $dep )
    <option value="{{ $dep->KodeSeksi }}" {{ $department_selected == $dep->KodeSeksi ? 'selected' : '' }}> 
        {{ $dep->namaSeksi }} 
    </option>
    @endforeach
</select>