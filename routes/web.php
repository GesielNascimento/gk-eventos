<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('Teste direto: Laravel no ar! 🚀', 200);
});
