<div id="accordion-level">

    <?php
    foreach ($jabatans as $key => $value) :
    ?>

        <div class="card">
            <div class="card-header job-position">
                <a class="btn-block" data-toggle="collapse" href="#c-poiuy-<?php echo $key; ?>">
                    <?php echo $value->namaJabatan; ?>

                    <span class="voyager-angle-down" style="float: right;"></span>
                </a>
            </div>

            <div id="c-poiuy-<?php echo $key; ?>" class="collapse in" data-parent="#accordion-level">
                <div class="card-body">

                    <?php
                    if (!empty($list_employees[$value->kodeJabatan])):
                    foreach ($list_employees[$value->kodeJabatan] as $kemp => $vemp) :
                    ?>

                        <input type="hidden" name="nik[]" value="<?php echo $vemp->NIK; ?>">

                        <h5>
                            <button type="button" class="btn-block" data-toggle="collapse" data-target="#cemploye-poiuy-<?php echo $vemp->NIK; ?>">
                                * <em> {{ $vemp->namaKaryawan }} </em>
                                <span class="voyager-angle-down" style="float: right;"></span>
                            </button>
                        </h5>

                        <div id="cemploye-poiuy-<?php echo $vemp->NIK; ?>" class="collapse in collapse-content">
                            <div class="freeze-table">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Nama Jobdesk</th>
                                            <th rowspan="2">Bobot</th>
                                            <th rowspan="2">Ketentuan Penilaian</th>
                                            <th class="text-center blue-blue-sky" colspan="{{ $diff_month }}">
                                                Periode
                                                (
                                                {{ $header->kpi_year_from }}-{{ $header->kpi_month_from }}
                                                s/d
                                                {{ $header->kpi_year_until }}-{{ $header->kpi_month_until }}
                                                )
                                            </th>
                                            <th rowspan="2">Aksi</th>
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
                                        <?php
                                        if (!empty($list_jobdesk[$value->kodeJabatan])) :
                                            foreach ($list_jobdesk[$value->kodeJabatan] as $klj => $vlj) :
                                        ?>
                                                <tr>
                                                    <td style="min-width: 250px; background: #fff">
                                                        <input type="hidden" name="job_id[<?php echo $vemp->NIK; ?>][]" value="<?php echo $vlj->id; ?>">
                                                        <input type="text" name="job_name[<?php echo $vemp->NIK; ?>][<?php echo $vlj->id; ?>]" class="form-control" value="<?php echo $vlj->job_name; ?>">
                                                    </td>
                                                    <td style="min-width: 130px;">
                                                        <div class="input-group mb-3">
                                                            <input style="position: static" type="number" name="kpi_weight[<?php echo $vemp->NIK; ?>][<?php echo $vlj->id; ?>]" class="form-control" value="<?php echo $vlj->kpi_weight; ?>">
                                                            <div class="input-group-addon">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="modalViewNotesValue('{{ $vlj->id }}')">
                                                            <span class="voyager-search"></span>
                                                        </a>
                                                    </td>
                                                    @php
                                                    $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                                    for($j = 1; $j <= $diff_month; $j++): 
                                                    
                                                        $kpi_value = (!empty( $details_by_key[$vemp->NIK][$vlj->id][$month_first->format('Y')."-".$month_first->format('n')]->kpi_value ))
                                                        ? $details_by_key[$vemp->NIK][$vlj->id][ $month_first->format('Y')."-".$month_first->format('n')]->kpi_value 
                                                        : '';
                                                    @endphp

                                                        <td class="text-center input-value" style="min-width: 80px">
                                                            <select name="kpi_value[<?php echo $vemp->NIK; ?>][{{ $vlj->id }}][{{ $month_first->format('Y') }}-{{ $month_first->format('m') }}]" class="form-control">
                                                                <option value="skip" {{ ($kpi_value == 'skip') ? 'selected' : '' }}> - </option>
                                                                <option value="1" {{ ($kpi_value == '1') ? 'selected' : '' }}> 1 </option>
                                                                <option value="2" {{ ($kpi_value == '2') ? 'selected' : '' }}> 2 </option>
                                                                <option value="3" {{ ($kpi_value == '3') ? 'selected' : '' }}> 3 </option>
                                                                <option value="4" {{ ($kpi_value == '4') ? 'selected' : '' }}> 4 </option>
                                                                <option value="5" {{ ($kpi_value == '5') ? 'selected' : '' }}> 5 </option>
                                                            </select>
                                                        </td>

                                                    @php
                                                        $month_first->modify("+1 Month");
                                                        endfor;
                                                    @endphp
                                                        <td>
                                                            <a href="javascript:void(0)" onclick="deleteRowJobdesk(this)">
                                                                <i class="voyager-trash"></i>
                                                            </a>
                                                        </td>
                                                </tr>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>

                                        <tr class="custom">
                                            <td style='min-width: 250px; background: #fff'>
                                                <input type="text" name="jobdesk_custom[<?php echo $vemp->NIK; ?>][]" class="form-control" value="" placeholder="Jobdesk custom">
                                            </td>
                                            <td style="min-width: 130px;">
                                                <div class="input-group mb-3">
                                                    <input style="position: static;" type="number" name="kpi_weight_custom[<?php echo $vemp->NIK; ?>][]" class="form-control" value="">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td></td>
                                            @php
                                                $month_first = new DateTime($header->kpi_year_from."-".$header->kpi_month_from);
                                                for($j = 1; $j <= $diff_month; $j++): 
                                                    $kpi_value='' ; 
                                                    // $kpi_value=(!empty( $details_by_key[$vlj->nik][$vlj->job_id][ $month_first->format('Y')."-". $month_first->format('n')]->kpi_value ))
                                                    // ? $details_by_key[$vlj->nik][$vlj->job_id][ $month_first->format('Y')."-". $month_first->format('n')]->kpi_value : '';
                                            @endphp
                                                <td class="text-center input-value">
                                                    <select name="kpi_value_custom[<?php echo $vemp->NIK; ?>][<?php echo $month_first->format('Y')."-".$month_first->format('m'); ?>][]" class="form-control">
                                                        <option value="skip" {{ ($kpi_value == 'skip') ? 'selected' : '' }}> - </option>
                                                        <option value="1" {{ ($kpi_value == '1') ? 'selected' : '' }}> 1 </option>
                                                        <option value="2" {{ ($kpi_value == '2') ? 'selected' : '' }}> 2 </option>
                                                        <option value="3" {{ ($kpi_value == '3') ? 'selected' : '' }}> 3 </option>
                                                        <option value="4" {{ ($kpi_value == '4') ? 'selected' : '' }}> 4 </option>
                                                        <option value="5" {{ ($kpi_value == '5') ? 'selected' : '' }}> 5 </option>
                                                    </select>
                                                </td>
                                            @php
                                                    $month_first->modify("+1 Month");
                                                endfor;
                                            @endphp
                                            <td>
                                                <a href="javascript:void(0)" onclick="deleteRowJobdesk(this)">
                                                    <i class="voyager-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <br>
                            <a href="javascript:void(0)" onclick="addRowJobdesk(this)">
                                <span class="voyager-plus"></span>
                                Tambah jobdesk custom
                            </a>
                            <br><br><br>
                        </div>

                    <?php
                    endforeach;
                    else:
                        echo "<h5> Tidak ada karyawna untuk posisi/jabatan ini </h5>";
                    endif;
                    ?>

                </div>
            </div>
        </div>

    <?php
    endforeach;
    ?>

</div>