<?php
Route::get('/', 'UserController@login');
Route::get('restablecerbuscador', 'ResolucionsController@restablecerbuscador');
Route::get('descarga/{archivo?}/{nombrearch?}', function($archivo = null, $nombrearch = null) {
    if($archivo == null) {
        return Redirect::to('/');
    }
    if($nombrearch == null) {
        $nombrearch = 'DVP-'.date('Ymd');
    }
    return Response::download(str_replace('-', '/', $archivo), $nombrearch);
});
Route::resource('resolucions', 'ResolucionsController');
Route::resource('tipos', 'TiposController');
Route::resource('roles', 'RolesController');
Route::resource('permissions', 'PermissionsController');
Route::resource('tags', 'TagsController');
Route::controller( 'users',                'UserController', array('only' => array('index')));
// Confide routes
Route::get( 'user/index',                  'UserController@index');
Route::get( 'user/create',                 'UserController@create');
Route::post('user',                        'UserController@store');
Route::get( 'user/login',                  'UserController@login');
Route::post('user/login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'user/edit/{id}',              'UserController@edit');
Route::post('user/edit/{id}',              'UserController@update');
Route::get( 'user/logout',                 'UserController@logout');
Route::get( 'user/confirm/{code}',         'UserController@getConfirm');
Route::get( 'user/reset/{token}',          'UserController@getReset');

//Route::get('build_acl', function() {
////    $filas_eliminadas = Permission::where('id','<>','954624')->delete();
////    return $filas_eliminadas;
//    $rutas = Route::getRoutes();
//    $i = 0;
//    $permiso = array();
//    foreach ($rutas->all() as $name => $route) {
//        $nombre = explode(' ', $name);
//        $nombree = (empty($nombre[1])) ? $nombre[0] : $nombre[1];
//        
//        $noms = DB::table('permissions')->where('name','=',$nombree)->count();
//        
//        if($noms == 0) {
//            $permiso[$i] = new Permission;
//            $permiso[$i]->name = $nombree;
//            $permiso[$i]->display_name = $name;
//            $permiso[$i]->save();
//
//            $nombre = explode(' ', $name);
//            $mostrar = (empty($nombre[1])) ? $nombre[0] : $nombre[1];
//            echo "<pre> - ".$i.' ';
//            print_r($mostrar);
//            echo "</pre>";
//
//            $i++;
//        }
//    }
//});

App::error(function($exception, $code)
{
    switch ($code)
    {
        case 403:
            return Response::view('errors.403', array(), 403);
            break;
        case 404:
            return Response::view('errors.404', array(), 404);
            break;
        case 500:
            return Response::view('errors.500', array(), 500);
            break;
        default:
            return Response::view('errors.default', array(), $code);
            break;
    }
});