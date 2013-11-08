<?php

class TagsController extends BaseController {

	/**
	 * Tag Repository
	 *
	 * @var Tag
	 */
	protected $tag;

	public function __construct(Tag $tag)
	{
		$this->tag = $tag;
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
		$tags = $this->tag->all();

		return View::make('tags.index', compact('tags'));
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
		return View::make('tags.create');
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
                $input['nombre'] = ucfirst(strtolower(trim($input['nombre'])));
		$validation = Validator::make($input, Tag::$rules);

		if ($validation->passes())
		{
			$this->tag->create($input);

			return Redirect::route('tags.index');
		}

		return Redirect::route('tags.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
		$tag = $this->tag->findOrFail($id);

		return View::make('tags.show', compact('tag'));
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
		$tag = $this->tag->find($id);

		if (is_null($tag))
		{
			return Redirect::route('tags.index');
		}

		return View::make('tags.edit', compact('tag'));
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
		$validation = Validator::make($input, Tag::$rules);

		if ($validation->passes())
		{
			$tag = $this->tag->find($id);
			$tag->update($input);

			return Redirect::route('tags.index');
		}

		return Redirect::route('tags.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
		$this->tag->find($id)->delete();

		return Redirect::route('tags.index');
	}

}
