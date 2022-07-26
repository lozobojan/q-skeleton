<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    /**
     * Display user profile view with basic view
     * @return Application|Factory|View
     */
    public function displayProfile(): View|Factory|Application
    {
        return view('profile', [
            "user" => Cache::tags('auth')->get('userDetails'),
        ]);
    }
}
