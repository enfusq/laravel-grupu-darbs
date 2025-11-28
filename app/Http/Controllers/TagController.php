<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Product;

class TagController extends Controller
{
    public function search(Request $request){
        $term = $request->input('term');
        $tags = Tag::select('name')->where('name', 'like', '%' . $term . '%')->limit(10)->get()->pluck('name');
        return response()->json($tags);
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
