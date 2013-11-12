<?php

class Nombre extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'nombre' => 'required',
		'documento' => 'required'
	);
}
