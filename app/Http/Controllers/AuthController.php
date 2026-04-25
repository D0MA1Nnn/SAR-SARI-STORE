<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $startTime = microtime(true);
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }
        
        Log::info('Auth attempt completed', ['time' => microtime(true) - $startTime]);

        $sessionStart = microtime(true);
        $request->session()->regenerate();
        Log::info('Session regenerate completed', ['time' => microtime(true) - $sessionStart]);

        $logStart = microtime(true);
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'login',
            'description' => 'User logged in.',
            'ip_address' => $request->ip(),
        ]);
        Log::info('Activity log created', ['time' => microtime(true) - $logStart]);

        $totalTime = microtime(true) - $startTime;
        Log::info('TOTAL LOGIN PROCESSING TIME', ['time' => $totalTime]);
        
        // Check if redirect is slow
        Log::info('Redirecting to dashboard');
        
        return redirect()->route('dashboard')->with('success', 'Welcome back!');
    }

    public function logout(Request $request): RedirectResponse
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'logout',
            'description' => 'User logged out.',
            'ip_address' => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}