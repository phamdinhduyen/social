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
    const _PER_PAGE = 2;
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
        $avatar_users = $this->avatar->users($user_id);
        $id = DB::table('addfriend')->select('user_request', 'acceptor')->get();
        $array = [];
        if($id -> count() != 0) {
            foreach($id as $key => $item){
                $array[] = $item->user_request;
                $array[] = $item->acceptor;
                $uniqueFriends_id = array_unique($array);
                $users = DB::table('users')->inRandomOrder()
                ->leftJoin('avatar', 'avatar.user_id', '=', 'users.id')
                ->where('users.id', '!=',$user_id  )
                ->whereNotIn('users.id', $uniqueFriends_id)
                ->orderBy('id', 'desc')
                ->select('users.id', 'users.name', 'avatar.image_avatar')
                ->take(50)
                ->get();
            }
        } else {
              $users = DB::table('users')->inRandomOrder()
            ->leftJoin('avatar', 'avatar.user_id', '=', 'users.id')
            ->where('users.id', '!=',$user_id  )
            ->orderBy('id', 'desc')
            ->select('users.id', 'users.name', 'avatar.image_avatar')
            ->take(50)
            ->get();    
        }
        return view('clients.home', compact('allPost','users','avatar_users'));
    }

    public function show_more(){
        $number_page = 2;
        $page = $_GET["page"];
         settype($page, "int");
       
        $user_id = Auth::user()->id;
        $allPost= $this->post->showMore( $page,$number_page, $user_id);
        return response()->json($allPost);
    }

    public function Profile()
    {
        $user_id = Auth::user()->id;
        $allPost= $this->post->profile( self::_PER_PAGE, $user_id);
        $users = $this->avatar->users($user_id);
        return view('clients.profile', compact('allPost','users'));
    }

      public function userProfile($id)
    {
        $user_id =$id;
        $allPost= $this->post->profile( self::_PER_PAGE, $user_id);
        $users = $this->avatar->users($user_id);
        return view('clients.user-profile', compact('allPost','users'));
    }
}