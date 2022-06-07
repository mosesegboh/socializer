<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use App\Helpers\SocialConnectionHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {    
        $followers = SocialConnectionHelper::instance()->getFollowerIds(Auth::id());

        $tweets = Tweet::whereIn('user_id', $followers)->orWhere('shared_by', '=', Auth::id())->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
    		$view = view('tweet',compact('tweets'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('home')->with('tweets', $tweets);
    }

      /**
     * Show relevant page based on user authentication status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {    
        if (Auth::check()) {
            return redirect()->route('home');
        }   
    }
}
