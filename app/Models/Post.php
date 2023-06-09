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
        $posts = DB::table($this->table)  
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.id', 'users.id as user_id','posts.content','posts.created_at','posts.image as image', 'users.name', 'avatar.image_avatar as avatar')
        ->leftJoin('avatar', function ($join) use ($user_id) {
            $join->on('avatar.user_id', '=', 'users.id')
                ->where('avatar.user_id', '=','users.id');
                
        })
        ->selectSub(function ($query) {
            $query->from('avatar')
                ->whereColumn('avatar.user_id', 'users.id')
                ->select('avatar.image_avatar');
        }, 'image_avatar')
        ->selectSub(function ($query) {
            $query->from('comments')
                ->whereColumn('comments.post_id', 'posts.id')
                ->selectRaw('count(*)');
        }, 'comment_count')
      
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

  public function showMore($page, $number_page, $user_id) {
    $startIndex = ($page - 1) * $number_page;
    $show_more_posts = DB::table($this->table)  
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('avatar', function ($join) use ($user_id) {
            $join->on('avatar.user_id', '=', 'users.id')
                ->where('avatar.user_id', '=', 'users.id');
        })
        ->select('posts.id', 'users.id as user_id', 'posts.content', 'posts.created_at', 'posts.image as image', 'users.name', 'avatar.image_avatar as avatar')
        ->selectSub(function ($query) use ($user_id) {
            $query->from('avatar')
                ->whereColumn('avatar.user_id', 'users.id')
                ->select('avatar.image_avatar');
        }, 'image_avatar')
        ->selectSub(function ($query) {
            $query->from('comments')
                ->whereColumn('comments.post_id', 'posts.id')
                ->selectRaw('count(*)');
        }, 'comment_count')
        ->selectSub(function ($query) {
            $query->from('likes')
                  ->whereColumn('likes.post_id', 'posts.id')
                  ->selectRaw('count(*)');
        }, 'like_count')
        ->selectRaw('(SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id AND likes.user_id = ?) AS is_liked', [$user_id])
        ->orderByDesc('posts.id')
        ->skip($startIndex)
        ->take($number_page)
        ->get();
        
    return $show_more_posts;
}


    public function getcomment($post_id){
        $comments = DB::table('comments')  ->join('users', 'comments.user_id', '=', 'users.id')
        ->select('comments.id', 'comments.content', 'users.name','users.id as user_id')->where('comments.post_id',$post_id) -> get();
        return $comments;
    }

    public function profile( $perPage = null, $user_id){
        $posts = DB::table($this->table)->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.id', 'posts.content', 'posts.image', 'posts.created_at', 'users.id as user_id','users.name', 'avatar.image_avatar as avatar')
        ->where('posts.user_id', $user_id)
        ->leftJoin('avatar', function ($join) use ($user_id) {
            $join->on('avatar.user_id', '=', 'users.id')
                ->where('avatar.user_id', '=','users.id');
                
        })
        ->selectSub(function ($query) {
            $query->from('avatar')
                ->whereColumn('avatar.user_id', 'users.id')
                ->select('avatar.image_avatar');
        }, 'image_avatar')
        ->leftJoin('likes', function ($join) use ($user_id) {
                $join->on('likes.post_id', '=', 'posts.id')
                    ->where('likes.user_id', '=', $user_id);
        })
        ->selectSub(function ($query) {
            $query->from('comments')
                ->whereColumn('comments.post_id', 'posts.id')
                ->selectRaw('count(*)');
        }, 'comment_count')
      
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
        return $posts;
    }

}