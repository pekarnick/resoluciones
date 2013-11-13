<?php

class Tweet extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'nombre' => 'required',
		'documento' => 'required'
	);
}
