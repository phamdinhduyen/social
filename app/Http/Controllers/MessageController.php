<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\AddFriend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    private $message;
    public function __construct()
    {
        $this->middleware('auth');
        $this-> message = new Message;
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
        $users = DB::table('addfriend')
        ->join('users', 'addfriend.user_request', '=', 'users.id')
        ->where('addfriend.status', '!=', null)
        ->where('addfriend.acceptor', '=', $user_id)
        ->select('users.id', 'users.name') 
        ->get();

        $messages = DB::table('messages')
            ->join('users', function ($join) {
            $join->on('messages.user_id', '=', 'users.id');
        })
        ->select('users.id', 'messages.content', 'users.name')
        ->where(function ($query) use ($user_id) {
            $query->where('messages.user_id', $user_id)
            ->orWhere('messages.recipient_id', $user_id);
        })
        ->get();
        return view('clients.message', compact('users','messages','user_id'));
    }

    public function getMessage(){
        $user_id = Auth::user()->id;
        $recipient_id = $_GET["recipient_id"];
        $user_name = DB::table('users')->where('id', $recipient_id)->select('id','name')->get();
        $getMessage= $this->message->getMessage($user_id, $recipient_id);
        return response()->json([
            'user_id' => $user_id,
            'messages' => $getMessage,
            'user_name' =>  $user_name
        ]);
    }

    
}