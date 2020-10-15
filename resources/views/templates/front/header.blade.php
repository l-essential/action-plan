<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if(!empty($site_title))
        {{ $site_title }}
        -
        @endif
        {{ setting('site.title') }}
    </title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('plugins/semantic-ui/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

    <div id="header">

        <div class="ui main text container">
            <h1 class="ui header text-align-center">
                <img class="logo" src="{{ asset('img/chicco-test-logo.png') }}">
            </h1>

            <p>
                An awesome application for psychology test. Lets start together.
            </p>
        </div>

        <div class="ui borderless sticky main menu">
            <div class="ui text container">
                <div class="header item">
                    <img class="logo" src="{{ asset('img/chicco-test-brand.png') }}">
                </div>

                <a href="#" class="ui dropdown item" tabindex="0">
                    Bahasa
                    <i class="dropdown icon"></i>
                    <div class="menu" tabindex="-1">
                        <div class="item"> <i class="id flag"></i> Indonesia </div>
                        <div class="item"> <i class="us flag"></i> English </div>
                    </div>
                </a>

                <a href="#" class="ui right floated dropdown item" tabindex="0">
                    Nama Peserta Psikotest 
                    <i class="dropdown icon"></i>
                    <div class="menu" tabindex="-1">
                        <div class="item"> Data Peserta <i class="user icon"></i></div>
                        <div class="item"> Keluar <i class="sign-out icon"></i></div>
                    </div>
                </a>
            </div>
        </div>

    </div>