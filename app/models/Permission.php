<?php

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission {
    public static $rules = array(
        'name' => 'required|between:4,255',
        'display_name' => 'required|between:4,255'
    );
}