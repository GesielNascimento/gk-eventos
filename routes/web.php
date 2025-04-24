<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('✅ Laravel está VIVO no Render! Sem view, sem erro! 🚀', 200);
});
