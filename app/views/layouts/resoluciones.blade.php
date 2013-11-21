<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
                <meta name="apple-mobile-web-app-capable" content="yes" />    
                <title>{{ $titulopagina }} D.V.P.</title>
                
                <link href="/css/{{ $tema }}/bootstrap.css" rel="stylesheet" />
                <link href="/css/{{ $tema }}/bootstrap-responsive.min.css" rel="stylesheet" />

                <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" />
                <link href="/css/font-awesome.min.css" rel="stylesheet" />
                <link href="/css/dark-hive/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
    
                <link href="/css/{{ $tema }}/base-admin-2.css" rel="stylesheet" />
                <link href="/css/{{ $tema }}/base-admin-2-responsive.css" rel="stylesheet" />
                @yield('css')
                <link href="/css/custom.css" rel="stylesheet" />
	</head>

	<body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
		<div class="container">
			<a class="brand" href="/">
                            <img src="/img/imagen.php?src=/img/logo-head.png&h=50" alt="" />
				{{ $titulopagina }}
			</a>
                        <a href="/user/logout" class="pull-right">
                            <button class="btn btn-small btn-danger"><i class="icon-off"></i> Cerrar Sesión</button>
                        </a>
		</div> <!-- /container -->
            </div> <!-- /navbar-inner -->
        </div> <!-- /navbar -->
    

        <div class="subnavbar">
            <div class="subnavbar-inner">
		<div class="container">
			<a class="btn-subnavbar collapsed" data-toggle="collapse" data-target=".subnav-collapse">
				<i class="icon-reorder"></i>
			</a>
			<div class="subnav-collapse collapse">
				<ul class="mainnav">
					<li <?php if(Request::segment(1) == 'resolucions') { echo 'class="active"'; } ?>>					
						<a href="/resolucions">
							<i class="icon-copy"></i>
							<span>
                                                            Documentos
                                                        </span>
						</a>
					</li>
                                        @if(isset(Auth::user()->nombre_y_apellido))
                                            @if((strtolower($rolusuario) == 'administrador') || (strtolower($rolusuario) == 'usuarios') || (strtolower($rolusuario) == 'jefe - director'))
                                                <li <?php if(Request::segment(1) == 'tipos') { echo 'class="active"'; } ?>>
                                                        <a href="/tipos">
                                                                <i class="icon-file"></i>
                                                                <span>
                                                                    Categorías
                                                                </span>
                                                        </a>	    				
                                                </li>
                                            
                                                <li <?php if(Request::segment(1) == 'tags') { echo 'class="active"'; } ?>>
                                                        <a href="/tags">
                                                                <i class="icon-tags"></i>
                                                                <span>
                                                                    Tags
                                                                </span>
                                                        </a>	    				
                                                </li>
                                            @endif
                                        @endif
                                        @if(isset(Auth::user()->nombre_y_apellido))
                                            @if((strtolower($rolusuario) == 'administrador') || (strtolower($rolusuario) == 'jefe - director'))
                                                <li <?php if(Request::segment(1) == 'nombres') { echo 'class="active"'; } ?>>
                                                        <a href="/nombres">
                                                                <i class="icon-road"></i>
                                                                <span>
                                                                    Nombres
                                                                </span>
                                                        </a>	    				
                                                </li>
                                                <li <?php if((Request::segment(1) == 'users') || (Request::segment(1) == 'user') || (Request::segment(1) == 'roles') || (Request::segment(1) == 'permissions')) { echo 'class="active"'; } ?>>
                                                        <a href="/users">
                                                                <i class="icon-user"></i>
                                                                <span>
                                                                    Usuarios
                                                                </span>
                                                        </a>	    				
                                                </li>
                                            @endif
                                        @endif
                                </ul>
                                <ul class="mainnav pull-right">
                                        <li>
                                            <a href="/" style="cursor: default" onclick="return false;">
							<i class="icon-tasks"></i>
							<span>
                                                            @if(isset(Auth::user()->nombre_y_apellido))
                                                                {{ Auth::user()->nombre_y_apellido }}
                                                            @endif
                                                        </span>
						</a>
					</li>
                                </ul>
			</div> <!-- /.subnav-collapse -->

                </div> <!-- /container -->

            </div> <!-- /subnavbar-inner -->

        </div> <!-- /subnavbar -->
    
        @if (Session::has('message'))
            <div class="flash alert">
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget stacked ">
                            @yield('titulo')
                            <div class="widget-content">
                                @yield('main')
                            </div>
                        </div> <!-- /row -->
                    </div>
            </div> <!-- /container -->
        </div> <!-- /main -->
        <div class="footer">
                <div class="container">
                        <div class="row">
                                <div id="footer-copyright" class="span6">
                                        D.V.P. - Departamento de Informática
                                </div> <!-- /span6 -->
                        </div> <!-- /row -->
                </div> <!-- /container -->
        </div> <!-- /footer -->
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/js/jquery-1.9.1.js"></script>
        <script src="/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="/js/libs/bootstrap.min.js"></script>
        <script src="/js/Application.js"></script>
        @yield('scripts')
</html>