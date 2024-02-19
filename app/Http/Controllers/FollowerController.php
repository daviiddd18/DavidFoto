<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = \Auth::user();

        $followers = $user->followers()->paginate(5);
        $following = $user->following()->paginate(5);

        return view('user.follow', [
            'followers' => $followers,
            'following' => $following
        ]);

    }

    public function follow($followed_user_id)
    {

        $user = \Auth::user();

        $isset_follower = Follower::where('user_id', $user->id)->where('followed_user_id', $followed_user_id)->count();

        if ($isset_follower == 0) {
            $follower = new Follower();
            $follower->user_id = $user->id;
            $follower->followed_user_id = (int) $followed_user_id;

            $follower->save();
            return response()->json([
                'following' => true,
                'follower' => $follower,
                'message' => 'Has seguido a esta persona'
            ]);

        } else {
            echo "Ya sigues a esta persona.";
        }
    }

    public function unfollow($followed_user_id)
    {

        $user = \Auth::user();

        $follower = Follower::where('user_id', $user->id)->where('followed_user_id', $followed_user_id)->first();

        if ($follower) {

            $follower->delete();

            return response()->json([
                'follower' => $follower,
                'message' => 'Has dejado de seguir'
            ]);

        } else {
            echo "El follower no existe";
        }

    }

}
