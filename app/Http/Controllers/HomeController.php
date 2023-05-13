<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Avatar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $post;
    private $avatar;
    const _PER_PAGE = 55;
    public function __construct()
    {
        $this->middleware('auth');
        $this -> post = new Post;
        $this -> avatar = new Avatar;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    public function index()
    {
        $user_id = Auth::user()->id;
        $allPost= $this->post->get( self::_PER_PAGE, $user_id);
       $users = DB::table('users')
        ->leftJoin('avatar', 'avatar.user_id', '=', 'users.id')
        ->where('users.id', '!=',$user_id  )
        ->orderBy('id', 'desc')
        ->select('users.id', 'users.name', 'avatar.image_avatar')
    
        ->distinct()
        ->get();
            // dd($users );
        return view('home', compact('allPost','users'));
    }

    public function Profile()
    {
        $user_id = Auth::user()->id;
        $allPost= $this->post->profile( self::_PER_PAGE, $user_id);
        $users = $this->avatar->users($user_id);
        return view('clients.profile', compact('allPost','users'));
    }
}