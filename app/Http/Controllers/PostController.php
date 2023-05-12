<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const _PER_PAGE = 50;
    private $post;
    public function __construct()
    {
        $this->middleware('auth');
        $this -> post = new Post;
    }
    public function postAdd(Request $request){
        $rules = [
            'content' => 'required|min:3',
        ];
        $messages = [
            'title.required' => 'Trường này bắt buộc phải nhập',
            'content.required' => 'Trường này bắt buộc phải nhập'
        ];
        $request->validate($rules, $messages);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($request->has('file')) {
            $file = $request->file;
            $etx = $request->file->extension();
            if($etx == 'jpg' || $etx == 'png') {
                $random =  substr(str_shuffle($characters), 0, 40);
                $fileName = time() . $random.'.'. $etx; 
                $file->move(public_path().'/Uploads/image', $fileName);
            } else{
                $fileName = null;
           }
        } else {
             $fileName = null;
        }
       
        $data = [
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'image' => $fileName,
            
        ];
        $post = Post::create($data);
        return redirect()->route('home');
    }

    public function commentPost(Request $request){
        $content = $request->input('content');
        $id = $request->input('id');
        $rules = [
            'content' => 'required|min:1',
        ];
        $messages = [
            'content.required' => 'Trường này bắt buộc phải nhập'
        ];
        $this->validate($request, $rules, $messages);
        $data = [
            'post_id' => $id,
            'user_id' => Auth::user()->id,
            'content' =>  $content,
        ];
        $comment = Comment::create($data);
        $allComment= $this->post->getcomment($id);
        return response()->json($allComment);
    }

    public function getCommentPost(){
        $post_id = $_GET["post_id"];
        $allComment= $this->post->getcomment($post_id);
        return response()->json($allComment);
    }

    public function LikePost(){
        $post_id = $_GET["post_id"];
        $data = [
            'post_id' => $post_id,
            'user_id' => Auth::user()->id,
        ];
        $like = Like::create($data);
        return response()->json($like);
    }
 
    public function unLikePost(){
        $post_id = $_GET["post_id"];
        $user_id = Auth::user()->id;
        $like = Like::where('post_id', $post_id)
        ->where('user_id', $user_id)
        ->delete();
        return response()->json($like);
    }
    

}