<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {    
        Gate::authorize('haveaccess', 'access.roles');
        return view('app');
    }
}
