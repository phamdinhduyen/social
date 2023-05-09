<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AddFriend extends Model
{
    use HasFactory;
    protected $table ='addfriend';
    protected $fillable = ['user_request','acceptor','status'];

    // public function getFriend(){
    //     $friend = DB::table($this->table)->get();
    //     dd($friend);
    // }
}
