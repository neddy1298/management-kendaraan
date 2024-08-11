<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MasterAnggaran;

class CheckMasterAnggaran
{
    public function handle(Request $request, Closure $next)
    {
        if (MasterAnggaran::count() == 0 && !$request->is('masterAnggaran') && !$request->is('masterAnggaran/*')) {
            return to_route('masterAnggaran.index')->with('error', 'Silahkan buat Master Anggaran terlebih dahulu.');
        }
        return $next($request);
    }
}
