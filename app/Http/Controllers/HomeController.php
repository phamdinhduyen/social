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
            ->leftJoin('addfriend', function($join) use ($user_id) {
                $join->on('users.id', '=', 'addfriend.acceptor')
                    ->where('addfriend.user_request', '=', $user_id);
            })
            ->select('users.id', 'users.name')
            ->whereNull('addfriend.acceptor')
            ->where('users.id', '!=', $user_id)
            ->orderBy('id', 'desc')
            ->get();
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