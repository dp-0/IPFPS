<?php

namespace App\Http\Controllers\RedirectControllers;

use App\Http\Controllers\Controller;
use App\Models\Complainants;
use App\Models\Suspect;
use App\Models\User;
use Illuminate\Http\Request;

class ImageDetailsController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();
        if (empty($data)) {
            return redirect()->route('search.imagesearch');
        }
        $search_path = base64_decode($data['search']);
        $image = str_replace('search/' . base64_decode($data['uuid']) . '/', '', $search_path);
        // $img = 'profile-photos/'. $image;
        // $user = User::where('profile_photo_path',$img)->first();
        // if($user){
        //     return redirect()->route('profile.show');
        // }
        $suspects = null;
        $complinants = null;
        $img = 'suspects-photo/' . $image;
        $suspects = Suspect::where('photo', $img)->first();
        if ($suspects) {
            return redirect()->route('admin.fir.suspect.profile', $suspects->id);
        }
        $img = 'complainant-photo/' . $image;
        $complinants = Complainants::where('profile_photo_path', $img)->first();
        if ($complinants) {
            return redirect()->route('admin.fir.complinants.details',$complinants->id);
        }
        abort(401);
    }
}
