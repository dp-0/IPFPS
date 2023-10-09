<?php

namespace App\Http\Controllers;

use App\Models\ImageSearch;
use Illuminate\Support\Facades\Log;

class ImageSearchResultController extends Controller
{
    public function index(){
        $data = request()->all();
        $data = $data['data'];
        if (!isset($data['pin'])) abort(403);

        if ($data['pin'] != config('ipfps.face-search-pin')) {
            abort(403);
        }
        unset($data['pin']);
        ImageSearch::where('uuid', $data['uuid'])->update([
            'result' => $data['matches'],
            'search_percentage'=>$data['search_percentage'],
            'status' => ($data['status'] == 'success')?'success':'pending'
        ]);
    }
}
