<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Avatar extends Model
{
    use HasFactory;
    protected $table ='avatar';
    protected $fillable = ['user_id','image_avatar'];

    public function users($user_id){
        $users = DB::table('avatar')
        ->join('users', 'avatar.user_id', '=', 'users.id')
        ->where('avatar.user_id', '=', $user_id)
        ->select('users.id', 'users.name','avatar.image_avatar') 
        ->get();
        return $users;
    }
}