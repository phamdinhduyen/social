<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Avatar;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
      public function avatarAdd(Request $request){
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
            'image_avatar' => $fileName,
            
        ];
        $avatar = Avatar::create($data);
        return redirect()->route('profile');
    }

}