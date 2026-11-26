<?php

namespace App\Http\Controllers;

use App\Models\Kos;

class AdminKosController extends Controller
{
    public function index()
    {
        $kos = Kos::with('owner')
            ->latest()
            ->paginate(10);

        return view('admin.kos.index', compact('kos'));
    }
}
