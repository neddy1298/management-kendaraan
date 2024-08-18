<?php

namespace App\Http\Middleware;

use App\Models\PaguAnggaran;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CheckPaguAnggaran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $paguAnggaranCount = Cache::remember('pagu_anggaran_count', 60, function () {
            return PaguAnggaran::count();
        });
    
        if ($paguAnggaranCount == 0 && !$request->is('paguAnggaran') && !$request->is('paguAnggaran/*')) {
            return to_route('paguAnggaran.index')->with('error', 'Silahkan buat Pagu Anggaran terlebih dahulu.');
        }
    
        return $next($request);
    }
}
