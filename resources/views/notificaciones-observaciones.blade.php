@extends('layouts.backend')

@section('styles')

@endsection

@section('js')
    {!! Html::script('public/template/admin/assets/js/demo/timeline.demo.js'); !!}
    {!! Html::script('public/template/admin/assets/plugins/sweetalert/dist/sweetalert.min.js'); !!}
    {!! Html::script('public/js/backend/notificacion-acusar.js'); !!}
@endsection

@section('title')
    <h2 class="main-content-title tx-24 mg-b-5">Notificaciones</h2>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">{!! html_entity_decode(link_to_route('notificaciones.observaciones', "Notificaciones", null, [])) !!}</li>
    <li class="breadcrumb-item active">Nuevo trámite</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">                
                <div class="card-body">
                    <div class="vtimeline">

                        @foreach($notificaciones_forzadas as $notificacion)
                        <div class="timeline-wrapper timeline-wrapper-primary">
                            <div class="timeline-badge"></div>
                            <div class="timeline-panel">
                                @if($notificacion->id_c_notificacion!=5)
                                <div class="timeline-heading">
                                    <span class="userimage">{!! Html::image('img/logo-shyfp.jpg', 'alt', []) !!}</span>
                                    <h5 class="text-center">Coordinación de Verificación de la Supervisión Externa de la Obra Pública Estatal</h5>
                                    <h6 class="timeline-title">Trámite {{ $notificacion->folio }}</h6>
                                    <h6 class="timeline-title">Fecha notificación {{ $notificacion->fecha }}</h6>
                                </div>
                                <div class="timeline-body">
                                    <p><b>Advertencia!</b> Se han encontrado observaciones en este tramite, las cuales puede solventar en el apartado de <b>"Observaciones"</b>.</p>
                                    <p>{!! $notificacion->descripcion !!}</p>
                                </div>
                                @else
                                    <div class="timeline-body">
                                        <p>{!! $notificacion->descripcion !!}</p>
                                    </div>
                                    
                                @endif
                                <div class="timeline-footer d-flex align-items-center flex-wrap"> 
                                    <button class="btn btn-primary f-s-12 rounded-corner" onclick="acusar({{ $notificacion->id }})" type="button">Acusar de recibido</button>
                                    <!--span class="ml-md-auto"><i class="fe fe-calendar text-muted mr-1"></i>Fecha: {{ $notificacion->fecha }}</span-->
                                </div>

                            </div>
                        </div>
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
