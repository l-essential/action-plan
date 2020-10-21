@php 
    use App\Models\Hris\MS_Section;

    if( isset($dataTypeContent->{$row->field}) ){
        $section_selected = old($row->field, $dataTypeContent->{$row->field});
    }else{
        $section_selected = old($row->field);
    }

    $sections = new MS_Section;
    $sections = $sections->table()->where('kodeDivisi', '!=', '_mgr_')->orderBy('namaDivisi')->get();
@endphp

<select data-live-search="true" class="form-control selectpicker" name="{{ $row->field }}" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
    @foreach( $sections as $dep )
    <option value="{{ $dep->kodeDivisi }}" {{ $section_selected == $dep->kodeDivisi ? 'selected' : '' }}> 
        {{ $dep->namaDivisi }} 
    </option>
    @endforeach
</select>