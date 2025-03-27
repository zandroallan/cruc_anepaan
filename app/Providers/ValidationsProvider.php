<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Validator;

class ValidationsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('curp', function($attribute, $value, $parameters) {
            $value= strtoupper($value);
            return preg_match('/^[A-Z]{1}[AEIOUX]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/', $value);
        });
        Validator::extend('rfc', function($attribute, $value, $parameters) {
            $value= strtoupper($value);
            return preg_match('/^([A-Z]{3,4}\d{6}[A-Z0-9]{0,3})$/', $value);
        });
        Validator::extend('not_zero', function($attribute, $value, $parameters) {
            return preg_match('/^[1-9][0-9]*$/', $value);
        });      

        /*Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new \App\Validators\CustomValidator($translator, $data, $rules, $messages);
        });   */       
    }

    public function register()
    {
        //
    }
}
