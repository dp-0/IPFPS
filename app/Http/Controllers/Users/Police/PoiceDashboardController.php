<?php

namespace App\Http\Controllers\Users\Police;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoiceDashboardController extends Controller
{

   public function index(){
   
    return view("PoliceDashboard");
   }
}
