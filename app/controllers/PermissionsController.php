<?php

class PermissionsController extends BaseController {

	/**
	 * Permission Repository
	 *
	 * @var Permission
	 */
	protected $permission;

	public function __construct(Permission $permission)
	{
		$this->permission = $permission;
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
		$permissions = $this->permission->all();
                $permisosasignados = DB::select("SELECT permissions.id as permissionid, permissions.display_name as permissionname, roles.id as roleid, roles.name as rolename
                                        FROM permission_role
                                        INNER JOIN roles ON permission_role.role_id = roles.id
                                        INNER JOIN permissions ON permission_role.permission_id = permissions.id
                                        ORDER BY permissions.id ASC, roles.id ASC");
		return View::make('permissions.index', compact('permissions', 'permisosasignados'));
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
		return View::make('permissions.create');
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
		$input = Input::all();
		$validation = Validator::make($input, Permission::$rules);

		if ($validation->passes())
		{
			$this->permission->create($input);

			return Redirect::route('permissions.index');
		}

		return Redirect::route('permissions.create')
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
		$permission = $this->permission->findOrFail($id);

		return View::make('permissions.show', compact('permission'));
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
		$permission = $this->permission->find($id);

		if (is_null($permission))
		{
			return Redirect::route('permissions.index');
		}
                $roles = Role::lists('name','id');
                $rolespermitidos = DB::select("SELECT roles.id as roleid
                                        FROM permission_role
                                        INNER JOIN permissions ON permission_role.permission_id = permissions.id
                                        INNER JOIN roles ON permission_role.role_id = roles.id
                                        WHERE permission_role.permission_id = ?", array($permission->id));
                $rolespermit = array();
                foreach ($rolespermitidos as $rolp) {
                    $rolespermit[] = $rolp->roleid;
                }
		return View::make('permissions.edit', compact('permission','roles','rolespermit'));
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
                    'display_name' => Input::get('display_name')
                );
                $roles = Input::get('roles');
		$validation = Validator::make($input, Permission::$rules);

		if ($validation->passes())
		{
                        DB::table('permissions')->where('id', $id)->update($input);
                        DB::table('permission_role')->where('permission_role.permission_id','=',$id)->delete();
                        foreach($roles as $rol){
                            DB::table('permission_role')->insert(array(
                                'role_id' => $rol,
                                'permission_id' => $id
                            ));
                        }
			return Redirect::route('permissions.index');
		}

		return Redirect::route('permissions.edit', $id)
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
		$this->permission->find($id)->delete();

		return Redirect::route('permissions.index');
	}

}
