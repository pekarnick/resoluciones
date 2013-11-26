<?php

class TiposController extends BaseController {

	/**
	 * Tipo Repository
	 *
	 * @var Tipo
	 */
	protected $tipo;

	public function __construct(Tipo $tipo)
	{
		$this->tipo = $tipo;
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
		$tipos = $this->tipo->all();

		return View::make('tipos.index', compact('tipos'));
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
		return View::make('tipos.create');
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
		$validation = Validator::make($input, Tipo::$rules);

		if ($validation->passes())
		{
			$this->tipo->create($input);

			return Redirect::route('tipos.index');
		}

		return Redirect::route('tipos.create')
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
		$tipo = $this->tipo->findOrFail($id);

		return View::make('tipos.show', compact('tipo'));
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
		$tipo = $this->tipo->find($id);

		if (is_null($tipo))
		{
			return Redirect::route('tipos.index');
		}

		return View::make('tipos.edit', compact('tipo'));
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
		$validation = Validator::make($input, Tipo::$rules);

		if ($validation->passes())
		{
			$tipo = $this->tipo->find($id);
			$tipo->update($input);

			return Redirect::route('tipos.index');
		}

		return Redirect::route('tipos.edit', $id)
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
		$this->tipo->find($id)->delete();

		return Redirect::route('tipos.index');
	}

}
