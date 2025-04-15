<div id="header" class="header navbar-default">
	<!-- begin navbar-header -->
	<div class="navbar-header">
		<a href="{{ url('/mis-tramites') }}" class="navbar-brand"><b>SIRCSE</b> Portal</a>
		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<!-- end navbar-header --><!-- begin header-nav -->
	<ul class="navbar-nav navbar-right">
		

		<li class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">				
				{!! Html::image('template/admin/assets/img/user/user-13.jpg', 'alt', ['height'=>'150']) !!}
				<span class="d-none d-md-inline">{{ Auth::User()->name }}</span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="javascript:;" class="dropdown-item"><i class="fa fa-user"></i> Mi cuenta</a>
				<div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off"></i> Cerrar sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
			</div>
		</li>
	</ul>
	<!-- end header-nav -->
</div>