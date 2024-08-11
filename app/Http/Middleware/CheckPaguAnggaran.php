<?php

namespace App\Http\Middleware;

use App\Models\PaguAnggaran;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPaguAnggaran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (PaguAnggaran::count() == 0 && !$request->is('paguAnggaran') && !$request->is('paguAnggaran/*')) {
            return to_route('paguAnggaran.index')->with('error', 'Silahkan buat Pagu Anggaran terlebih dahulu.');
        }
        return $next($request);
    }
}
