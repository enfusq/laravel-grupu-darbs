<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function search(Request $request){
        $term = $request->input['term'];
        $response = Product::where('name', 'like', '%' . $term . '%')->get();
        return $response->json(201);
    }
}
