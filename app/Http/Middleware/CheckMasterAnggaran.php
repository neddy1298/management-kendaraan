<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MasterAnggaran;
use Illuminate\Support\Facades\Cache;

class CheckMasterAnggaran
{
    public function handle(Request $request, Closure $next)
    {
        $masterAnggaranCount = Cache::remember('master_anggaran_count', 60, function () {
            return MasterAnggaran::count();
        });

        if ($masterAnggaranCount == 0 && !$request->is('masterAnggaran') && !$request->is('masterAnggaran/*')) {
            return to_route('masterAnggaran.index')->with('error', 'Silahkan buat Master Anggaran terlebih dahulu.');
        }

        return $next($request);
    }
}
