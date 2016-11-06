<?php

namespace Brood\Providers;

use Brood\Services\ValidationExtender;
use Illuminate\Support\ServiceProvider;

class ValidationExtenderServiceProvider extends ServiceProvider {

    public function register() {}

    public function boot() {
        $this->app->validator->resolver( function( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
            return new ValidationExtender( $translator, $data, $rules, $messages, $customAttributes );
        } );
    }

}