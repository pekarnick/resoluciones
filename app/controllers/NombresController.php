<?php

class NombresController extends BaseController {

	/**
	 * Nombre Repository
	 *
	 * @var Nombre
	 */
	protected $nombre;

	public function __construct(Nombre $nombre)
	{
		$this->nombre = $nombre;
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
		$nombres = $this->nombre->all();

		return View::make('nombres.index', compact('nombres'));
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
		return View::make('nombres.create');
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
		$validation = Validator::make($input, Nombre::$rules);

		if ($validation->passes())
		{
			$this->nombre->create($input);

			return Redirect::route('nombres.index');
		}

		return Redirect::route('nombres.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'Ocurrieron algunos errores, inténtelo de nuevo.');
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
		$nombre = $this->nombre->findOrFail($id);

		return View::make('nombres.show', compact('nombre'));
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
		$nombre = $this->nombre->find($id);

		if (is_null($nombre))
		{
			return Redirect::route('nombres.index');
		}

		return View::make('nombres.edit', compact('nombre'));
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
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Nombre::$rules);

		if ($validation->passes())
		{
			$nombre = $this->nombre->find($id);
			$nombre->update($input);

			return Redirect::route('nombres.index');
		}

		return Redirect::route('nombres.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Ocurrieron algunos errores, inténtelo de nuevo.');
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
		$this->nombre->find($id)->delete();

		return Redirect::route('nombres.index');
	}

}
