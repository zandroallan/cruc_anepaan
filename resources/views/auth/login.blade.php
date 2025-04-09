<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #B0BEC5;
            background-repeat: no-repeat;
        }

        .card0 {
            box-shadow: 0px 4px 8px 0px #757575;
            border-radius: 0px;
        }

        .card2 {
            margin: 0px 40px;
        }

        .logo {
            width: 100%;
            max-width: 200px;
            margin-top: 20px;
            margin-left: 35px;
        }

        .image {
            width: 100%;
            max-width: 360px;
            height: auto;
        }

        .border-line {
            border-right: 1px solid #EEEEEE;
        }

        .facebook, .twitter, .linkedin {
            background-color: #3b5998;
            color: #fff;
            font-size: 18px;
            padding-top: 5px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer;
        }

        .line {
            height: 1px;
            width: 45%;
            background-color: #E0E0E0;
            margin-top: 10px;
        }

        .or {
            width: 10%;
            font-weight: bold;
        }

        .text-sm {
            font-size: 14px !important;
        }

        ::placeholder {
            color: #BDBDBD;
            opacity: 1;
            font-weight: 300;
        }

        input, textarea {
            padding: 10px 12px;
            border: 1px solid lightgrey;
            border-radius: 2px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            color: #2C3E50;
            font-size: 14px;
            letter-spacing: 1px;
        }

        input:focus, textarea:focus {
            box-shadow: none !important;
            border: 1px solid #304FFE;
            outline-width: 0;
        }

        button:focus {
            box-shadow: none !important;
            outline-width: 0;
        }

        a {
            color: inherit;
            cursor: pointer;
        }

        .btn-blue {
            background-color: #181824;
            width: 100%;
            max-width: 150px;
            color: #fff;
            border-radius: 2px;
        }

        .btn-blue:hover {
            color: #fff;
            cursor: pointer;
        }

        .bg-blue {
            color: #fff;
            background-color: #181824;
        }

        @media screen and (max-width: 991px) {
            .logo {
                margin-left: 0px;
                width: 100%;
                max-width: 150px;
            }

            .image {
                width: 100%;
                height: auto;
            }

            .border-line {
                border-right: none;
            }

            .card2 {
                border-top: 1px solid #EEEEEE !important;
                margin: 0px 15px;
            }

            .card1 {
                padding-left: 15px;
                padding-right: 15px;
            }

            .row {
                flex-direction: column;
                align-items: center;
            }
        }

        @media screen and (max-width: 576px) {
            .logo {
                max-width: 120px;
            }

            .image {
                max-width: 280px;
            }

            .card2 {
                margin: 0px 10px;
            }

            .btn-blue {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container px-1 px-md-5 px-lg-1 px-xl-5 py-5">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5 p-5">
                        <div class="row justify-content-center">
                            <img alt="Logo" src="{{asset('public/img2/saybg.png')}}" class="logo" />
                        </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <img alt="Logo" src="{{asset('public/img2/contratista.jpg')}}" class="image" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    {!! Form::open(['url' => 'login', 'method' => 'POST', 'class'=>'margin-bottom-0']) !!}
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                            <h5 class="mb-0 mr-4 mt-2"><b>Ingrese sus datos para accesar</b></h5>
                        </div>
                       
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Usuario:</h6></label>
                            <input class="mb-4" type="text" id="nickname" name="nickname" placeholder="Ingrese su usuario">
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Contraseña:</h6></label>
                            <input type="password" id="password" name="password" placeholder="Ingrese su contraseña">
                        </div>
                        
                        <div class="row pt-2 mb-3 px-3">
                            <button type="submit" class="btn btn-blue text-center">Accesar</button>
                        </div>                     
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3">
                    <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                    <div class="social-contact pr-3 ml-sm-auto">
                        <small><b>Secretaría Anticorrupción y Buen Gobierno</b></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
