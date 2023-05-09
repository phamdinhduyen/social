<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Post extends Model
{
    use HasFactory;
    protected $table ='posts';
    protected $fillable = ['content','user_id','image'];
    public $timestamps = true;

    public function get( $perPage = null, $user_id){
        $posts = DB::table($this->table)  ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.id', 'posts.content','posts.image','posts.created_at', 'users.name')
        ->selectSub(function ($query) {
            $query->from('comments')
                ->whereColumn('comments.post_id', 'posts.id')
                ->selectRaw('count(*)');
        }, 'comment_count')
        ->leftJoin('likes', function ($join) use ($user_id) {
            $join->on('likes.post_id', '=', 'posts.id')
                 ->where('likes.user_id', '=', $user_id);
        })
        ->selectSub(function ($query) {
            $query->from('likes')
                  ->whereColumn('likes.post_id', 'posts.id')
                  ->selectRaw('count(*)');
        }, 'like_count')
        ->selectRaw('(SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id AND likes.user_id = ?) AS is_liked', [$user_id])
        ->orderByDesc('posts.id');;
        if(!empty($perPage)){
            $posts = $posts->paginate($perPage)->withQueryString();
        } else {
            $posts = $posts->get(); 
        }
        // dd($posts);
        return $posts;
    }

    public function getcomment($post_id){
        $comments = DB::table('comments')  ->join('users', 'comments.user_id', '=', 'users.id')
        ->select('comments.id', 'comments.content', 'users.name')->where('comments.post_id',$post_id) -> get();
        return $comments;
    }

    public function profile( $perPage = null, $user_id){
        $posts = DB::table($this->table)  ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.id', 'posts.content','posts.image','posts.created_at', 'users.name')
        ->where('posts.user_id', $user_id)
        ->selectSub(function ($query) {
            $query->from('comments')
                ->whereColumn('comments.post_id', 'posts.id')
                ->selectRaw('count(*)');
        }, 'comment_count')
        ->leftJoin('likes', function ($join) use ($user_id) {
            $join->on('likes.post_id', '=', 'posts.id')
                 ->where('likes.user_id', '=', $user_id);
        })
        ->selectSub(function ($query) {
            $query->from('likes')
                  ->whereColumn('likes.post_id', 'posts.id')
                  ->selectRaw('count(*)');
        }, 'like_count')
        ->selectRaw('(SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id AND likes.user_id = ?) AS is_liked', [$user_id]);
        if(!empty($perPage)){
            $posts = $posts->paginate($perPage)->withQueryString();
        } else {
            $posts = $posts->get(); 
        }
        return $posts;
    }

}