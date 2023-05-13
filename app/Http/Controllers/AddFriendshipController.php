<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddFriend;
use App\Models\User;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AddFriendshipController extends Controller
{
   
    const _PER_PAGE = 5;
    private $user;
    private $friend;
     private $avatar;
    public function __construct(){
        $this->middleware('auth');
        $this -> user = new User();
        $this -> avatar = new Avatar();
        $this -> friend = new AddFriend();
    }

    public function getUser(){
        $keywords = '';
        $users= $this->user->get( self::_PER_PAGE, $keywords);
        return view('home', compact('users'));
    }
    public function addFriend(Request $request)
    {
        $user_request = Auth::user()->id;
        $acceptor = $request->input('user_id');
        $addFriend = $this -> friend;
        $addFriend -> user_request = $user_request;
        $addFriend -> acceptor = $acceptor;
        $addFriend -> save();
       
    }

    public function deleteFriend(Request $request){
        $acceptor = $request->input('user_id');
        $delete = DB::table('addfriend')->where('acceptor', $acceptor)->orWhere('user_request',$acceptor)->delete();
        //   return back();
    }

    public function friendRequest(Request $request){
        $user_id = Auth::user()->id;
        $users = DB::table('addfriend')
        ->join('users', 'addfriend.user_request', '=', 'users.id')
        ->leftJoin('avatar', 'avatar.user_id', '=', 'users.id')
        ->where('addfriend.status', '=', null)
        ->where('addfriend.acceptor', '=', $user_id)
        ->select('users.id', 'users.name','avatar.image_avatar') 
        ->get();
        $avatar_users = $this->avatar->users($user_id);
        return view('clients.friendRequest', compact('users','avatar_users'));
    }

    public function confirmFriend(Request $request){
        $user_request = $request->input('user_id');
        $acceptor = Auth::user()->id;
        $data = [
            'acceptor' => Auth::user()->id,
            'user_request' =>  $user_request,
            'status' => 1
        ];
        $confirm = DB::table('addfriend')->where('acceptor',$acceptor)->where('user_request',$user_request)->update($data);
    }

    public function friend(Request $request){

        $user_id = Auth::user()->id;
        $users_acceptor = DB::table('addfriend')
        ->join('users', 'addfriend.user_request', '=', 'users.id')
        ->leftJoin('avatar', 'avatar.user_id', '=', 'users.id')
        ->where('addfriend.acceptor', '=', $user_id)
        ->where('addfriend.status', '!=', null)
        ->select('users.id', 'users.name', 'avatar.image_avatar') 
        ->get();
        $users_request = DB::table('addfriend')
        ->join('users', 'addfriend.acceptor', '=', 'users.id')
        ->leftJoin('avatar', 'avatar.user_id', '=', 'users.id')
        ->where('addfriend.user_request', '=', $user_id)
        ->where('addfriend.status', '!=', null)
        ->select('users.id', 'users.name','avatar.image_avatar') 
        ->get();
         $avatar_users = $this->avatar->users($user_id);
        return view('clients.friend', compact('users_acceptor', 'users_request','avatar_users'));
    }

}