@php 
    use ComponentUI\Form;
    use App\Models\Kpi\KpiFormDepartment;
    use App\Models\Hris\MS_Department;

    $form = new Form;
@endphp

@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') .' '. trans('master.form') .' '. trans('master.kpi_personals'))

@section('page_header')
    <div class="container-fluid text-center">
        <h1 class="page-title" style="padding-left:0; margin-left:0;">
            <i class=""></i> {{ trans('master.form') .' '. trans('master.kpi_personals') }}
        </h1>

        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')

        <form action="{{ $page == 'create' ? url('admin/kpi/form-employee/save') : url('admin/kpi/form-employee/update?id='. $header->id) }}" method="POST">
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
                            @if( $page == 'edit' )
                                @include('admin/kpi/form-employee/ce-jobdesk')
                            @else
                                <h4 class="text-center"> Silahkan submit periode KPI terlebih dahulu </h4>
                            @endif
                        </div>

                        <div class="panel-footer text-center">
                            
                            @if($page == 'edit')
                            <button type="submit" name="submit" value="submit" class="btn btn-dark">
                                Perbarui Data
                            </button>
                            @endif

                        </div>
                    </div>

                </div>
            </div>

        </form>
    </div>

    <div id="modal-view-notes-value" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <span class="voyager-trophy"></span>
                        Ketentuan Penilaian
                    </h4>
                </div>

                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td style="min-width: 100px">Jobdesk</td>
                            <th class="col-job-name"></th>
                        </tr>

                        <tr>
                            <td style="min-width: 100px">Nilai 1</td>
                            <th class="col-kpi-notes-1"></th>
                        </tr>

                        <tr>
                            <td style="min-width: 100px">Nilai 2</td>
                            <th class="col-kpi-notes-2"></th>
                        </tr>

                        <tr>
                            <td style="min-width: 100px">Nilai 3</td>
                            <th class="col-kpi-notes-3"></th>
                        </tr>

                        <tr>
                            <td style="min-width: 100px">Nilai 4</td>
                            <th class="col-kpi-notes-4"></th>
                        </tr>

                        <tr>
                            <td style="min-width: 100px">Nilai 5</td>
                            <th class="col-kpi-notes-5"></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/fixedColumn.min.css') }}">

    <style>
        #accordion-level .card-header.job-position {
            border-bottom: 1px solid #e4e4e4;
            border-top: 1px solid #e4e4e4;
            padding: 12px 20px;
            background: #38b0f1;
        }

        #accordion-level .card-header.job-position a {
            color: #fff;
        }

        .blue-blue-sky {
            background: #e7f5ff;
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
            drawDataTableInput();
        });

        function drawDataTableInput()
        {
            // var table = $('.table-input').DataTable({
            //     scrollY: "600px",
            //     scrollX: true,
            //     scrollCollapse: true,
            //     paging: false,
            //     searching: false,
            //     fixedColumns: {
            //         leftColumns: 1,
            //     },
            //     columnDefs: [
            //         { width: 200, targets: 0 },
            //         { width: 140, targets: 1 },
            //         { width: 125, targets: 2 }
            //     ]
            // });

            // setTimeout(function(){
            //     table.order([0, 'asc']).draw();
            // }, 1200);
        }

        function addRowJobdesk(obj)
        {
            var objTable = $(obj).closest('.collapse-content');
            var trCustomHtml = objTable.find('table tbody tr.custom').html();
            objTable.find('tbody').append('<tr> '+ trCustomHtml + ' </tr>');
        }

        function deleteRowJobdesk(obj)
        {
            var objTr = $(obj).closest('tr');
            objTr.remove();
        }

        function modalViewNotesValue(id)
        {
            $.ajax({
                method: "GET",
                url: "{{ url('admin/kpi/form-employee/modal_value_notes') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res)
                {
                    var modal_id = "#modal-view-notes-value";

                    $(modal_id + " .col-job-name").html(res.data.job_name);
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
