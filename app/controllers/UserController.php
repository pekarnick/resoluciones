<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

class UserController extends BaseController {

    /**
     * Displays the form for account creation
     *
     */
    protected $usuario;

    public function __construct(User $usuario) {
        $this->usuario = $usuario;
    }
    
    
    
    public function get_index() {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $usuarios = DB::select("SELECT users.id, users.username, users.nombre_y_apellido, users.confirmed, roles.id 'roleid', roles.name 'rolename' 
                                FROM users 
                                LEFT JOIN assigned_roles 
                                     ON users.id = assigned_roles.user_id
                                LEFT OUTER JOIN roles
                                     ON assigned_roles.role_id = roles.id");
//        $usuarios = DB::table('users')->select(array('id','username','nombre_y_apellido','confirmed'))->paginate(10);
        return View::make('confide.index',compact('usuarios'));
    }




    public function create()
    {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        if($this->usuarioactual->hasRole('Administrador')) {
            $roles = Role::lists('name', 'id');
        } else {
            $roles = DB::table('roles')->where('name','<>','Administrador')->lists('name', 'id');
        }
        $roles = array('' => '--- Seleccione el rol ---') + $roles;
        return View::make('confide.signup', compact('roles'));
    }

    /**
     * Stores new account
     *
     */
    public function store()
    {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $rrol = Input::get('rol');
        
//        echo "<pre>";
//        print_r(Input::all());
//        echo "</pre>";
//        exit;
        $input = array(
            'username' => Input::get('username'),
            'nombre_y_apellido' => Input::get('nombre_y_apellido'),
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
        );
        
        $validation = Validator::make($input, User::$rules);
        
        if ($validation->passes()) {
            $user = new User;
            $user->username = Input::get('username');
            $user->nombre_y_apellido = Input::get('nombre_y_apellido');
            $user->email = Input::get('email');
            $user->password = Input::get('password');
            $user->confirmed = 1;
            // The password confirmation will be removed from model
            // before saving. This field will be used in Ardent's
            // auto validation.
            $user->password_confirmation = Input::get('password_confirmation');

            // Save if valid. Password field will be hashed before save
            $user->save();
            //Asignar roles

            $user->attachRole($rrol);
        } else {
            return Redirect::action('UserController@create')
			->withInput()
			->withErrors($validation)
			->with('message', 'Ocurrio un problema cuando se intentó guardar el usuario, inténtelo de nuevo.');
        }

        if ($user->id) {
            // Redirect with success message, You may replace "Lang::get(..." for your custom message.
                        return Redirect::action('UserController@login')
                            ->with( 'notice', Lang::get('confide::confide.alerts.account_created') );
        } else {
            // Get validation errors (see Ardent package)
            $error = $user->errors()->all(':message');

                        return Redirect::action('UserController@create')
                            ->withInput(Input::except('password'))
                ->with( 'error', $error );
        }
    }

    /**
     * Displays the login form
     *
     */
    public function login()
    {
        if( Confide::user() )
        {
            // If user is logged, redirect to internal 
            // page, change it to '/admin', '/dashboard' or something
            return Redirect::to('/resolucions');
        }
        else
        {
            View::share('titulopagina', 'Login');
            return View::make('confide.login');
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function do_login()
    {
        $input = array(
            'email'    => Input::get( 'email' ), // May be the username too
            'username' => Input::get( 'email' ), // so we have to pass both
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Get the value from the config file instead of changing the controller
        if ( Confide::logAttempt( $input, Config::get('confide::signup_confirm') ) ) 
        {
            // Redirect the user to the URL they were trying to access before
            // caught by the authentication filter IE Redirect::guest('user/login').
            // Otherwise fallback to '/'
            // Fix pull #145
            return Redirect::intended('/'); // change it to '/admin', '/dashboard' or something
        }
        else
        {
            $user = new User;

            // Check if there was too many login attempts
            if( Confide::isThrottled( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            }
            elseif( $user->checkUserExists( $input ) and ! $user->isConfirmed( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            }
            else
            {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

                        return Redirect::action('UserController@login')
                            ->withInput(Input::except('password'))
                ->with( 'error', $err_msg );
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function confirm( $code )
    {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        if ( Confide::confirm( $code ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
                        return Redirect::action('UserController@login')
                            ->with( 'error', $error_msg );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function forgot_password()
    {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     */
    public function do_forgot_password()
    {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        if( Confide::forgotPassword( Input::get( 'email' ) ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
                        return Redirect::action('UserController@forgot_password')
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function reset_password( $token )
    {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     */
    public function do_reset_password()
    {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
        );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
                        return Redirect::action('UserController@reset_password', array('token'=>$input['token']))
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function logout()
    {
        Confide::logout();
        
        return Redirect::to('/');
    }
    
    public function edit($id) {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $usuario = DB::select("SELECT users.id, users.username, users.email, users.nombre_y_apellido, roles.id 'roleid', roles.name 'rolename' 
                                FROM users 
                                LEFT JOIN assigned_roles 
                                     ON users.id = assigned_roles.user_id
                                LEFT OUTER JOIN roles
                                     ON assigned_roles.role_id = roles.id
                                WHERE users.id = ?", array($id));
        if (is_null($usuario)){
            return Redirect::action('UserController@get_index');
        }
        if(($usuario[0]->rolename == 'Administrador') && (!$this->usuarioactual->hasRole('Administrador'))) {
            return Redirect::action('UserController@get_index')->with('message', 'No puedes editar un administrador');
        }
        if($this->usuarioactual->hasRole('Administrador')) {
            $roles = Role::lists('name', 'id');
        } else {
            $roles = DB::table('roles')->where('name','<>','Administrador')->lists('name', 'id');
        }
        $roles = array('' => '--- Seleccione el rol ---') + $roles;
        return View::make('confide.edit', compact('usuario', 'roles'));
    }
    
    public function update($id) {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
//        echo "<pre>";
//        print_r(Input::all());
//        echo "</pre>";
//        exit;
        $input = array(
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'nombre_y_apellido' => Input::get('nombre_y_apellido'),
            
        );
        $rrol = Input::get('rol');
        
        $conpas = false;
        if($input['password'] != "") {
            $conpas = true;
            $input['password_confirmation'] = Input::get('password_confirmation');
        }
        
        $validation = Validator::make($input, User::$rules2);
        
        if ($validation->passes()) {
            $cols = array();
            foreach ($input as $clave => $valor) {
                if($valor != "") {
                    $cols[$clave] = $valor;
                }
            }
            DB::table('assigned_roles')->where('assigned_roles.user_id','=',$id)->delete();
            if($conpas == true) {
                $usuario = $this->usuario->find($id);
                $usuario->update($input);
            } else {
                DB::table('users')->where('users.id','=', $id)->update($cols);
                $usuario = $this->usuario->find($id);
            }
            $usuario->attachRole($rrol);
            return Redirect::action('UserController@get_index')->with('message', 'Usuario actualizado.');
        }
        return Redirect::action('UserController@edit', $id)->withInput()
                                                           ->withErrors($validation)
                                                           ->with('message', 'Error al intentar actualizar el usuario, inténtelo de nuevo.');
    }
    
    public function get_habilitar($id) {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $usuario = $this->usuario->find($id);
        $estado = 1;
        $mensaje = 'Usuario habilitado';
        switch ($usuario->confirmed) {
            case 0:
                $estado = 1;
                $mensaje = 'Usuario habilitado';
            break;
            case 1:
                $estado = 0;
                $mensaje = 'Usuario deshabilitado';
            break;
        }
        DB::update('update users set confirmed = ? where id = ?', array($estado, $id));
        return Redirect::action('UserController@get_index')->with('message', $mensaje);
    }
    
    public function get_nombres() {
        $termino = Input::get('term');
        $nombres = DB::table('nombres')->whereRaw("nombre LIKE CONCAT('%','".$termino."','%')")
                                       ->lists('nombre');
        $retorno = array();
        foreach ($nombres as $nombre) {
            $retorno[]['value'] = $nombre;
        }
        return json_encode($retorno);
    }
    public function get_tags() {
        $termino = Input::get('term');
        $termin = explode(",", $termino);
        $nombres = DB::table('tags')->whereRaw("nombre LIKE CONCAT('%','".trim($termin[count($termin) - 1])."','%')")
                                       ->lists('nombre');
        $retorno = array();
        foreach ($nombres as $nombre) {
            $retorno[]['value'] = $nombre;
        }
        return json_encode($retorno);
    }
//    public function post_destroy($id) {
//        $control = $this->controlar_usuario(null, 'Administrador', null, 'ResolucionsController@index');
//        if($control) {
//            return Redirect::action($control)->with('message', 'Acceso denegado');
//        }
//        DB::table('users')->where('id','=',$id)->delete();
//        return Redirect::action('UserController@index')->with('message', 'Usuario eliminado');
//    }

}
