<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\AddFriend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Avatar;
class MessageController extends Controller
{
    private $message;
    private $avatar;
    public function __construct()
    {
        $this->middleware('auth');
        $this-> message = new Message;
        $this -> avatar = new Avatar();
    }
    public function addMessage(Request $request){
        
        $data = [
            'user_id' => Auth::id(),
            'recipient_id' => $request->recipient_id,
            'content' => $request->content
        ];
        $message = Message::create($data);
         return response()->json($message);
    }

    public function message(Request $request){
        $user_id = Auth::user()->id;
        $users_acceptor = DB::table('addfriend')
        ->join('users', 'addfriend.user_request', '=', 'users.id')
        ->leftJoin('avatar', 'avatar.user_id', '=', 'users.id')
        ->where('addfriend.acceptor', '=', $user_id)
        ->where('addfriend.status', '!=', null)
        ->select('users.id', 'users.name','avatar.image_avatar') 
        ->get();
        $users_request = DB::table('addfriend')
        ->join('users', 'addfriend.acceptor', '=', 'users.id')
        ->leftJoin('avatar', 'avatar.user_id', '=', 'users.id')
        ->where('addfriend.user_request', '=', $user_id)
        ->where('addfriend.status', '!=', null)
        ->select('users.id', 'users.name','avatar.image_avatar') 
        ->get();

        $messages = DB::table('messages')
        ->join('users', 'messages.user_id', '=', 'users.id')
        ->select('users.id', 'messages.content', 'users.name')
        ->where(function ($query) use ($user_id) {
            $query->where('messages.user_id', $user_id)
            ->orWhere('messages.recipient_id', $user_id);
        })
        ->get();
        $avatar_users = $this->avatar->users($user_id);
        return view('clients.message', compact('users_acceptor','users_request','messages','user_id','avatar_users'));
    }

    public function getMessage(){
        $user_id = Auth::user()->id;
        $recipient_id = $_GET["recipient_id"];
        $id = DB::table('avatar')->select('user_id')->where('user_id',$recipient_id)->get();
            if ($id->count() != 0) {
                $user_name = DB::table('users')
                ->join('avatar', 'avatar.user_id','users.id')
                ->where('users.id', $recipient_id)
                ->select('users.id', 'users.name', 'avatar.image_avatar')->get();
                $getMessage= $this->message->getMessage($user_id, $recipient_id);
                return response()->json([
                    'user_id' => $user_id,
                    'messages' => $getMessage,
                    'user_name' =>  $user_name
                ]);
            } else {
                $user_name = DB::table('users')
                ->where('users.id', $recipient_id)
                ->select('users.id', 'users.name')->get();
                $getMessage= $this->message->getMessage($user_id, $recipient_id);
                return response()->json([
                    'user_id' => $user_id,
                    'messages' => $getMessage,
                    'user_name' =>  $user_name
                ]);
            }
    }

    
}