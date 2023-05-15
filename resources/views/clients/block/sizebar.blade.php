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
      <a href="{{route('home')}}" style=" font-weight:900;text-decoration: none; font-size:20px "type="submit"  class="home-page">Trang chủ</a>
   </div>

   <div style="margin-bottom:25px ;">
      @if( $avatar_users)
         @foreach($avatar_users as $key => $item)
            <a href="{{route('profile')}}" style="display: inline-block;">
               <img src="{{ asset('Uploads/image/'.$item->image_avatar	) }}" alt="" class="avatar" style="width: 30px;height: 30px;border-radius: 50%;border:1px solid #A9A9A9">
            </a>
         @endforeach
         @else 
            <a href="{{route('profile')}}" style="display: inline-block;">
                  <img src="" alt="" class="avatar" style="width: 30px;height: 30px;border-radius: 50%;border:1px solid #A9A9A9">
            </a>
         @endif
            <a href="{{route('profile')}}" style=" font-weight:900;text-decoration: none; font-size:20px ;" type="submit" class="profile-page" >Trang cá nhân</a>
   </div>
   <div style="margin-bottom:25px">
      <a href="{{route('friend-request')}}" style="display: inline-block;">
         <i style="font-size: 24;" class="fas fa-user"></i>
      </a>
      <a href="{{route('friend-request')}}" style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="profile-page" >Lời mời kết bạn</a>
   </div>
   <div style="margin-bottom:25px">
      <a href="{{route('friend')}}" style="display: inline-block;">
         <i  style="font-size: 24;"  style="font-size: 24;" class="fas fa-users"></i>
      </a>
      <a href="{{route('friend')}}" style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="friend" >Bạn bè</a>
   </div>
   <div style="margin-bottom:25px">
      <a href="{{route('message')}}" style="display: inline-block;">
         <i  style="font-size: 20" class="fas fa-comment-alt"></i>
      </a>
      <a href="{{route('message')}}" style=" font-weight:900;text-decoration: none; font-size:20px;" type="submit" class="message-page" >Tin nhắn</a>
   </div>
   <div style="margin-bottom:25px">
      <a href="" style="display: inline-block;">
         <i style="font-size: 24;" class="fas fa-users"></i>
      </a>
      <a  style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="group-page">Nhóm</a> 
   </div>
   <div style="margin-bottom:25px">
      <a href="" style="display: inline-block;">
         <i style="font-size: 24;" class="fas fa-pager"></i>
      </a>
      <a  style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="page">Trang</a> 
   </div>
   <div style="margin-bottom:25px">
      <a href="" style="display: inline-block;">
         <i style="font-size: 24;" class="fas fa-shopping-cart"></i>
      </a>
   <a style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="shop-page" >Mua sắm</a> 
   </div>
   <div style="margin-bottom:25px">
      <a href="" style="display: inline-block;">
         <i style="font-size: 24;" class="fas fa-place-of-worship"></i>
      </a>
      <a style=" font-weight:900;text-decoration: none; font-size:20px " type="submit" class="recruitment" >Việc làm</a>
   </div>
</div>
   
</body>
</html>

