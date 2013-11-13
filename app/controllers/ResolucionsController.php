<?php

class ResolucionsController extends BaseController {

    /**
     * Resolucion Repository
     *
     * @var Resolucion
     */
    protected $resolucion;

    public function __construct(Resolucion $resolucion) {
        $this->resolucion = $resolucion;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $input = Input::all();
        if((!empty($input)) && (!isset($input['page'])) ) {
            Session::forget('busqueda');
            if(!empty($input['texto'])) {
                Session::put('busqueda.texto', $input['texto']);
            }
            if(!empty($input['numero'])) {
                Session::put('busqueda.numero', $input['numero']);
            }
            if(!empty($input['anio'])) {
                Session::put('busqueda.anio', $input['anio']);
            }
            if(!empty($input['tipo_id'])) {
                Session::put('busqueda.tipo_id', $input['tipo_id']);
            }
            if(!empty($input['resuelve'])) {
                Session::put('busqueda.resuelve', $input['resuelve']);
            }
            if(!empty($input['fdesde'])) {
                $fd = explode('/', $input['fdesde']);
                $fd = $fd[2].'-'.$fd[1].'-'.$fd[0];
                Session::put('busqueda.fdesde', $fd);
            }
            if(!empty($input['fhasta'])) {
                $fh = explode('/', $input['fhasta']);
                $fh = $fh[2].'-'.$fh[1].'-'.$fh[0];
                Session::put('busqueda.fhasta', $fh);
            }
            if(!empty($input['user_id'])) {
                Session::put('busqueda.user_id', $input['user_id']);
            }
            if(!empty($input['tags'])) {
                Session::put('busqueda.tags', $input['tags']);
            }
            if(!empty($input['documento'])) {
                Session::put('busqueda.documento', $input['documento']);
            }
        }
        $res = DB::table('resolucions')->leftJoin('tipos', 'resolucions.tipo_id', '=', 'tipos.id')
                                       ->leftJoin('users', 'resolucions.user_id', '=', 'users.id')
                                       ->leftJoin('resolucion_tag', 'resolucions.id', '=', 'resolucion_tag.resolucion_id');
        
        if(Session::get('busqueda.tags') != null) {
            $tagss = explode(',', Session::get('busqueda.tags'));
            $tagsids = DB::table('tags')->select('id')->whereIn('nombre',$tagss)->get();
            $tagsarr = array();
            foreach($tagsids as $idtag) {
                $tagsarr[] = $idtag->id;
            }
            $resultado = DB::table('resolucion_tag')->select(DB::raw("resolucion_id, COUNT(tag_id) as cont_tag"))
                                                    ->whereIn('tag_id',$tagsarr)
                                                    ->groupBy('resolucion_id')
                                                    ->having('cont_tag','>=',count($tagsarr))
                                                    ->get();
            $arrresultag = array();
            foreach($resultado as $resukt) {
                $arrresultag[] = $resukt->resolucion_id;
            }
            if(!empty($arrresultag))
                $res->whereIn("resolucion_tag.resolucion_id",$arrresultag);
            else
                $res->where("resolucions.numero",'=','xxx');
        }
        if(Session::get('busqueda.texto') != null) {
            $res->whereRaw("resolucions.observaciones LIKE '%".Session::get('busqueda.texto')."%'");
        }
        if(Session::get('busqueda.anio') != null) {
            $res->whereRaw("YEAR(resolucions.fecha) = '".Session::get('busqueda.anio')."'");
        }
        if(Session::get('busqueda.numero') != null) {
            $res->whereRaw("resolucions.numero LIKE '".Session::get('busqueda.numero')."%'");
        }
        if(Session::get('busqueda.tipo_id') != null) {
            $res->where('resolucions.tipo_id', '=', Session::get('busqueda.tipo_id'));
        }
        if(Session::get('busqueda.resuelve') != null) {
            $res->where('resolucions.resuelve', '=', Session::get('busqueda.resuelve'));
        }
        if(Session::get('busqueda.fdesde') != null) {
            $res->where('resolucions.fecha', '>=', Session::get('busqueda.fdesde'));
        }
        if(Session::get('busqueda.fhasta') != null) {
            $res->where('resolucions.fecha', '<=', Session::get('busqueda.fhasta'));
        }
        if(Session::get('busqueda.user_id') != null) {
            $res->where('resolucions.user_id', '=', Session::get('busqueda.user_id'));
        }
        if(Session::get('busqueda.documento') != null) {
            $res->where('resolucions.documento', '=', Session::get('busqueda.documento'));
        }
        $res->orderBy('resolucions.id', 'desc');
        $res->groupBy('resolucions.id');
        
        $resolucions = $res->paginate(20,array(
           'resolucions.id', "resolucions.numero", "resolucions.fecha", "resolucions.resuelve", "resolucions.archivo", "resolucions.iniciales", "resolucions.documento",
           'tipos.nombre as tipo_de_resolucion',
           'users.nombre_y_apellido as usuario',
           'users.id as userid'
        ));

        $listipos = Tipo::lists('nombre', 'id');
        $listipos = array('' => '--- Seleccione categoría ---') + $listipos;
//        $resolutores = DB::table('nombres')->lists('nombre','nombre');
//        $resolutores = array('' => '--- ¿Quién resuelve? ---') + $resolutores;
        $usuarios = User::lists('nombre_y_apellido','id');
        $usuarios = array('' => '--- Seleccione usuario ---') + $usuarios;
        $anioslog = date('Y') - 20;
        $anios = array();
        for($k = 0; $k <= 20; $k++) {
            $anios[$anioslog] = $anioslog;
            $anioslog++;
        }
        return View::make('resolucions.index', compact('resolucions','listipos','usuarios','anios'));
    }

