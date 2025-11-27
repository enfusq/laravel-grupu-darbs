<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function search(Request $request){
        $term = $request->input['term'];
        $response = Product::where('name', 'like', '%' . $term . '%')->get();
        return $response->json(201);
    }

    public function addTags(Request $request, Product $product){
        $request->validate([
            'tags' => 'string',
        ]);
        $tagNames = array_map('trim', explode(",", $request->tags));
        $tags = collection();
        foreach ($tagNames as $tagName){
            if(!empty($tagName)){
                $tags->push(Tag::firstOrCreate(['name'=> $tagName]));
            }
        }
        $product->tags()->syncWithoutDetaching($tags);
    }
}
