<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helpers\SocialConnectionHelper;

class TweetController extends Controller
{
    /**
     * Creates a tweet post
     * 
     * @params Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createTweet(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|max:250|regex:/^\s*[a-zA-Z0-9,.!\s]+\s*$/',
        ]);

        $tweet = new Tweet;
        $tweet->body = strip_tags(trim(htmlspecialchars($request->body)));
        $tweet->user_id = Auth::id();
        $tweet->save();
        $request->session()->flash('status', 'Tweet created successfully');
        return redirect()->to('home');
    }

    /**
     * Creates a like for a tweet post
     * 
     * @params Request $request
     * @params Int $id
     * @return Object
     */
    public function likeTweet(Request $request, $id)
    {
        $data = [
            'user_id'=> Auth::id(),
            'tweet_id' => trim(htmlspecialchars($id))
        ];

        $totalLikes = SocialConnectionHelper::instance()->addLIke($data, $id);

        if ( $totalLikes ) return response()->json(['status'=>1,'msg'=>'You have liked the tweet', 'data' => $totalLikes, 'tweetId' => $id]);
    }

    /**
     * Removes the like for a tweet post
     * 
     * @params Request $request
     * @params Int $id
     * @return Object
     */
    public function unlikeTweet(Request $request, $id)
    {
        $totalLikes = SocialConnectionHelper::instance()->removeLIke($id);

        return response()->json(['status'=>1,'msg'=>'You have unliked the tweet', 'data' => $totalLikes, 'tweetId' => $id]);
    }

    /**
     * Add a shared properties to a tweet
     * 
     * @params Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function shareTweet(Request $request)
    {
        Tweet::where('id', $request->input('tweetId'))
                ->update(['shared_by' => Auth::id(), 'shared_by_name' => Auth::user()->name]);

        return redirect()->to('home');  
    }
}
