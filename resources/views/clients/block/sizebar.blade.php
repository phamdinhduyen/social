<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
   <div>
   <div style="margin-bottom:25px">
      <a href="{{route('home')}}" style="display: inline-block;">
         <i style="font-size: 24px;" class="fas fa-home"></i>
      </a>
      <a href="{{route('home')}}" style=" font-weight:900;text-decoration: none; font-size:20px "type="submit"  class="home-page sizebar">Trang chủ</a>
   </div>

   <div style="margin-bottom:25px ;">
      @if( $avatar_users)
         @foreach($avatar_users as $key => $item)
            @if(isset($item->image_avatar))
            <a href="{{route('profile')}}" style="display: inline-block;">
               <img src="{{ asset('Uploads/image/'.$item->image_avatar	) }}" alt="" class="avatar" style="width: 30px;height: 30px;border-radius: 50%;border:1px solid #A9A9A9">
            </a>
            @else
             <a href="{{route('profile')}}" style="display: inline-block;">
                  <img src="" alt="" class="avatar" style="width: 30px;height: 30px;border-radius: 50%;border:1px solid #A9A9A9">
            </a>
            @endif
         @endforeach
      @endif
         <a href="{{route('profile')}}" style=" font-weight:900;text-decoration: none; font-size:20px ;" type="submit" class="profile-page sizebar" >Trang cá nhân</a>
   </div>
   <div style="margin-bottom:25px">
      <a href="{{route('friend-request')}}" style="display: inline-block;">
         <i style="font-size: 24px;" class="fas fa-user"></i>
      </a>
      <a href="{{route('friend-request')}}" style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="profile-page sizebar" >Lời mời kết bạn</a>
   </div>
   <div style="margin-bottom:25px">
      <a href="{{route('friend')}}" style="display: inline-block;">
         <i  style="font-size: 24px;" class="fas fa-users"></i>
      </a>
      <a href="{{route('friend')}}" style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="friend sizebar" >Bạn bè</a>
   </div>
   <div style="margin-bottom:25px">
      <a href="{{route('chatify')}}" style="display: inline-block;">
         <i  style="font-size: 24px" class="fas fa-comment-alt"></i>
      </a>
      <a href="{{route('chatify')}}" style=" font-weight:900;text-decoration: none; font-size:20px;" type="submit" class="message-page sizebar" >Tin nhắn</a>
   </div>
   <div style="margin-bottom:25px">
      <a href="" style="display: inline-block;">
         <i style="font-size: 24px;" class="fas fa-users"></i>
      </a>
      <a  style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="group-page sizebar">Nhóm</a> 
   </div>
   <div style="margin-bottom:25px">
      <a href="" style="display: inline-block;">
         <i style="font-size: 24px;" class="fas fa-pager"></i>
      </a>
      <a  style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="page sizebar">Trang</a> 
   </div>
   <div style="margin-bottom:25px">
      <a href="" style="display: inline-block;">
         <i style="font-size: 24px;" class="fas fa-shopping-cart"></i>
      </a>
   <a style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="shop-page sizebar" >Mua sắm</a> 
   </div>
   <div style="margin-bottom:25px">
      <a href="" style="display: inline-block;">
         <i style="font-size: 24px;" class="fas fa-place-of-worship"></i>
      </a>
      <a style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="recruitment sizebar" >Việc làm</a>
   </div>
</div>
   
</body>
</html>

<style>
   @media only screen and (min-width: 320px) and (max-width: 800px) {
   .sizebar{
      display: none
   }
   }
</style>
