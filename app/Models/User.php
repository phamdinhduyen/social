<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Notifications\VerifyEmailQueued;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','email','password',];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $table ='users';
    public $timestamps = true;

    public function sendEmailVerificationNotification()
    {
      $this->notify(new VerifyEmailQueued);
    }

    public function get($perPage = null, $keywords = null, ){
        $users = DB::table($this->table)->select('name', 'id');
        if(!empty($keywords)){
            $users = $users->where(function ($query) use ($keywords) {
                $query->orwhere('name', 'like', '%' . $keywords . '%');
            });
        }
        $users = $users ->orderBy('id', 'desc');
     
        if(!empty($perPage)){
            $users = $users->paginate($perPage)->withQueryString();
        } else {
            $users = $users->get(); 
        }
        return $users;
    }
   
}