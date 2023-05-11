<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;
    protected $table ='messages';
    protected $fillable = ['recipient_id','user_id','content'];

   public function getMessage($user_id,$recipient_id){
        $messages = DB::table('messages')
            ->join('users', function ($join) {
            $join->on('messages.user_id', '=', 'users.id');
        })
        ->select('users.id', 'messages.content', 'users.name')
        ->where(function ($query) use ($user_id) {
            $query->where('messages.user_id', $user_id)
            ->orWhere('messages.recipient_id', $user_id);
        })
        ->where(function ($query) use ($recipient_id) {
            $query->where('messages.user_id', $recipient_id)
            ->orWhere('messages.recipient_id', $recipient_id);
        })
        ->get();
        return $messages;
    }

}