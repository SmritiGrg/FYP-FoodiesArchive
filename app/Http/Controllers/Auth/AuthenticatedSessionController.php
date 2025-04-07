<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\FoodPost;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $url = "/";

        if ($request->user()->role === 'admin') {
            $url = "/admin";
        }

        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function userCalendar($month = null, $year = null)
    {
        $userId = Auth::id();

        // Set default month and year if not provided
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        // Get the first and last day of the month
        $firstDay = Carbon::create($year, $month, 1);
        $lastDay = $firstDay->copy()->endOfMonth();

        // Get posts for the user within the month
        $posts = FoodPost::where('user_id', $userId)
            ->whereBetween('created_at', [$firstDay, $lastDay])
            ->orderBy('created_at', 'ASC')
            ->get()
            ->groupBy(function ($post) {
                return $post->created_at->format('d'); // Group posts by day of the month
            });

        return view('FoodiesArchive.calendar', compact('month', 'year', 'firstDay', 'lastDay', 'posts'));
    }
}
