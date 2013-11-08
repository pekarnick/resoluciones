<?php

class RolesController extends BaseController {

	/**
	 * Role Repository
	 *
	 * @var Role
	 */
	protected $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
                $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
                if($control) {
                    return Redirect::action($control)->with('message', 'Acceso denegado');
                }
		$roles = $this->role->all();

		return View::make('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
                $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
                if($control) {
                    return Redirect::action($control)->with('message', 'Acceso denegado');
                }
		return View::make('roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
                $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
                if($control) {
                    return Redirect::action($control)->with('message', 'Acceso denegado');
                }
                $input = array(
                    'name' => Input::get('name'),
                );
		$validation = Validator::make($input, Role::$rules);

		if ($validation->passes())
		{
                        DB::table('roles')->insert(array(
                            'name' => $input['name']
                        ));
                        
			return Redirect::route('roles.index');
		}

		return Redirect::route('roles.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'Ocurrio un error al intentar guardar, inténtelo de nuevo.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
                $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
                if($control) {
                    return Redirect::action($control)->with('message', 'Acceso denegado');
                }
		$role = $this->role->findOrFail($id);

		return View::make('roles.show', compact('role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
                $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
                if($control) {
                    return Redirect::action($control)->with('message', 'Acceso denegado');
                }
		$role = $this->role->find($id);

		if (is_null($role))
		{
			return Redirect::route('roles.index');
		}

		return View::make('roles.edit', compact('role'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
                $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
                if($control) {
                    return Redirect::action($control)->with('message', 'Acceso denegado');
                }
		$input = array(
                    'name' => Input::get('name'),
                );
		$validation = Validator::make($input, Role::$rules);

		if ($validation->passes())
		{
			DB::table('roles')->where('id', $id)
                                          ->update(array(
                                                'name' => $input['name']
                                          ));
			return Redirect::route('roles.index');
		}

		return Redirect::route('roles.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Ocurrio un error al intentar guardar, inténtelo de nuevo.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
                $control = $this->controlar_usuario(Route::currentRouteName(), null, null, 'ResolucionsController@index');
                if($control) {
                    return Redirect::action($control)->with('message', 'Acceso denegado');
                }
		$this->role->find($id)->delete();

		return Redirect::route('roles.index');
	}

}