    public function restablecerbuscador() {
        Session::forget('busqueda');
        return Redirect::action('ResolucionsController@index')->with('message', 'Buscador reseteado.');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $tipocarga = Input::get('tipo');
        switch ($tipocarga) {
            case 'R':
                $tipocarga = 'Resolución';
                Session::put('busqueda.tipocarga', $tipocarga);
            break;
            case 'D':
                $tipocarga = 'Disposición';
                Session::put('busqueda.tipocarga', $tipocarga);
            break;
            case 'M':
                $tipocarga = 'Memorándum';
                Session::put('busqueda.tipocarga', $tipocarga);
            break;
            default:
                if(Session::get('busqueda.tipocarga') != null) {
                    $tipocarga = Session::get('busqueda.tipocarga');
                } else {
                    return Redirect::route('resolucions.index')->with('message', 'Debe seleccionar algun tipo de documento a guardar.');
                }
            break;
        }
        $nombres = DB::table('nombres')->where('documento','=',$tipocarga)
                                        ->lists('nombre','nombre');
        
        $nombres = array('' => '-- Seleccione ---') + $nombres;
        $listipos = Tipo::lists('nombre', 'id');
        $listipos = array('' => '--- Seleccione categoría ---') + $listipos;
        $tags = DB::table('tags')->get();
        $checkedarray = array();
        
        return View::make('resolucions.create', compact('listipos','nombres','tags','checkedarray','tipocarga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        
        $input = Input::all();
        $tipo = $input['documento'];
//        echo "<pre>";
//        var_dump($input);
//        echo "</pre>";
//        exit;
                
        $validation = Validator::make($input, Resolucion::$rules);
        if ($validation->passes()){
            if (Input::hasFile('archivo')){
                $fh = explode('/', $input['fecha']);
                $input['fecha'] = $fh[2].'-'.$fh[1].'-'.$fh[0];
                
                $anio = $fh[2];
                $resolucionnum = $input['numero'];
                $resultadoresol = DB::table('resolucions')->where('resolucions.numero', '=', $resolucionnum)
                                                          ->where('resolucions.documento', '=', $input['documento'])
                                                          ->whereRaw("YEAR(resolucions.fecha)='".$anio."'")
                                                          ->count();
                if($resultadoresol != 0) {
                    return Redirect::route('resolucions.create')->withInput()
                                                    ->withErrors($validation)
                                                    ->with('message', 'Número duplicado.');
                }
                $fecha = explode('-',$input['fecha']);
                $destinationPath = 'uploads/'.$fecha[0];
                if(!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777);
                }
                $destinationPath = "uploads/".$fecha[0]."/".$fecha[1];
                if(!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777);
                }
//                $nombrearchivo = $input['archivo']->getClientOriginalName();
                $extension = $input['archivo']->getClientOriginalExtension();
                $iduser = "";
                if(isset(Auth::user()->id)) {
                    $iduser = Auth::user()->id;
                } else {
                    $iduser = date('is');
                }
                $nombrearchivo = date('Ymdhis').$iduser.'.'.$extension; //Cambiar el 1 por la id del usuario
                $uploadSuccess = Input::file('archivo')->move($destinationPath, $nombrearchivo);
                $input['user_id'] = $iduser;
                if($uploadSuccess) {
//                    $noms = DB::table('nombres')->where('nombre','=',$input['resuelve'])->count();
//                    if($noms == 0) {
//                        $nombreresuelve = strtolower($input['resuelve']);
//                        $nombreresuelve = ucfirst($nombreresuelve);
//                        DB::table('nombres')->insert(array(
//                            'nombre' => $nombreresuelve
//                        ));
//                    }
                    
                    
                    
                    if(!empty($input['tipon'])) {
                        $nuevotipo = $input['tipon'];
                        $nuevotipoid = DB::table('tipos')->insertGetId(array(
                                    'nombre' => $nuevotipo
                                ));
                        $input['tipo_id'] = $nuevotipoid;
                    }
                    unset($input['tipon']);
                    $input['archivo'] = $destinationPath.'/'.$nombrearchivo;
                    $tag = (!empty($input['tag'])) ? $input['tag'] : array() ;
                    $tagn = (!empty($input['tagsn'])) ? ucfirst(strtolower(trim($input['tagsn']))) : null ;
                    unset($input['tag']);
                    unset($input['tagsn']);
                    $nuevareso = $this->resolucion->create($input);
                    if($nuevareso) {
                        //Guardar nuevo tag si existe
                        if($tagn != null) {
                            $canttagn = DB::table('tags')->where('nombre','=',$tagn)->first();
                            if(!empty($canttagn->id)) {
                                $tag[] = $canttagn->id;
                            } else {
                                $tag[] = DB::table('tags')->insertGetId(array(
                                    'nombre' => $tagn
                                ));
                            }
                        }
                        //Guardar los tags en tabla intermedia
                        if(!empty($tag)) {
                            $tag = array_unique($tag);
                            foreach($tag as $ta){
                                DB::table('resolucion_tag')->insert(array(
                                    'resolucion_id' => $nuevareso->id,
                                    'tag_id' => $ta
                                ));
                            }
                        }
                    }
                    
                    return Redirect::route('resolucions.index')->with('message', 'Documento guardado.');
                }
            }
        }
        
        return Redirect::route('resolucions.create')->withInput()
                                                    ->withErrors($validation)
                                                    ->with('message', 'Error al intentar guardar, inténtelo de nuevo.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $resolucion = $this->resolucion->findOrFail($id);
        return View::make('resolucions.show', compact('resolucion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        
        $resolucion = $this->resolucion->find($id);
        $tagscheked = Resolucion::find($id)->tags;
        $checkedarray = array();
        foreach($tagscheked as $chec) {
            $checkedarray[] = $chec->id;
        }
        
        $rolesdeusuarios = Role::all();
        $rolusario = "";
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
        if(strtolower($rolusario) != 'administrador') {
            if($resolucion->user_id != Auth::user()->id) {
                return Redirect::route('resolucions.index')->with('message', 'No pueden editar los documentos cargados por otro usuario.');
            }
        }
        $fh = explode('-', $resolucion->fecha);
        $resolucion->fecha = $fh[2].'/'.$fh[1].'/'.$fh[0];
        if (is_null($resolucion)){
            return Redirect::route('resolucions.index');
        }
        
        $tipocarga = $resolucion->documento;
        
        $nombres = DB::table('nombres')->where('documento','=',$tipocarga)
                                        ->lists('nombre','nombre');
        $nombres = array('' => '-- Seleccione ---') + $nombres;
        $listipos = Tipo::lists('nombre', 'id');
        $listipos = array('' => '--- Seleccione categoría ---') + $listipos;
        $tags = DB::table('tags')->get();
        return View::make('resolucions.edit', compact('resolucion','listipos','nombres','tags','checkedarray', 'tipocarga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
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
        if(strtolower($rolusario) != 'administrador') {
            $resolucionselect = DB::table('resolucions')->select(array('user_id'))->find($id);
            if(Auth::user()->id != $resolucionselect->user_id) {
                return Redirect::route('resolucions.index')->with('message', 'No pueden editar los documentos cargados por otro usuario.');
            }
        }
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Resolucion::$rules2);
        $fh = explode('/', $input['fecha']);
        $input['fecha'] = $fh[2].'-'.$fh[1].'-'.$fh[0];
        if ($validation->passes()) {
            if (Input::hasFile('archivo')){
                $fecha = explode('-',$input['fecha']);
                $destinationPath = 'uploads/'.$fecha[0];
                if(!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777);
                }
                $destinationPath = "uploads/".$fecha[0]."/".$fecha[1];
                if(!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777);
                }
//                $nombrearchivo = $input['archivo']->getClientOriginalName();
                $extension = $input['archivo']->getClientOriginalExtension();
                $nombrearchivo = date('Ymdhis').'1.'.$extension; //Cambiar el 1 por la id del usuario
                $uploadSuccess = Input::file('archivo')->move($destinationPath, $nombrearchivo);
                if($uploadSuccess) {
                    $input['archivo'] = $destinationPath.'/'.$nombrearchivo;
                }
            } else {
                unset($input['archivo']);
            }
            if(!empty($input['tipon'])) {
                $nuevotipo = $input['tipon'];
                $nuevotipoid = DB::table('tipos')->insertGetId(array(
                            'nombre' => $nuevotipo
                        ));
                $input['tipo_id'] = $nuevotipoid;
            }
            unset($input['tipon']);
            $tag = (!empty($input['tag'])) ? $input['tag'] : array() ;
            $tagn = (!empty($input['tagsn'])) ? ucfirst(strtolower(trim($input['tagsn']))) : null ;
            unset($input['tag']);
            unset($input['tagsn']);
            
            $resolucion = $this->resolucion->find($id);
            $resultupdate = $resolucion->update($input);
            
            if($resultupdate) {
//                $noms = DB::table('nombres')->where('nombre','=',$input['resuelve'])->count();
//                if($noms == 0) {
//                    $nombreresuelve = strtolower($input['resuelve']);
//                    $nombreresuelve = ucfirst($nombreresuelve);
//                    DB::table('nombres')->insert(array(
//                        'nombre' => $nombreresuelve
//                    ));
//                }
                //Guardar nuevo tag si existe
                if($tagn != null) {
                    $canttagn = DB::table('tags')->where('nombre','=',$tagn)->first();
                    if(!empty($canttagn->id)) {
                        $tag[] = $canttagn->id;
                    } else {
                        $tag[] = DB::table('tags')->insertGetId(array(
                            'nombre' => $tagn
                        ));
                    }
                }
                //Guardar los tags en tabla intermedia
                if(!empty($tag)) {
                    DB::table('resolucion_tag')->where('resolucion_tag.resolucion_id','=',$resolucion->id)->delete();
                    $tag = array_unique($tag);
                    foreach($tag as $ta){
                        DB::table('resolucion_tag')->insert(array(
                            'resolucion_id' => $resolucion->id,
                            'tag_id' => $ta
                        ));
                    }
                }
            }
            
            return Redirect::route('resolucions.index')->with('message', 'Documento Actualizado.');
        }

        return Redirect::route('resolucions.edit', $id)->withInput()
                                                       ->withErrors($validation)
                                                       ->with('message', 'Error al intentar guardar, inténtelo de nuevo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
        if($control) {
            return Redirect::action($control)->with('message', 'Acceso denegado');
        }
        $this->resolucion->find($id)->delete();
        return Redirect::route('resolucions.index');
    }

}
