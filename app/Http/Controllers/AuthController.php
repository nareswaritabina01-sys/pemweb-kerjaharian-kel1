<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterPemberiKerjaRequest;
use App\Http\Requests\Auth\RegisterPencariKerjaRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if (! $user->status_aktif) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun Anda telah dinonaktifkan. Hubungi admin.',
            ]);
        }

        return redirect()
            ->to($this->authService->redirectPath($user))
            ->with('success', 'Selamat datang, ' . $user->nama . '.');
    }

    public function showRegisterChoice(): View
    {
        return view('auth.register-choice');
    }

    public function showRegisterPemberiKerja(): View
    {
        return view('auth.register-pemberi-kerja');
    }

    public function showRegisterPencariKerja(): View
    {
        return view('auth.register-pencari-kerja');
    }

    public function registerPemberiKerja(RegisterPemberiKerjaRequest $request): RedirectResponse
    {
        $user = $this->authService->registerPemberiKerja($request->validated());

        Auth::login($user);

        return redirect()
            ->to($this->authService->redirectPath($user))
            ->with('success', 'Registrasi berhasil. Selamat datang, ' . $user->nama . '.');
    }

    public function registerPencariKerja(RegisterPencariKerjaRequest $request): RedirectResponse
    {
        $user = $this->authService->registerPencariKerja($request->validated());

        Auth::login($user);

        return redirect()
            ->to($this->authService->redirectPath($user))
            ->with('success', 'Registrasi berhasil. Selamat datang, ' . $user->nama . '.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}