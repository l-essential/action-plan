@php 
    use App\Models\Hris\MS_Department;
    use App\Models\Hris\MS_Karyawan;
    use App\Voyager\DepartmentField;
    use App\Models\Reker\RekerRoutine;
    use App\Models\Reker\RekerRoutineDepartment;
    use App\Models\Reker\RekerRoutinePic;

    $objRekerRoutine = new RekerRoutine;
    $objDepartment = new MS_Department();
@endphp

@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') .' '. trans('master.form') .' Program Kegiatan Rutin')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class=""></i> {{ trans('master.form') }} Program Kegiatan Rutin
        </h1>

        @if( \ModelInit::canIAccess('add_'.$objRekerRoutine->getTable()) !== false )
            <a href="{{ url('admin/reker-routines/create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> 
                <span>
                    {{ __('voyager::generic.add_new') }}
                </span>
            </a>
        @endif

        @include('voyager::multilingual.language-selector')

            <div class="btn btn-add-new">
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="voyager-eye"></i>
                        Mode Lihat
                        <i class="voyager-angle-down"></i>
                      </button>
      
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <li>
                            <a class="dropdown-item" href="{{ url('admin/reker-routines') }}">View by List</a>
                          </li>
                          <li>
                              <a class="dropdown-item" href="{{ url('admin/reker-routines?mode_view=card') }}">View by Card</a>
                          </li>                  
                      </ul>
                </div>
            </div>

        
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

                                    </div>

                                    <div class="col-sm-5">

                                        @php 
                                            $departments = new MS_Department;
                                            $departments = $departments->table()->where('KodeSeksi', '!=', '_mgr_')->orderBy('namaSeksi')->get();
                                        @endphp

                                        <div class="form-group">
                                            <label for=""> <em> Departemen </em> </label>

                                            <select name="department_id" class="form-control selectpicker" data-live-search="true">
                                                @if( \ModelInit::canIAccess('browse_all_' . $objRekerRoutine->getTable()) === false )
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

                        @if( app('request')->input('mode_view') == 'card' )
                            @include('vendor/voyager/reker-routines.browse-card')
                        @else
                            @include('vendor/voyager/reker-routines.browse-table')
                        @endif

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
                        Apa anda yakin ingin menghapus data ini?
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
                    { width: 140, targets: 0 },
                    { width: 100, targets: 1 },
                    { width: 200, targets: 4 },
                    { width: 150, targets: 5 },
                    { width: 150, targets: 6 },
                    { width: 150, targets: 7 },
                    { width: 150, targets: 8 },
                ]
            });

            $('.selectpicker').selectpicker();
        });


        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = 'reker-routines/__id'.replace('__id', $(this).data('id'));
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
