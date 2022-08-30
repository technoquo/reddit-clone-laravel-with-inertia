<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostShowResource;
use App\Models\Community;
use Inertia\Inertia;

class PostController extends Controller
{
    public function show($community_slug, $slug)
    {
        


        $community = Community::where('slug', $community_slug)->first();

        
        $community_post = Post::with(['comments', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('slug', $slug)->first();

        $post = new PostShowResource($community_post);
        return Inertia::render('Frontend/Posts/Show', compact('community','post'));
    }
}
