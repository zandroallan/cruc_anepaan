@extends('layouts.layout-buscador')

@section('content')
<input type="hidden" id="idFolio" value="{{$folio}}">
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card p-3  py-4 text-center">
                    <h1>Por favor escanee el codigo</h1>
                    <div id="qrcode"></div>

                    <div class="pull-right">
                        <a href="{{ route('buscador.index') }}" class="btn btn-info">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
@endsection

@section('script')
  

    const qrcode = document.getElementById("qrcode");
    const textInput = vuri + '/constancia/validacion/' + $('#idFolio').val();

    const qr = new QRCode(qrcode);
    qr.makeCode(textInput); 
@endsection