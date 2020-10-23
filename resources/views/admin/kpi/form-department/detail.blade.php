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
                        $grand_bobot = 0;
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
                                        <th class="text-center blue-blue-sky" colspan="{{ $diff_month }}">
                                            Periode
                                            ( 
                                                {{ $header->kpi_year_from }}-{{ $header->kpi_month_from }} 
                                                s/d 
                                                {{ $header->kpi_year_until }}-{{ $header->kpi_month_until }} 
                                            )
                                        </th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Total Nilai</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Rata2 Nilai</th>
                                        <th style="vertical-align: middle; text-align: center" rowspan="2">Total Bobot</th>
                                    </tr> 

                                    <tr>
                                        @php 
                                            $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                            for($j = 1; $j <= $diff_month; $j++):    
                                        @endphp
                                        <th class="text-center {{ $j % 2 != 0 ? 'blue-blue-sky' : '' }}"> 
                                            {{ $month_first->format('Y') }} {{ $month_first->format('M') }} 
                                        </th>
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
                                                $total_kpi_value = 0;
                                                $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                                for($j = 1; $j <= $diff_month; $j++):    

                                                    if( !empty($details_by_key[$item->kpi_department_id][ $month_first->format('Y')."-". $month_first->format('n')]) )
                                                    {
                                                        $kpi_value = $details_by_key[$item->kpi_department_id][ $month_first->format('Y')."-". $month_first->format('n')]->kpi_value;
                                                    }
                                                    else 
                                                    {
                                                        $kpi_value = '';
                                                    }
                                                    
                                                    if(is_numeric($kpi_value))
                                                    {
                                                        $total_kpi_value += $kpi_value;

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
                                                    }
                                            @endphp
                                            <td class="text-center input-value"> 
                                                <div style="width: 50px; text-align: center">
                                                    @if( is_numeric($kpi_value) )
                                                        {{ $kpi_value }}
                                                    @else 
                                                        <em> {{ $kpi_value }} </em>
                                                    @endif
                                                </div>
                                            </td>
                                            @php 
                                                $month_first->modify("+1 Month");
                                                endfor;
                                            @endphp

                                            <td class="blue-blue-sky"> 
                                                <div style="width: 70px; text-align: center; color: #000;">
                                                    {{ $total_kpi_value }} 
                                                </div>
                                            </td>
                                            <td class="blue-blue-sky">  
                                                <div style="width: 70px; text-align: center; color: #000;">
                                                    {{ round($total_kpi_value / count($summary_value), 4) }}
                                                </div>
                                            </td>
                                            <td class="blue-blue-sky"> 
                                                <div style="width: 70px; text-align: center; color: #000;">
                                                    @php 
                                                    $total_bobot = ($total_kpi_value / count($summary_value)) * ($item->master_kpi->kpi_percentage/100);
                                                    $grand_bobot += $total_bobot;
                                                    @endphp
                                                    {{ round($total_bobot, 4) }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr style="background: #fbfbfb; color: #000;">
                                        <td></td>
                                        {{-- <td style="text-align: right" colspan="{{ 4 + $diff_month }}"> NILAI AKHIR NYA ADALAH </td> --}}
                                        <td style="text-align: right; vertical-align: middle; color: #000;"> 
                                            <h3> NILAI AKHIR NYA ADALAH </h3>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        @php 
                                            $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                            for($j = 1; $j <= $diff_month; $j++): 
                                        @endphp
                                        <th>
                                            <div style="width: 50px; text-align: center">
                                                
                                            </div>
                                        </th>
                                        @php 
                                            $month_first->modify("+1 Month");
                                            endfor;
                                        @endphp
                                        <td></td>
                                        <td></td>
                                        <td> 
                                            <div style="width: 70px; text-align: center">
                                                <h3>
                                                    {{ round($grand_bobot, 2) }}
                                                </h3>
                                            </div>
                                        </td>
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
    </script>
@stop
