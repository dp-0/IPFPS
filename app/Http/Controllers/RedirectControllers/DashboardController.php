<?php

namespace App\Http\Controllers\RedirectControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        if($user->utype == 'admin')
            return to_route('admin.dashboard');

        // if($user->utype == 'police')
        //     return to_route('police.dasshboard');
    }
}
