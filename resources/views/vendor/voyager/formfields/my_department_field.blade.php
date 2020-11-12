@php
    use App\Models\Hris\MS_Department;

    $objDepart = new MS_Department;
    $depart = $objDepart->getDepartByNik( Auth::user()->nik );

    $val = $dataTypeContent->department_id;
    $val = !empty($val) ? $val : $depart->namaSeksi;
@endphp
<input type="hidden" value="{{ $depart->KodeSeksi }}" name="department_id">
<input type="text" class="form-control" value="{{ $val }}" readonly="readonly">