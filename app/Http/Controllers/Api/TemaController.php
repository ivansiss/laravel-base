<?php

namespace App\Http\Controllers\Api;

use App\Models\Tema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemaController extends Controller
{
    public function index(){
        $tema =  Tema::orderBy('id', 'Asc')->get();
        return response()->json($tema, 200);
    }
}
