<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chicco Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            * {
                box-sizing: border-box;
            }
            html, body {
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            html {
                background: url('<?php echo asset('img/frame-2.jpg') ?>') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                top: -50px;
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 65px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 20px;
            }
        </style>

        <style>
            .title {
                font-size: 50px;
            }
            .img {
                margin-bottom: 10px;
            }

            .img img {
                width: 130px;
            }
            
            input {
                outline: none;
                border: none;
            }

            .input100 {
                display: block;
                width: 100%;
                height: 100%;
                padding: 0 40px 0 3px;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                background-color: rgba(255,255,255, 0.0);
                border-radius: 7px;
            }

            .trans-04 {
                -webkit-transition: all 0.4s;
                -o-transition: all 0.4s;
                -moz-transition: all 0.4s;
                transition: all 0.4s;
            }

            .input-code {
                border: 1px solid #777;
                padding: 14px 20px;
                width: 270px;
                margin: 0 auto;
            }
            .or { margin: 10px 0px; font-weight: 600; color: #a9a9a9; }
            .register a {
                text-decoration: none;
                font-weight: 600;
                font-style: italic;
                color: #7cb5c7;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="img">
                    <img src="{{ asset('img/chicco-test-brand.png') }}" alt="Logo PT. L'Essential">
                </div>

                <div class="title m-b-md">
                    Online Psychology Test
                </div>

                <div class="links">
                    <form action="{{ url('app/listing') }}" method="get">
                        @csrf

                        <input type="text" name="code" autocomplete="off" placeholder="Put your code here then press enter ..." class="input-code s2-txt1 placeholder0 input100 trans-04">

                        <div class="or"> or </div>

                        <div class="register">
                            <a href="">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
