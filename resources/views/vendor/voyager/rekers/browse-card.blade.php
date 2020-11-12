@php 
    use App\Models\Hris\MS_Department;
    use App\Models\Hris\MS_Karyawan;
    use App\Voyager\DepartmentField;
    use App\Models\Reker\Reker;
    use App\Models\Reker\RekerDepartment;
    use App\Models\Reker\RekerPic;
    use App\Models\Reker\RekerPeriode;

    $objReker = new Reker;
    $objRekerPer = new RekerPeriode;
    $objDepartment = new MS_Department();
@endphp

<style>
    .card-header.periode {
        border-bottom: 1px solid #e4e4e4;
        border-top: 1px solid #e4e4e4;
        padding-top: 14px;
        padding-bottom: 7px;
        background: #edfff8;
        padding-left: 20px;
        padding-right: 40px;
        display: inline-block;
    }

    .card-body.reker {
        border: 1px solid #f5f5f5;
        text-align: center;
        /* background: url('https://image.freepik.com/free-vector/stylish-hexagonal-line-pattern-background_1017-19742.jpg'); */
        background: url('{{ asset('img/bg-patern-orange.jpg') }}');
        color: #050444;
        padding-bottom: 15px;
    }
</style>

@foreach($periodes as $kp => $vp)

    <div class="card">
        <div class="card-header periode">
            <a class="card-link" data-toggle="collapse" href="#reker-card-{{ $vp->id }}">
                <h4>
                    PERIODE {{ $vp->periode_from }} s/d {{ $vp->periode_until }}
                    <span class="voyager-angle-down"></span>
                </h4>
            </a>
        </div>

        <div id="reker-card-{{ $vp->id }}" class="collapse in">
            <div class="card-body row" style="padding-lefT: 0px;">
                
                @php
                    $cards = $objReker->where('periode_id', $vp->id)
                                ->select('department_id')
                                ->selectRaw('COUNT(target) as total_target')
                                ->groupBy('department_id');
                    // $cards = DB::table($objReker->getTable() . " AS r")
                    //         ->select('r.*', 'p.periode_from', 'p.periode_until')
                    //         ->orderBy('p.periode_from', 'asc')
                    //         ->orderBy('p.periode_until', 'asc')
                    //         ->orderBy('r.department_id', 'asc')
                    //         ->leftJoin($objRekerPer->getTable() . " AS p", "p.id", "=", "r.periode_id");

                    if( !empty(app('request')->input('department_id')) ){
                        $cards->where('department_id', app('request')->input('department_id'));
                    }

                    $cards = $cards->get();
                    foreach ($cards as $kc => $vc)
                    :
                @endphp

                    <div class="card col-12 col-sm-3">
                        <div class="card-body reker">
                            <h4>
                                @php
                                    $d = $objDepartment->table()->where('KodeSeksi', $vc->department_id)->first();
                                    if(!empty($d)){
                                        echo $d->namaSeksi;
                                    }
                                @endphp
                            </h4>

                            <div>
                                Total Target: {{ $vc->total_target }}
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ url('admin/rekers/'. $vp->id .'/detail_card?department_id='. $vc->department_id) }}" target="_blank" class="btn btn-primary btn-block">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                @php
                    endforeach;
                @endphp

            </div>
        </div>
    </div>
    
@endforeach

