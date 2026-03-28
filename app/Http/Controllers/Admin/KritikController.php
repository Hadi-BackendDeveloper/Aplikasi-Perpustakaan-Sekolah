<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kritik;

class KritikController extends Controller
{
    public function index()
    {
        $data = Kritik::latest()->paginate(10);

        return view('admin.kritik.index', compact('data'));
    }
}