@include('../templates/front/header')

<style>
    #my-page-content {
        padding-bottom: 100px;
    }
    #my-page-content .page-header>img {
        margin-right: 2em;
    }

    #my-page-content .ui.card .description {
        padding-top: 12px;
    }

    .question-list {
        clear: both;
    }

    th.positive, th.negative {
        width: 75px;
    }

    th.action {
        width: 70px;
    }
</style>

<div id="my-page-content" class="container ui">

    <div class="page-header">
        <img src="{{ asset('img/apps/disc.jpg') }}" class="ui image left floated" width="150">
        <h2> Dominance, Influence, Steadiness, Conscientiousness </h2>
        <p>
            INTRUKSI: Setiap nomor di bawah ini memuat 4 (empat) kalimat. Tugas anda adalah:
        </p>

        <p>1. Ceklis pada kolom huruf (P) di samping kalimat yang SANGAT menggambarkan diri anda</p>
        <p>2. Ceklis pada kolom huruf (K) di samping kalimat yang SANGAT TIDAK menggambarkan diri anda</p>
    </div>

    <div class="question-list">

        <div class="ui two column grid">
            @foreach($questions as $kq => $vq)

            <div class="column">
                <div class="ui fluid card">
                    <div class="content">
                        <i class="right floated question icon"></i>
                        <div class="header">Nomor {{ $vq->question_order }}</div>
                        <div class="description">
                            
                            <table class="ui celled table">
                                <thead>
                                    <tr>
                                        <th class="positive">P</th>
                                        <th class="negative">K</th>
                                        <th>Statement</th>
                                        <th class="action">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="positive">
                                            <div class="ui toggle checkbox">
                                                <input type="radio" name="question_1[{{ $kq }}]">
                                                <label for=""></label>
                                            </div>
                                        </td>
                                        <td class="negative">
                                            <div class="ui toggle checkbox">
                                                <input type="radio" name="question_1[{{ $kq }}]">
                                                <label for=""></label>
                                            </div>
                                        </td>
                                        <td> {{ $vq->question_1 }} </td>
                                        <td> 
                                            <a href="">
                                                <i class="icon trash alternate"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="positive">
                                            <div class="ui toggle checkbox">
                                                <input type="radio" name="question_2[{{ $kq }}]">
                                                <label for=""></label>
                                            </div>
                                        </td>
                                        <td class="negative">
                                            <div class="ui toggle checkbox">
                                                <input type="radio" name="question_2[{{ $kq }}]">
                                                <label for=""></label>
                                            </div>
                                        </td>
                                        <td> {{ $vq->question_2 }} </td>
                                        <td> 
                                            <a href="">
                                                <i class="icon trash alternate"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="positive">
                                            <div class="ui toggle checkbox">
                                                <input type="radio" name="question_3[{{ $kq }}]">
                                                <label for=""></label>
                                            </div>
                                        </td>
                                        <td class="negative">
                                            <div class="ui toggle checkbox">
                                                <input type="radio" name="question_3[{{ $kq }}]">
                                                <label for=""></label>
                                            </div>
                                        </td>
                                        <td> {{ $vq->question_3 }} </td>
                                        <td> 
                                            <a href="">
                                                <i class="icon trash alternate"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="positive">
                                            <div class="ui toggle checkbox">
                                                <input type="radio" name="question_4[{{ $kq }}]">
                                                <label for=""></label>
                                            </div>
                                        </td>
                                        <td class="negative">
                                            <div class="ui toggle checkbox">
                                                <input type="radio" name="question_4[{{ $kq }}]">
                                                <label for=""></label>
                                            </div>
                                        </td>
                                        <td> {{ $vq->question_4 }} </td>
                                        <td> 
                                            <a href="">
                                                <i class="icon trash alternate"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

        <div class="ui two column grid">

            <div class="column">
                @if(app('request')->input('page') != 1)
                <a href="" class="ui button red">
                    <i class="icon angle left"></i>
                    Kembali ke Halaman 
                    {{ !empty(app('request')->input('page')) ? app('request')->input('page') - 1 : '' }}
                </a>
                @endif
            </div>

            <div class="column" style="text-align: right;">
                @if(app('request')->input('page') == 6)
                    <a href="" class="ui button primary">
                        <i class="icon paper plane"></i> Submit jawaban
                    </a>
                @else
                    <a href="" class="ui button primary">
                        Lanjut ke Halaman 
                        {{ app('request')->input('page') + 1 }}
                        <i class="icon caret right"></i>
                    </a>
                @endif
            </div>

        </div>

    </div>

</div>

@include('../templates/front/footer')