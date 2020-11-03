@php 
    use App\Models\Hris\MS_Department;
    use App\Models\Kpi\KpiTrxDepartmentDetail;
    $objDepartment = new MS_Department;

    $objTrxDtl = new KpiTrxDepartmentDetail;
@endphp
@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') .' '. trans('master.form') .' '. trans('master.kpi_departments'))

@section('page_header')
    <div class="container-fluid text-center">
        <h1 class="page-title" style="padding-left:0; margin-left:0;">
            <i class=""></i> Laporan KPI Departemen
        </h1>

        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')

        <form action="" method="GET" style="width: 500px; margin: 0 auto;">

            <div class="form-group">
                <select name="periode" class="form-control selectpicker" data-live-search="true">
                    <option value=""> -- Pilih Periode -- </option>
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

            <div class="form-group">
                <select name="department_id" class="form-control selectpicker" data-live-search="true">
                    <option value=""> -- Pilih Departemen -- </option>
                    @if( !empty($departments) )
                        @foreach ($departments as $kd => $vd)
                            @php
                                $val = $vd->KodeSeksi;
                                $selected = ($val == app('request')->input('department_id'))
                                            ? 'selected' : '';
                            @endphp
                            <option value="{{ $val }}" {{ $selected }}> {{ $vd->namaSeksi }} </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="text-center">
                <button class="btn btn-success" type="submit" name="submit" value="submit">
                    Buat Laporan
                </button>
            </div>

        </form>

        <div id="canvas-container" style="width: 70%; margin: 0 auto; padding-top: 30px;">
            <canvas id="canvas"></canvas>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/fixedColumn.min.css') }}">

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
@stop

@section('javascript')
    <!-- DataTables -->
    <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/fixedColumn.min.js') }}"></script>
    <script src="{{ asset('plugins/charts-c3/js/color.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js"></script>

    @if( !empty(app('request')->input('periode')) && !empty(app('request')->input('department_id')) && !empty($header) )
        @php
            $diff_month = ($header->kpi_year_until - $header->kpi_year_from) * 12;
            $diff_month += $header->kpi_month_until - $header->kpi_month_from;
            $diff_month++;
        @endphp
        <script>
            var config = {
                type: 'line',
                data: {
                    labels: [
                        @php 
                            $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                            for($j = 1; $j <= $diff_month; $j++):    
                        @endphp
                            "{{ $month_first->format('M') }} {{ $month_first->format('y') }}"

                            @if( $j != $diff_month )
                              ,
                            @endif
                        @php 
                            $month_first->modify("+1 Month");
                            endfor;
                        @endphp
                    ],
                    datasets: [{
                        label: '<?php echo $objDepartment->detail(['KodeSeksi' => app('request')->input('department_id')])->namaSeksi; ?>',
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        data: [
                            @php 
                                $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                for($j = 1; $j <= $diff_month; $j++):    

                                    $data_detail = $objTrxDtl->where('id', $header->id)
                                                        ->where('kpi_year', $month_first->format('Y'))
                                                        ->where('kpi_month', $month_first->format('m'))
                                                        ->first();

                                    if( !empty($data_detail->kpi_value) )
                                    {
                                        if( $data_detail->kpi_value != 'skip' ){
                                            echo $data_detail->kpi_value;
                                        }else{
                                            echo 0;
                                        }
                                    }else{
                                        echo 0;
                                    }

                                    if( $j != $diff_month ){
                                        echo ",";
                                    }

                                $month_first->modify("+1 Month");
                                endfor;
                            @endphp
                        ],
                        fill: false,
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Bulan'
                            },
                            "ticks": { 
                                "beginAtZero": true,
                                suggestedMax: 5
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Nilai Akhir'
                            },
                            "ticks": { 
                                "beginAtZero": true,
                                suggestedMax: 5
                            }
                        }]
                    }
                }
            };

            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        </script>
    @else
        <script>
            $(document).ready(function () 
            {            
                /*
                ** horizontal
                */
                new Chart(
                    document.getElementById("canvas").getContext('2d'), {
                    "type": "horizontalBar", 
                    "data": { 
                        // "labels": ["January", "February", "March", "April", "May", "June", "July"], 
                        "labels": [
                            <?php 
                                foreach($charts as $k => $value):
                                    echo '"' . $departments[$value->department_id]->namaSeksi .'"';
                                    if( count($charts) != ($k+1) ){
                                        echo ",";
                                    }
                                endforeach;
                            ?>
                        ],
                        "datasets": [{ 
                            "label": "", 
                            "data": [
                                <?php 
                                    foreach($charts as $k => $value):
                                        echo '"' . round($value->kpi_final_value, 2) .'"';
                                        if( count($charts) != ($k+1) ){
                                            echo ",";
                                        }
                                    endforeach;
                                ?>
                            ], 
                            "fill": false, 
                            "backgroundColor": [
                                "rgba(255, 99, 132, 0.2)", 
                                "rgba(255, 159, 64, 0.2)", 
                                "rgba(255, 205, 86, 0.2)", 
                                "rgba(75, 192, 192, 0.2)", 
                                "rgba(54, 162, 235, 0.2)", 
                                "rgba(153, 102, 255, 0.2)", 
                                "rgba(201, 203, 207, 0.2)"
                            ],
                            "borderColor": [
                                "rgb(255, 99, 132)",
                                "rgb(255, 159, 64)",
                                "rgb(255, 205, 86)",
                                "rgb(75, 192, 192)",
                                "rgb(54, 162, 235)",
                                "rgb(153, 102, 255)",
                                "rgb(201, 203, 207)"
                            ], 
                            "borderWidth": 1 
                        }]
                    }, 
                    "options": { 
                        "scales": {
                            "xAxes": [{
                                "barThickness": 2,
                                "maxBarThickness": 4,
                                "ticks": { 
                                    "beginAtZero": true 
                                }
                            }] 
                        } ,

                        plugins: {
                            // Change options for ALL labels of THIS CHART
                            datalabels: {
                                color: '#000000'
                            }
                        }
                    } 
                });
            });
        </script>
    @endif

    <script>
        function modalViewNotesValue(id)
        {
            $.ajax({
                method: "GET",
                url: "{{ url('admin/kpi/form-department/modal_value_notes') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res)
                {
                    var modal_id = "#modal-view-notes-value";

                    $(modal_id + " .col-kpi-name").html(res.data.kpi_name);
                    $(modal_id + " .col-kpi-notes-1").html(res.data.kpi_notes_1);
                    $(modal_id + " .col-kpi-notes-2").html(res.data.kpi_notes_2);
                    $(modal_id + " .col-kpi-notes-3").html(res.data.kpi_notes_3);
                    $(modal_id + " .col-kpi-notes-4").html(res.data.kpi_notes_4);
                    $(modal_id + " .col-kpi-notes-5").html(res.data.kpi_notes_5);

                    $(modal_id).modal("show");
                },
                error: function(err)
                {
                    console.log(err);
                }
            });
        }
    </script>
@stop
