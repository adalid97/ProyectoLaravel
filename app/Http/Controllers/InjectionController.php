<?php

namespace App\Http\Controllers;

class InjectionController extends Controller
{
    public function showMessage()
    {
        return "Se ha incluido la dependencia correctamente";
    }
}
