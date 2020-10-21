@php 
    use App\Models\Kpi\KpiFormDepartment;
    use App\Models\Hris\MS_Department;

    $objDepartment = new MS_Department();
@endphp

@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') .' '. trans('master.form') .' '. trans('master.kpi_departments'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class=""></i> {{ trans('master.form') .' '. trans('master.kpi_departments') }}
        </h1>

        @can('create', KpiFormDepartment::class)
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
                                            <td> {{ $item->kpi_status }} </td>
                                            <td> {{ $item->user->name }} </td>
                                            <td> {{ $item->created_at }} </td>
                                            <td>
                                                <a href="{{ url("admin/kpi/form-department/detail?id=". $item->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="voyager-eye"></i> Lihat
                                                </a>

                                                <a href="{{ url("admin/kpi/form-department/edit?id=". $item->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="voyager-edit"></i> Ubah
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
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} @lang('master.kpi_departments') ?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('voyager::generic.delete_confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
@stop

@section('javascript')
    <!-- DataTables -->
    <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                order: [[0, 'desc'], [1, 'asc']]
            });
        });


        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = 'url_delete_nya_guys'.replace('__id', $(this).data('id'));
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
