@include('../templates/front/header')

<style>
    .ui.two.column .ui.image img {
        width: 100%;
        height: 300px;
    }

    .ui.two.column .hidden.content .my-content {
        width: 100%;
        height: 300px;
        background: rgba(0,0,0,0.7);
        color: #fff;

        padding-left: 15px;
        padding-right: 15px;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .list-app .ui.bottom.label {
        padding-top: 30px;
        bottom: -15px;
        text-align: center;
    }

    .list-app .ui.bottom.label a {
        display: block;
    }

    .list-app .btn-action {
        text-align: center;
    }
</style>

<div id="my-page-content" class="container ui">

    <div class="ui stackable two column grid list-app">
        <div class="column">
            <div class="ui fade reveal">
                <div class="visible content">
                    <div class="ui image">
                        <img src="{{ asset('img/apps/disc-banner.jpg') }}">
                        
                        <div class="ui black ribbon label">
                            <i class="hotel icon"></i> TEST 1: D.I.S.C
                        </div>
                    </div>
                </div>

                <div class="hidden content">
                    <div class="my-content">
                        Merupakan tes yang blablabla,
                        perkiraan waktu test adalah 30 menit.
                        Lorem ipsum dolor sit amet consectetur, tekan tombol "Mulai Test" di bawah ini.
                    </div>
                </div>
            </div>

            <div class="btn-action">
                <a href="{{ url('app/disc?page=1') }}" class="ui button fluid primary"> 
                    Mulai Test 
                </a>
            </div>
        </div>

        <div class="column">
            <div class="ui fade reveal">
                <div class="visible content">
                    <div class="ui image">
                        <img src="{{ asset('img/apps/cfit-banner.jpg') }}">
                        
                        <div class="ui black ribbon label">
                            <i class="hotel icon"></i> TEST 2: Culture Fair Intelligence Score
                        </div>
                    </div>
                </div>

                <div class="hidden content">
                    <div class="my-content">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione officia deserunt nemo corporis dignissimos laboriosam ipsam fugit sequi tenetur, 
                    </div>
                </div>
            </div>

            <div class="btn-action">
                <a href="" class="ui button fluid red"> Mulai Test </a>
            </div>
        </div>
    </div>

</div>

@include('../templates/front/footer')