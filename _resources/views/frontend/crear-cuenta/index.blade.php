@extends('layouts.backend')

@section('styles')
	{!! Html::style('public/template/admin/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css'); !!}
	{!! Html::style('public/template/admin/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); !!}
	{!! Html::style('public/template/admin/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); !!}
@endsection

@section('js')
	{!! Html::script('public/template/admin/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js'); !!}
	{!! Html::script('public/template/admin/assets/plugins/select2/dist/js/select2.min.js'); !!}
	{!! Html::script('public/template/admin/assets/plugins/datatables.net/js/jquery.dataTables.min.js'); !!}
	{!! Html::script('public/template/admin/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); !!}
	{!! Html::script('public/template/admin/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js'); !!}
	{!! Html::script('public/template/admin/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js'); !!}
	{!! Html::script('public/template/admin/assets/plugins/sweetalert/dist/sweetalert.min.js'); !!}	
	{!! Html::script('public/js/backend/general.js'); !!}
	{!! Html::script('public/js/backend/registro.js'); !!}
@endsection

@section('buttons')
	{!! html_entity_decode(link_to_route($current_route.'.create', '<i class="fa fa-plus"></i> Nuevo contratista/supervisor', null, ['class'=>'btn btn-white btn-sm'])) !!}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item breadcrumb-header ">{!! html_entity_decode(link_to_route($current_route.'.index', $title, null, [])) !!}</li>
@endsection

@section('script')
	$(".default-select2").select2();
	fill_table('{{ URL::route($current_route.'.resultados.tramites',[]) }}', '{{ URL::route($current_route.'.show','_') }}', {"anio": $('#anio').val()});
    
	function searhss(tipo,data){
    	clean_table();
		let route= "";
		if(tipo==1) {
			fill_table('{{ URL::route($current_route.'.resultados.tramites',[]) }}', '{{ URL::route($current_route.'.show','_') }}', data);
		}else {
			route= "resultados.registros";
			fill_table('{{ URL::route($current_route.'.resultados.registros',[]) }}', '{{ URL::route($current_route.'.show','_') }}', data);
		}    	
	};
	$('#collapseTwo').collapse();
	    
@endsection

@section('content')
	{!! Form::open(['route' => [$current_route.'.destroy', 0], 'id'=>'myformdeletei', 'name'=>'myformdeletei','method' => 'DELETE' , 'class' => 'myformdeletei', 'style'=>'display : inline;'], ['role' => 'form']) !!}
	{!! Form::close() !!}

	<div class="note note-info m-b-15">
		<div class="note-icon"><i class="fa fa-info-circle"></i></div>
		<div class="note-content">
			<h5><b>Nota:</b></h5>
			<p>Antes de iniciar un <b>Nuevo trámite</b> verifica si se tienen almacenados los datos del <b>contratista/supervisor</b> en el sistema.</p>
		</div>
					
	</div>	

	<div class="panel panel-inverse" data-sortable-id="form-plugins-6">		
		<!-- begin panel-body -->
		<div class="panel-body panel-form">
			<div class="input-group input-group-lg mb-0">
				<input id="i_search" name="i_search" type="text" class="form-control input-white" placeholder="Buscar contratistas/supervisor por razón social o RFC...">
				{!! Form::hidden('anio', date('Y'),['id'=>'anio', 'class'=>'form-control gui-input']) !!}
				<div class="input-group-append">
					<button type="button" class="btn btn-primary" onclick="buscar_registro()"><i class="fa fa-search fa-fw"></i> Buscar</button>
				</div>
			</div>
		</div>
		<!-- end panel-body -->
	</div>

	<div class="note note-secondary m-b-15">
		<div class="note-content">
			<h4>
				<b>Trámites 
					<a href="#" onclick="select_year(2020)"><span id="y2020" class="label label-primary year">2020</span></a> 
					<a href="#" onclick="select_year(2019)"><span id="y2019" class="label label-default year">2019</span></a>  
					<a href="#" onclick="select_year(2018)"><span id="y2018" class="label label-default year">2018</span></a>
					<a href="#" onclick="select_year(0)"><span id="y0" class="label label-default year">Todos</span></a> 
				</b>
			</h4>
			<p>
				A continuación se listan los <b>trámites</b> realizados en el año actual <b>{{ date('Y') }}</b>. En caso de necesitar mas información seleccione el año correspondiente. 
			</p>
		</div>
	</div>

	<div class="panel panel-inverse">		
		<div class="panel-body">
			<table id="dt_default" class="table table-striped table-bordered display responsive" width="100%">
			</table>
		</div>
	</div>


@endsection