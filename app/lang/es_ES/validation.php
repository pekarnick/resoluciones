<?php 
 
 return array(
 
   /*
   |--------------------------------------------------------------------------
   | Validation Language Lines
   |--------------------------------------------------------------------------
   |
   | The following language lines contain the default error messages used
   | by the validator class. Some of the rules contain multiple versions,
   | such as the size (max, min, between) rules. These versions are used
   | for different input types such as strings and files.
   |
   | These language lines may be easily changed to provide custom error
   | messages in your application. Error messages for custom validation
   | rules may also be added to this file.
   |
   */
 
   "accepted"       => "El campo :attribute debe ser aceptado.",
   "active_url"     => "El campo :attribute no es una URL válida.",
   "after"          => "El campo :attribute debe ser una fecha posterior a :date.",
   "alpha"          => "El campo :attribute debe contener únicamente letras.",
   "alpha_dash"     => "El campo :attribute debe contener únicamente letras, números y guiones.",
   "alpha_num"      => "El campo :attribute debe contener únicamente letras y números.",
   "array"          => "El campo :attribute debe tener elementos seleccionados.",
   "before"         => "El campo :attribute debe ser una fecha anterior a :date.",
   "between"        => array(
     "numeric" => "El campo :attribute debe estar entre :min - :max.",
     "file"    => "El campo :attribute debe tener entre :min - :max kilobytes.",
     "string"  => "El campo :attribute debe tener entre :min - :max caracteres.",
   ),
   "confirmed"      => "La confirmación del campo :attribute es diferente.",
   "count"          => "El campo :attribute debe tener :count elementos seleccionados.",
   "countbetween"   => "El campo :attribute debe tener entre :min y :max elementos seleccionados.",
   "countmax"       => "El campo :attribute debe tener menos de :max elementos seleccionados.",
   "countmin"       => "El cmapo :attribute debe tener al menos :min elementos seleccionados.",
   "different"      => "El campo :attribute y el campo :other deben ser diferentes.",
   "email"          => "El formato del campo :attribute no es válido.",
   "exists"         => "El campo :attribute seleccionado no es válido.",
   "image"          => "El campo :attribute debe ser una imagen.",
   "in"             => "El campo :attribute seleccionado no es válido.",
   "integer"        => "El campo :attribute debe ser un número entero.",
   "ip"             => "El campo :attribute debe ser una dirección IP válida.",
   "match"          => "El formato del campo :attribute no es válido.",
   "max"            => array(
     "numeric" => "El campo :attribute debe ser menor que :max.",
     "file"    => "El campo :attribute debe tener menos que :max kilobytes.",
     "string"  => "El campo :attribute debe tener menos de :max caracteres.",
   ),
   "mimes"          => "El campo :attribute debe ser un fichero del tipo: :values.",
   "min"            => array(
     "numeric" => "El campo :attribute debe ser al menos :min.",
     "file"    => "El campo :attribute debe tener al menos :min kilobytes.",
     "string"  => "El campo :attribute debe tener al menos :min caracteres.",
   ),
   "not_in"         => "El campo :attribute seleccionado no es válido.",
   "numeric"        => "El campo :attribute debe ser un número.",
   "required"       => "El campo :attribute es obligatorio.",
   "same"           => "El campo :attribute y el campo :other deben ser iguales.",
   "size"           => array(
     "numeric" => "El campo :attribute debe ser :size.",
     "file"    => "El campo :attribute debe tener :size kilobytes.",
     "string"  => "El campo :attribute debe tener :size caracteres.",
   ),
   "unique"         => "El :attribute ya existe.",
   "url"            => "El formato del campo :attribute no es válido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
