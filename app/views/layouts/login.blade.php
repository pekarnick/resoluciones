<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>@yield('title_for_layout')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" /> 
    
	<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	
	<link href="/css/font-awesome.min.css" rel="stylesheet" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" />
    
        <link href="/css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" />    
    
        <link href="/css/base-admin-2.css" rel="stylesheet" />
        <link href="/css/base-admin-2-responsive.css" rel="stylesheet" />
	
        <link href="/css/pages/signin.css" rel="stylesheet" type="text/css" />

        <link href="/css/custom.css" rel="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>
	
	
@if (Session::has('message'))
    <div class="flash alert">
        <p>{{ Session::get('message') }}</p>
    </div>
@endif
@if ( Session::get('error') )
    <div class="alert alert-error">{{{ Session::get('error') }}}</div>
@endif

@if ( Session::get('notice') )
    <div class="alert">{{{ Session::get('notice') }}}</div>
@endif
<div class="account-container stacked">
	
	<div class="content clearfix">
                <h1>Iniciar Sesión</h1>		
                @yield('main')
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/libs/jquery-1.8.3.min.js"></script>
<script src="/js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="/js/libs/bootstrap.min.js"></script>

<script src="/js/Application.js"></script>

<script src="/js/signin.js"></script>

</body>
</html>