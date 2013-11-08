<?php

class Resolucion extends Eloquent {
	protected $guarded = array();
        public function tipo() {
            return $this->belongsTo('Tipo', 'tipo_id');
        }
        public function tags() {
            return $this->belongsToMany('Tag');
        }
	public static $rules = array(
            'numero' => 'required',
            'iniciales' => 'required',
            'fecha' => 'required',
            'observaciones' => 'required'
	);
        public static $rules2 = array(
            'numero' => 'required',
            'fecha' => 'required',
            'observaciones' => 'required'
	);
}
