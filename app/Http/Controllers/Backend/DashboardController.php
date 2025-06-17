<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return response()->view('backend.pages.dashboard')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function logout(Request $request)
    {
        // Logout from admin guard
        Auth::guard('admin')->logout();

        // Clear all session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear specific session data
        session()->forget('employee');

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }
}
