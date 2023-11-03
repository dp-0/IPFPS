<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use App\Models\Evidence;
use App\Models\Fir;
use App\Models\Suspect;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalSuspect = Suspect::count();
        $totalEvidence = Evidence::count();
        $totalComplain = Complain::count();
        $totalFir = Fir::count();
        $totalPolice = User::where('utype','police')->count();
        return view('dashboard',[
            'totalUser'=>$totalUser,
            'totalSuspect'=>$totalSuspect,
            'totalEvidence' => $totalEvidence,
            'totalComplain' => $totalComplain,
            'totalFir' => $totalFir,
            'totalPolice' => $totalPolice
        ]);
    }
}
