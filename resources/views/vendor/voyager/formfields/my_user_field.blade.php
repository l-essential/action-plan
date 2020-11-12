@php
    $val = $dataTypeContent->created_by;
    $val = !empty($val) ? $val : Auth::user()->name;
@endphp
<input type="hidden" value="{{ Auth::user()->id }}" name="created_by">
<input type="text" class="form-control" value="{{ $val }}" readonly="readonly">