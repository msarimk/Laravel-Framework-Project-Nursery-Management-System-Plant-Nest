<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tool; // Import your Tool model
use App\Models\Plant;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->input('query');
    
        // $tools = Tool::where('name', 'like', '%' . $query . '%')->get();
        // $plants = Plant::where('name', 'like', '%' . $query . '%')->get();

        $tools = Tool::where('Name', '=', $query)->orWhere('Name', 'LIKE', $query . '%')->get();
        $plants = Plant::where('Name', '=', $query)->orWhere('Name', 'LIKE', $query . '%')->get();
    
        return view('web.search-results', compact('tools', 'plants'));
    }
}
