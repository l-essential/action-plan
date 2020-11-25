@php 
    use App\Models\Hris\MS_Karyawan;

    $employees = new MS_Karyawan;
    $employees = $employees->table()->whereRaw('tglPengunduranDiri IS NULL')->orderBy('namaKaryawan')->get();

    use App\Models\Hris\MS_Department;
    use App\Voyager\DepartmentField;
    use App\Models\Reker\Reker;
    use App\Models\Reker\RekerDepartment;
    use App\Models\Reker\RekerPic;

    $objReker = new Reker;
    $objDepartment = new MS_Department();
    $departments = $objDepartment->table()->orderBy('namaSeksi')->get();
@endphp

@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') .' Program Kegiatan')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title" style="display: block; text-align:center;">
            <i class=""></i> Program Kegiatan :: Laporan Berkaitan
        </h1>
    </div>
@stop

@section('content')

<style>
    .vertical-td {
        font-weight: 700;
        width: 150px;
    }
    .bg-orange {
        background: #ffe0a8;
    }
    .bg-orange-young {
        background: #fff4df;
    }

    .bg-orange-senior {
        background: #22a7f0 !important;
        color: #fff !important;
    }
</style>

    <div class="page-content browse container-fluid">
        @include('voyager::alerts')

        <div class="row">
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <form action="" target="_blank" method="GET">
                            @csrf
                        {{-- <div class="row">
                            <div class="col-12 col-sm-3"> --}}

                                <div class="form-group">
                                    <label for=""> <em> Periode </em> </label>

                                    <select name="periode" class="form-control selectpicker" data-live-search="true">
                                        <option value=""> -- Pilih -- </option>
                                        @foreach ($periodes as $kp => $vp)
                                            @php
                                                $val = $vp->periode_from." s/d ".$vp->periode_until;

                                                $selected = ($vp->id == app('request')->input('periode'))
                                                            ? 'selected' : '';
                                            @endphp
                                            <option value="{{ $vp->id }}" {{ $selected }}>
                                                {{ $val }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">
                                        <strong> Departemen Terkait </strong>
                                    </label>

                                    @php
                                        if(!empty(app('request')->input('nik'))){
                                            $department_selected = app('request')->input('department_id');
                                        }else{
                                            $department_selected = [];
                                        }
                                    @endphp
                            
                                    <select data-live-search="true" class="form-control select2" multiple name="department_id[]" data-name="Departemen">
                                        <option value=""> -- Pilih -- </option>
                                        @foreach( $departments as $dept )
                                        <option value="{{ $dept->KodeSeksi }}" {{ in_array($dept->KodeSeksi, $department_selected) ? 'selected' : '' }}> 
                                            {{ $dept->namaSeksi }} 
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">
                                        <strong> PIC Terkait </strong>
                                    </label>

                                    @php
                                        if(!empty(app('request')->input('nik'))){
                                            $employee_selected = app('request')->input('nik');
                                        }else{
                                            $employee_selected = [];
                                        }
                                    @endphp
                            
                                    <select data-live-search="true" class="form-control select2" multiple name="nik[]" data-name="NIK">
                                        <option value=""> -- Pilih -- </option>
                                        @foreach( $employees as $emp )
                                        <option value="{{ $emp->NIK }}" {{ in_array($emp->NIK, $employee_selected) ? 'selected' : '' }}> 
                                            {{ $emp->namaKaryawan }} 
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                            {{-- </div>
                        </div> --}}

                            <button type="submit" name="submit" value="submit" class="btn btn-primary">
                                Buat Laporan
                            </button>

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-sm-4">

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">

    <style>
        #div-filter {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }
    </style>
@stop

@section('javascript')
    <!-- DataTables -->
    <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    <script>
        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = 'rekers/delete/__id'.replace('__id', $(this).data('id'));
            $('#delete_modal').modal('show');
        });

        $('input[name="row_id"]').on('change', function () {
            var ids = [];
            $('input[name="row_id"]').each(function() {
                if ($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            $('.selected_ids').val(ids);
        });
    </script>
@stop
