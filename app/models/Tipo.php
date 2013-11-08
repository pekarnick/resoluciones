<?php

class Tipo extends Eloquent {
	protected $guarded = array();
        
        public function resolucion(){
            return $this->hasMany('Resolucion','tipo_id');
        }
        public static $rules = array(
		'nombre' => 'required'
	);
        
}
