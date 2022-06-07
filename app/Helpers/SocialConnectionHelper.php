<?php
namespace App\Helpers;

use App\Models\Follower;
use App\Models\User;
use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class SocialConnectionHelper
{
    /**
     * Add a new follower for a user
     * 
     * @params Array $data
     * @params Int $userId
     * @return Int
     */
    public function addFollower($data, $userId)
    {
        Follower::insert( $data);

        User::adjustFollowStatus($userId,Auth::id(), 1, true);
        
        return $totalFollowers = Follower::getCount(['user_id', 'followed_by'], $userId);
    }

    /**
     * Removes a follower for a user
     * 
     * @params Int $userId
     * @params Bool $increase
     * @return Int
     */
    public function removeFollower($userId, $increase=false)
    {
        Follower::where(['followed_by'=> Auth::id(), 'user_id' => $userId])->delete();

        User::adjustFollowStatus($userId,Auth::id(), 1, $increase);

        return $totalFollowers =  Follower::getCount(['user_id', 'followed_by'], $userId);
    }

    /**
     * Add a new like to a tweet
     * 
     * @params Array $data
     * @params Int $tweetId
     * @return Int
     */
    public function addLIke($data, $tweetId)
    {
        Like::insert($data);
    
        Tweet::where('id', $tweetId)->increment('likes');

        return Like::where('tweet_id', $tweetId)->count(); 
    }

     /**
     * Remove like for a tweet
     * 
     * @params Int $tweetId
     * @return Int
     */
    public function removeLIke($tweetId)
    {
        Like::where(['user_id'=> Auth::id(), 'tweet_id' => $tweetId])->delete();

        Tweet::where('id', $tweetId)->decrement('likes');

        return Like::where('tweet_id', $tweetId)->count();
    }

     /**
     * Check if the currently authenticated user is following the user passed
     * 
     * @params Int $user
     * @return Bool
     */
    public function checkFollowStatus($user)
    {
        if (gettype($user) !== 'object') {
            return null;
        }

        if (Auth::id() !== $user->id) {
            $followStatus = Follower::where([['user_id', $user->id],['followed_by', Auth::id()]])->first();
            if ($followStatus) {
                return true;
            }
            return false;
        }
        return null;
    }

    /**
     * Get the followers for a user
     * 
     * @params Int $tweetId
     * @return Array
     */
    public function getFollowerIds($userId)
    {
        $followers = Follower::where('followed_by', $userId )->get();

        $allFollowerIds = array(Auth::id());

        foreach ($followers as $follower) {
            array_push($allFollowerIds, $follower->user_id);
        }

        return $allFollowerIds;
    }

    /**
     * Add a new like to a tweet
     * 
     * @params Int $tweetId
     * @return Bool
     */
    public static function checkLikeStatus($tweetId)
    {
        $likeStatus = Like::where('tweet_id', $tweetId)
            ->where('user_id', Auth::id())
            ->count();
        if ($likeStatus > 0) {
            return true;
        }
        return false;
    }

     /**
     * Add new instance of current class
     */
    public static function instance()
    {
        return new SocialConnectionHelper();
    }
}