<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Helpers\SocialConnectionHelper;
use Validator;

class UserController extends Controller
{
    /**
     * View Followers for logged in User
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewFollowers()
    {
        $followers = Follower::where('user_id', Auth::id())->get();

        $followersName =  [];
        foreach ($followers as $follower) {
            $user = User::find($follower->followed_by);
            $follower_info = [$user->id, $user->name];
            array_push($followersName, $follower_info);
        }
        
        return view('followers')->with('followersName', $followersName);
    }

    /**
     * View the followings for logged in User
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewFollowing()
    {
        $following = Follower::where('followed_by', Auth::id())->get();
        
        return view('following')->with('following', $following);  
    }

    /**
     * View the followers for a particular User
     * 
     * @params Int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewUserFollowers($id)
    {
        $followers = Follower::where('user_id', $id)->get();

        $followersName =  [];
        foreach ($followers as $follower) {
            $user = User::find($follower->followed_by);
            $follower_info = [$user->id, $user->name];
            array_push($followersName, $follower_info);
        }
        
        return view('followers')->with('followersName', $followersName);
    }

    /**
     * View the followings for a particular User
     * 
     * @params Int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewUserFollowing($id)
    {
        $following = Follower::where('followed_by', $id)->get();
        
        return view('following')->with('following', $following);
    }

    /**
     * Search for a particular user
     * 
     * @params Request $request
     */
    public function searchFriend(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'searchWord'=>'regex:/(^[A-Za-z0-9 ]+$)+/|max:125',
        ]);

        if(!$validator->passes()) return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);

        $data = User::where('name', 'like', '%'.trim($request->get('query')).'%')
                        ->orderBy('id', 'desc')
                        ->get();
        
        $output = '<ul class="dropdown-menu" style="display:block; position:relative;">';

        foreach ($data as $row)
        {
            $output .= '<li><a href="#">'.$row->name.'</a></li>';
        }

        $output .= '</ul>';

        if($row->name) {
            echo $output;
        }  
    }

    /**
     * View the profile page for a particular User
     * 
     * @params Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewUser(Request $request)
    {
        if(empty($request->get('searchWord'))) {
            abort(404);
        }

        $user = User::where('name',trim($request->get('searchWord')))->first();

        $followStatus = SocialConnectionHelper::instance()->checkFollowStatus($user);

        if (gettype($user) !== 'object') {
            return view('no-user');
        }

        $tweets = Tweet::where('user_id',trim($user->id))->orWhere('shared_by', '=', $user->id)->paginate(10);

        if ($request->ajax()) {
    		$view = view('user-tweet',compact('tweets'))->render();
            return response()->json(['html'=>$view]);
        }

        return view('user')->with(['user'=> $user, 'tweets' => $tweets, 'followStatus' => $followStatus]);
    }

    /**
     * Follow a particular user
     * 
     * @params Request $request
     * @params Int $id
     * @return Object
     */
    public function followUser(Request $request, $id)
    {
        $data = [
            'user_id' => $id,
            'followed_by' => Auth::id(),
        ];

        $totalFollowers = SocialConnectionHelper::instance()->addFollower($data, $id);

        if ($totalFollowers) {
            if ( $totalFollowers ) return response()->json(['status'=>1,'msg'=>'You have sucessfully followed', 'data' => $totalFollowers, 'userId' => $id]);
        }
    }

     /**
     * Unfollow a particular user
     * 
     * @params Request $request
     * @params Int $id
     * @return Object
     */
    public function unfollowUser(Request $request, $id)
    {
        $totalFollowers = SocialConnectionHelper::instance()->removeFollower($id);
      
        return response()->json(['status'=>1,'msg'=>'You have sucessfully Unfollowed', 'data' => $totalFollowers, 'userId' => $id]);
    }
}
