<?php

namespace App\Http\Middleware;

use App\Models\Guru;
use Closure;
use Illuminate\Http\Request;

class RegisterGuru
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
        $cek_profil_guru = Guru::where('id_user', auth()->id());
        if ($cek_profil_guru->count() > 0) {
            return $next($request);
        }
        return redirect()->route('guru.profil');
    }
}
