<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PermisosController extends Controller
{
    public function index()
    {
        Gate::authorize('haveaccess', 'access.permisos');
        return view('app');
    }
}
