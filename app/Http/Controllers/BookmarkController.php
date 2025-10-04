<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarkedTweets = Auth::user()->bookmarks()->latest()->paginate(15);
        return view('tweets.bookmarks', ['tweets' => $bookmarkedTweets]);
    }

    public function store(Tweet $tweet)
    {
        Auth::user()->bookmarks()->attach($tweet->id);
        return back();
    }

    public function destroy(Tweet $tweet)
    {
        Auth::user()->bookmarks()->detach($tweet->id);
        return back();
    }
}