<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostShowResource;

class PostController extends Controller
{
    public function show($community_slug, $slug)
    {
        


        $community = Community::where('slug', $community_slug)->first();

        
        $community_post = Post::with(['comments', 'postVotes' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->where('slug', $slug)->first();

        $post = new PostShowResource($community_post);

        $posts = PostResource::collection($community->posts()->orderBy('votes', 'desc')->take(6)->get());

        $can_update = Auth::user()->can('update', $community_post);
        $can_delete = Auth::user()->can('delete', $community_post);
        
        return Inertia::render('Frontend/Posts/Show', compact('community','post', 'posts', 'can_update', 'can_delete'));
    }
}
