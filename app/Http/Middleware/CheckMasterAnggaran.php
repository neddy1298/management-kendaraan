<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MasterAnggaran;

class CheckMasterAnggaran
{
    public function handle(Request $request, Closure $next)
    {
        if (MasterAnggaran::count() == 0 && !$request->is('anggaran/create') && !$request->is('anggaran')) {
            return redirect()->route('anggaran.create');
        }
        return $next($request);
    }
}