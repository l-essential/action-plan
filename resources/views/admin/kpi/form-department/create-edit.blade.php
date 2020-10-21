@php 
    use ComponentUI\Form;
    use App\Models\Kpi\KpiFormDepartment;
    use App\Models\Hris\MS_Department;

    $form = new Form;
@endphp

@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') .' '. trans('master.form') .' '. trans('master.kpi_departments'))

@section('page_header')
    <div class="container-fluid text-center">
        <h1 class="page-title" style="padding-left:0; margin-left:0;">
            <i class=""></i> {{ trans('master.form') .' '. trans('master.kpi_departments') }}
        </h1>

        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')

        <form action="{{ $page == 'create' ? url('admin/kpi/form-department/save') : url('admin/kpi/form-department/update?id='. $header->id) }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-sm-3">.</div>

                <div class="col-sm-6">
                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            @php
                                $depart = new MS_Department;
                                $depart = $depart->getDepartNameByNik( Auth::user()->nik );
                                echo $form->input([
                                    'label' => 'Nama Departemen',
                                    'value' => $depart,
                                    'attr_plus' => 'readonly="readonly"',
                                    'view_type' => 'horizontal'
                                ]);
                            @endphp 

                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 clsas="text-center"> Periode dari </h5>

                                    @php
                                        if(!empty($header->kpi_year_from)){
                                            $month_from = strlen($header->kpi_month_from) == 1 ? "0". $header->kpi_month_from : $header->kpi_month_from;
                                            $value = $header->kpi_year_from ."-". $month_from;
                                        }else{
                                            $value = old('kpi_year_from');
                                        }
                                        echo $form->input([
                                            'label' => 'Bulan - Tahun',
                                            'name' => 'kpi_year_from',
                                            'type' => 'month',
                                            'attr_plus' => "required='required'",
                                            'value' => $value
                                        ]);
                                    @endphp 
                                </div>

                                <div class="col-sm-6">
                                    <h5 clsas="text-center"> sampai dengan </h5>

                                    @php
                                        if(!empty($header->kpi_year_until)){
                                            $month_until = strlen($header->kpi_month_until) == 1 ? "0". $header->kpi_month_until : $header->kpi_month_until;
                                            $value = $header->kpi_year_until ."-". $month_until;
                                        }else{
                                            $value = old('kpi_year_until');
                                        }
                                        echo $form->input([
                                            'label' => 'Bulan - Tahun',
                                            'name' => 'kpi_year_until',
                                            'type' => 'month',
                                            'attr_plus' => "required='required'",
                                            'value' => $value
                                        ]);
                                    @endphp 
                                </div>
                            </div>

                        </div>

                        <div class="panel-footer text-center">
                            
                            @if($page == 'create')
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">
                                Submit Periode 
                            </button>
                            @endif

                        </div>
                    </div>

                </div>

                <div class="col-sm-3">.</div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    @php 
                        if($page == 'edit')
                        {
                            $diff_month = ($header->kpi_year_until - $header->kpi_year_from) * 12;
                            $diff_month += $header->kpi_month_until - $header->kpi_month_from;
                            $diff_month++;
                        }
                    @endphp

                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            <table id="table-input" class="table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Sasaran mutu / KPI</th>
                                        <th rowspan="2">Bobot</th>
                                        <th rowspan="2">Target</th>
                                        @if($page == 'create')
                                        <th class="text-center blue-blue-sky">Periode</th>
                                        @else
                                        <th class="text-center blue-blue-sky" colspan="{{ $diff_month }}">
                                            Periode
                                            ( 
                                                {{ $header->kpi_year_from }}-{{ $header->kpi_month_from }} 
                                                s/d 
                                                {{ $header->kpi_year_until }}-{{ $header->kpi_month_until }} 
                                            )
                                        </th>
                                        @endif
                                    </tr>

                                    <tr>
                                        @if($page == 'create')
                                            <th></th>
                                        @else
                                            @php 
                                                $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                                for($j = 1; $j <= $diff_month; $j++):    
                                            @endphp
                                            <th class="text-center {{ $j % 2 != 0 ? 'blue-blue-sky' : '' }}"> {{ $month_first->format('Y') }} {{ $month_first->format('M') }} </th>
                                            @php 
                                                $month_first->modify("+1 Month");
                                                endfor;
                                            @endphp
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($master_jobdesk as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->kpi_name }} </td>
                                            <td> {{ $item->kpi_percentage }} </td>
                                            <td> {{ $item->kpi_target }} </td>

                                            @if($page == 'create')
                                                <td></td>
                                            @else
                                                @php 
                                                    $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                                    for($j = 1; $j <= $diff_month; $j++):    
                                            
                                                        $kpi_value = (!empty( $details_by_key[$item->id][ $month_first->format('Y')."-". $month_first->format('n')]->kpi_value ))
                                                                ? $details_by_key[$item->id][ $month_first->format('Y')."-". $month_first->format('n')]->kpi_value : '';
                                                @endphp
                                                <td class="text-center input-value"> 
                                                    <input style="width: 70px;" value="{{ $kpi_value }}" min="1" max="5" type="number" class="form-control" name="kpi_name[{{ $item->id }}][{{ $month_first->format('Y') }}-{{ $month_first->format('m') }}]">
                                                </td>
                                                @php 
                                                    $month_first->modify("+1 Month");
                                                    endfor;
                                                @endphp
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div class="panel-footer text-center">
                            
                            @if($page == 'edit')
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">
                                Perbarui Data
                            </button>
                            @endif

                        </div>
                    </div>

                </div>
            </div>

        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/fixedColumn.min.css') }}">

    <style>
        .blue-blue-sky {
            background: #e7f5ff;
        }
        .table .input-value {
            background: #e7f5ff;
        }

        /* .table .input-value:nth-child(even) {
            background: #fff;
        } */

        th, td { word-break: break-word !important; }
        table.dataTable tbody td {
            word-break: break-word !important;
        }
        div.dataTables_wrapper {
            min-width: 1024px;
            margin: 0 auto;
        }
    </style>
@stop

@section('javascript')
    <!-- DataTables -->
    <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/fixedColumn.min.js') }}"></script>
    <script>
        $(document).ready(function () 
        {
            var table = $('#dataTable').DataTable();

            var table = $('#table-input').DataTable({
                scrollY: "600px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 2,
                },
                // autoWidth: false,
                // columns: [
                //     {width: "20px"},
                //     {width: "150px"}
                // ]
                // fixedColumns: true,
                columnDefs: [
                    { width: 50, targets: 0 },
                    { width: 400, targets: 1 },
                    { width: 90, targets: 2 },
                    { width: 90, targets: 3 }
                ]
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
