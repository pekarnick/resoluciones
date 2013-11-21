@extends('layouts.login')

@section('main')

<form method="POST" action="{{{ Confide::checkAction('UserController@do_login') ?: URL::to('/user/login') }}}" accept-charset="UTF-8">
        <div class="login-fields">
                <div class="field">
                        <label for="username">Usuario:</label>
                        <input class="form-control login username-field" tabindex="1" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                </div> <!-- /field -->

                <div class="field">
                        <label for="password">Contraseña:</label>
                        <input class="login password-field" tabindex="2" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                </div> <!-- /password -->
                
        </div> <!-- /login-fields -->

        <div class="login-actions">
                <button tabindex="3" type="submit" class="button btn btn-warning btn-large">Ingresar</button>
        </div> <!-- .actions -->
</form>
@stop