<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div data-scrollbar="true" data-height="100%" style="overflow: hidden; width: auto; height: 100%;" data-init="true">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="{{asset('img/user.png')}}" alt="">
							</div>
							<div class="info">
								<b class="caret pull-right"></b>{{ Auth::User()->name }}
								<small>Tipo de usuario: {{ Auth::User()->roles->first()->description }}</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    		<i class="fa fa-power-off"></i> Cerrar sesión
                			</a>
						</ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				

				<ul class="nav">
					@if(Auth::User()->hasRole(['ventanilla']))
						<li class="nav-header">INICIO</li>
						<li class="active"><a href="index.html"><i class="fa fa-th-large"></i>Dashboard</a></li>
						<li class="nav-header">VENTANILLA</li>
						<li class="active">
							<a href="index.html">
								{!! html_entity_decode(link_to_route('registro.index', '<i class="fa fa-edit"></i>Registro</a>', null, [])) !!}
						</li>
						<li class="has-sub active">
							<a href="javascript:;">
								<b class="caret"></b>
								<i class="fa fa-list-alt"></i>
								<span>Trámites</span>
							</a>
							<ul class="sub-menu">
								<li><a href="index.html">Iniciados</a></li>
								<li><a href="index.html">En proceso</a></li>
								<li><a href="index_v2.html">Completados</a></li>
								<li><a href="index_v3.html">Cancelados</a></li>
							</ul>
						</li>
					@endif

					@if(Auth::User()->hasRole(['usuario']))
						<li class="nav-header">MENÚ</li>
						<li class="active">
								{!! html_entity_decode(link_to_route('mis-tramites.index', '<i class="fa fa-edit"></i>Mis trámites</a>', null, [])) !!}
						</li>
						<?php 
							$id_registro=Auth::User()->id_registro;						
							$count_obs=0;														
						  	$ult_tramite=\App\Http\Models\Backend\T_Registro::find($id_registro);
						  	if($ult_tramite->id_ultimo_tramite!=0)
						  	{
						  		$array_o=[];
								$array_o['id_tramite']=$ult_tramite->id_ultimo_tramite;
								$array_o['status_t']=1;
						  		$total_obs=\App\Http\Models\Backend\T_Tramite_Observacion::totalObservaciones($array_o);
						  		$count_obs=count($total_obs);
						  	}
						?>
                        <li class="has-sub active">
                        	<a href="{{ Route('mis-observaciones.index')}}">
                        		@if(
									$count_obs!=0 &&
									$total_obs[0]->id_c_tramites_seguimiento == 2
								)<span class="badge pull-right">{!! $count_obs !!}</span>@endif
								<i class="fa fa-search"></i>
								<span>Observaciones</span>
                        	</a>								
						</li>
					@endif
					<li class="active">
						<a href="{{ Route('descargas-f.index')}}"><i class="fa fa-edit"></i> Formatos</a>
					</li>
					<li class="active">
						<a href="#mdlAtencion" data-toggle="modal"><i class="fa fa-phone"></i> Atencion telefonica</a>				 
					</li>




				</ul>
				<!-- end sidebar nav -->
			</div><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 214px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 397.15px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
			<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>