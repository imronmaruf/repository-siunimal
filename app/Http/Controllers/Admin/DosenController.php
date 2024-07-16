<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dataDosen = Dosen::all();
        return view('admin.data-dosen.index', compact('dataDosen'));
    }
}
