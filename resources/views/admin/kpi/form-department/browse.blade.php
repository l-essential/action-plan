@php 
    use App\Models\Kpi\KpiTrxDepartment;
    use App\Models\Hris\MS_Department;
    use App\Models\Hris\MS_Karyawan;
    use App\Voyager\DepartmentField;

    $objDepartment = new MS_Department();
@endphp

@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') .' '. trans('master.form') .' '. trans('master.kpi_departments'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class=""></i> {{ trans('master.form') .' '. trans('master.kpi_departments') }}
        </h1>

        @can('create', KpiTrxDepartment::class)
            <a href="{{ url('admin/kpi/form-department/create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> 
                <span>
                    {{ __('voyager::generic.add_new') }}
                </span>
            </a>
        @endcan

        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <div id="div-filter">

                            <form action="" method="GET">
                                <h4> <i class='voyager-search'></i> Filter Data </h4>

                                <div class="row">
                                    <div class="col-sm-5">
                                        
                                        @php 
                                            $periodes = new KpiTrxDepartment;
                                            $periodes = $periodes
                                                            ->select('kpi_year_from', 'kpi_month_from', 'kpi_year_until', 'kpi_month_until')
                                                            ->distinct()
                                                            ->orderBy('kpi_year_from', 'kpi_month_from', 'kpi_year_until', 'kpi_month_until')
                                                            ->get();
                                        @endphp

                                        <div class="form-group">
                                            <label for=""> <em> Periode </em> </label>

                                            <select name="periode" class="form-control selectpicker" data-live-search="true">
                                                <option value=""> -- Pilih -- </option>
                                                @foreach ($periodes as $kp => $vp)
                                                    @php
                                                        $val = $vp->kpi_year_from."-".$vp->kpi_month_from;
                                                        $val .= '_' . $vp->kpi_year_until."-".$vp->kpi_month_until;

                                                        $selected = ($val == app('request')->input('periode'))
                                                                    ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $val }}" {{ $selected }}>
                                                        {{ $vp->kpi_year_from }} {{ ModelInit::monthName($vp->kpi_month_from) }}
                                                        s/d 
                                                        {{ $vp->kpi_year_until }} {{ ModelInit::monthName($vp->kpi_month_until) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-5">

                                        @php 
                                            $departments = new MS_Department;
                                            $departments = $departments->table()->where('KodeSeksi', '!=', '_mgr_')->orderBy('namaSeksi')->get();
                                        @endphp

                                        <div class="form-group">
                                            <label for=""> <em> Departemen </em> </label>

                                            <select name="department_id" class="form-control selectpicker" data-live-search="true">
                                                @if( Auth::user()->can('browse_all', KpiTrxDepartment::class) === false )
                                                    @php
                                                        $employee = new MS_Karyawan;
                                                        $employee = $employee->detail(['NIK' => Auth::user()->nik]);

                                                        $department = new MS_Department;
                                                        $department = $department->detail(['KodeSeksi' => $employee->KodeSeksi]);
                                                    @endphp

                                                    <option selected value="{{ $department->KodeSeksi }}"> {{ $department->namaSeksi }} </option>
                                                @else
                                                    <option value=""> -- Pilih -- </option>
                                                    @foreach ($departments as $kd => $vd)
                                                        @php 
                                                            $selected = ($vd->KodeSeksi == app('request')->input('department_id'))
                                                                        ? 'selected' : '';
                                                        @endphp
                                                        <option value="{{ $vd->KodeSeksi }}" {{ $selected }}>
                                                            {{ $vd->namaSeksi }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-2">
                                        <div style="padding-top: 10px">
                                            <button type="submit" name="submit" class="btn btn-dark">
                                                Filter
                                                <i class="voyager-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Departemen</th>
                                        <th>Status</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Dibuat Tgl</th>
                                        <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($form_kpi_departments as $key => $item)
                                        <tr>
                                            <td> 
                                                (
                                                    {{ $item->kpi_year_from }} {{ \ModelInit::monthName($item->kpi_month_from) }} 
                                                    s/d 
                                                    {{ $item->kpi_year_until }} {{ \ModelInit::monthName($item->kpi_month_until) }}
                                                ) 
                                            </td>

                                            <td> {{ $objDepartment->detail(['KodeSeksi' => $item->department_id])->namaSeksi }} </td>
                                            <td> 
                                                @if( $item->kpi_status == 'Canceled' )
                                                    <span class="badge badge-danger">
                                                        {{ $item->kpi_status }}
                                                    </span>
                                                @elseif( $item->kpi_status == 'Approved' )
                                                    <span class="badge badge-success">
                                                        {{ $item->kpi_status }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-light">
                                                        {{ $item->kpi_status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td> {{ $item->user->name }} </td>
                                            <td> {{ $item->created_at }} </td>
                                            <td>
                                                <a href="{{ url("admin/kpi/form-department/detail?id=". $item->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="voyager-eye"></i> Lihat
                                                </a>

                                                <a href="{{ url("admin/kpi/form-department/edit?id=". $item->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="voyager-edit"></i> Ubah
                                                </a>

                                                <a href="javascript:void(0);" title="Batal" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}" id="delete-kpi-form-department-{{ $item->id }}">
                                                    <i class="voyager-trash"></i> 
                                                    <span class="hidden-xs hidden-sm">Batal</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <i class="voyager-trash"></i> 
                        Apa anda yakin ingin membatalkan @lang('master.kpi_departments') ?
                    </h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Iya">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                        Engga Jadi
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
        $(document).ready(function () 
        {
            var table = $('#dataTable').DataTable({
                order: [[0, 'desc'], [1, 'asc']],
                columnDefs: [
                    { width: 250, targets: 5 },
                ]
            });

            $('.selectpicker').selectpicker();
        });


        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = 'form-department/cancel/__id'.replace('__id', $(this).data('id'));
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
