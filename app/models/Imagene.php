<?php

class Resolucion extends Eloquent {
	protected $guarded = array();
        
        public function resolucions() {
            return $this->hasMany('Imagene');
        }
}
