<?php

class Tag extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
            'nombre' => 'required'
        );
        
        public function resolucions() {
            return $this->belongsToMany('Resolucion');
        }
}
