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

            <div class="row">
                <div class="col-sm-3">.</div>

                <div class="col-sm-6">
                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            @php
                                $depart = new MS_Department;
                                $depart = $depart->detail(['KodeSeksi' => $header->department_id])->namaSeksi;
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
                                        echo $form->input([
                                            'label' => 'Bulan - Tahun',
                                            'attr_plus' => "readonly='readonly'",
                                            'value' => $header->kpi_year_from ." - ". $header->kpi_month_from
                                        ]);
                                    @endphp 
                                </div>

                                <div class="col-sm-6">
                                    <h5 clsas="text-center"> sampai dengan </h5>

                                    @php
                                        echo $form->input([
                                            'label' => 'Bulan - Tahun',
                                            'attr_plus' => "readonly='readonly'",
                                            'value' => $header->kpi_year_until ." - ". $header->kpi_month_until
                                        ]);
                                    @endphp 
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-sm-3">.</div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    @php
                        $diff_month = ($header->kpi_year_until - $header->kpi_year_from) * 12;
                        $diff_month += $header->kpi_month_until - $header->kpi_month_from;
                        $diff_month++;

                        $summary_value = [];
                        $summary_percent = [];
                    @endphp

                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            <table id="table-input" class="table">
                                <thead>
                                    <tr>
                                        <th rowspan="3">No</th>
                                        <th rowspan="3">Sasaran mutu / KPI</th>
                                        <th rowspan="3">Bobot</th>
                                        <th rowspan="3">Target</th>
                                        <th class="text-center blue-blue-sky" colspan="{{ $diff_month }}">
                                            Periode
                                            ( 
                                                {{ $header->kpi_year_from }}-{{ $header->kpi_month_from }} 
                                                s/d 
                                                {{ $header->kpi_year_until }}-{{ $header->kpi_month_until }} 
                                            )
                                        </th>
                                    </tr>

                                    <tr>
                                        @php 
                                            $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                            for($j = 1; $j <= $diff_month; $j++):    
                                        @endphp
                                        <th colspan="2" class="text-center {{ $j % 2 != 0 ? 'blue-blue-sky' : '' }}"> 
                                            {{ $month_first->format('Y') }} {{ $month_first->format('M') }} 
                                        </th>
                                        @php 
                                            $month_first->modify("+1 Month");
                                            endfor;
                                        @endphp
                                    </tr>

                                    <tr>
                                        @php 
                                            $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                            for($j = 1; $j <= $diff_month; $j++):    
                                        @endphp
                                        <th> Nilai </th>
                                        <th> Persentase {{ $j }} </th>
                                        @php 
                                            $month_first->modify("+1 Month");
                                            endfor;
                                        @endphp
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($details as $key => $item)

                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->master_kpi->kpi_name }} </td>
                                            <td> {{ $item->master_kpi->kpi_percentage }}% </td>
                                            <td> {{ $item->master_kpi->kpi_target }}% </td>
                                            @php 
                                                $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                                for($j = 1; $j <= $diff_month; $j++):    

                                                    $kpi_value = $details_by_key[$item->kpi_department_id][ $month_first->format('Y')."-". $month_first->format('n')]->kpi_value;

                                                    if( empty( $summary_value[$month_first->format('Y')."-". $month_first->format('n')] ) ){
                                                        $summary_value[ $month_first->format('Y')."-". $month_first->format('n') ] = $kpi_value;
                                                    }else{
                                                        $summary_value[ $month_first->format('Y')."-". $month_first->format('n') ] += $kpi_value;
                                                    }

                                                    if( empty( $summary_percent[$month_first->format('Y')."-". $month_first->format('n')] ) ){
                                                        $summary_percent[ $month_first->format('Y')."-". $month_first->format('n') ] = ($kpi_value / 5) * $item->master_kpi->kpi_percentage;
                                                    }else{
                                                        $summary_percent[ $month_first->format('Y')."-". $month_first->format('n') ] += ($kpi_value / 5) * $item->master_kpi->kpi_percentage;
                                                    }
                                            @endphp
                                            <td class="text-center input-value {{ $j % 2 != 0 ? 'blue-blue-sky' : '' }}"> 
                                                <div style="width: 50px; text-align: center">
                                                    {{ $kpi_value }}
                                                </div>
                                            </td>

                                            <td class="text-center {{ $j % 2 != 0 ? 'blue-blue-sky' : '' }}">
                                                <div style="width: 65px; text-align: center">
                                                    {{ ($kpi_value / 5) * $item->master_kpi->kpi_percentage }}%
                                                </div>
                                            </td>
                                            @php 
                                                $month_first->modify("+1 Month");
                                                endfor;
                                            @endphp
                                        </tr>
                                    @endforeach

                                    <tr style="background: #fbfbfb; color: #000;">
                                        <th> </th>
                                        <th> Total Keseluruhan </th>
                                        <th></th>
                                        <th></th>
                                        @php 
                                            $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                            for($j = 1; $j <= $diff_month; $j++): 
                                        @endphp
                                        <th class="{{ $j % 2 != 0 ? 'blue-blue-sky' : '' }}"> 
                                            <div style="width: 50px; text-align: center">
                                                {{ $summary_value[ $month_first->format('Y')."-". $month_first->format('n') ] }}
                                            </div>
                                        </th>

                                        <th class="{{ $j % 2 != 0 ? 'blue-blue-sky' : '' }}"> 
                                            <div style="width: 65px; text-align: center">
                                                (<strong>
                                                        {{ $summary_percent[ $month_first->format('Y')."-". $month_first->format('n') ] }}%
                                                </strong>)
                                            </div>
                                        </th>
                                        @php 
                                            $month_first->modify("+1 Month");
                                            endfor;
                                        @endphp
                                    </tr>
                                </tbody>
                            </table>

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
                order: false,
                searching: false,
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
