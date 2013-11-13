<?php
class BaseController extends Controller {

        public $usuarioactual;
        /**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if ( ! is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}
        public function controlar_usuario($permission = null, $rol = null, $excepciones = array(), $controlador = null) {
            if(!empty($excepciones)) {
                $pag_publicas = array('login','do_login','logout');
                foreach($excepciones as $excepcion) {
                    if(in_array($excepcion, $pag_publicas)) {
                        return false;
                    }
                }
            }
            if($controlador != null) {
                $paginalogin = $controlador;
            } else {
                $paginalogin = 'ResolucionsController@index';
            }
            $paginapublica = 'UserController@login';
            if(($permission == null) && ($rol == null)) {
                return $paginapublica;
            }
            if(isset(Auth::user()->id)) {
                $this->usuarioactual = User::where('id','=',Auth::user()->id)->first();
                $rolusario = "";
                $rolesdeusuarios = Role::all();
                foreach($rolesdeusuarios as $roldeusuario) {
                    if($this->usuarioactual->hasRole($roldeusuario->name)) {
                        $rolusario = $roldeusuario->name;
                    }
                }
                if($this->usuarioactual->hasRole('Invitado'))
                    $rolusario = 'invitado';
                if($this->usuarioactual->hasRole('Consultas'))
                    $rolusario = 'consultas';
                if($this->usuarioactual->hasRole('Usuarios'))
                    $rolusario = 'usuarios';
                if($this->usuarioactual->hasRole('Administrador'))
                    $rolusario = 'administrador';
                View::share('rolusuario', $rolusario);
                
            } else {
                return $paginapublica;
            }
            if($permission != null) {
                $nombre = explode(' ', $permission);
                $mostrar = (empty($nombre[1])) ? $nombre[0] : $nombre[1];
                if(!$this->usuarioactual->can($mostrar)) {
                    return $paginalogin;
                }
            }
            if($rol != null) {
                if(!$this->usuarioactual->hasRole($rol)) {
                    return $paginalogin;
                }
            }
        }
}