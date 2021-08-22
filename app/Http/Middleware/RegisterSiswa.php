<?php

namespace App\Http\Middleware;

use App\Models\Siswa;
use Closure;
use Illuminate\Http\Request;

class RegisterSiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cek_profil_siswa = Siswa::where('id_user', auth()->id());
        if ($cek_profil_siswa->count() > 0) {
            return $next($request);
        }
        return redirect()->route('siswa.profil');
    }
}
