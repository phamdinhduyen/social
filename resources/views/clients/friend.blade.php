<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bạn bè</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container" >
        <div style="display: flex; margin:5px">
            <div class="col-md-1 col-sm-1 col-lg-3 col-el-3 navbar_left " style="margin-left:-5%">
                @section('sizebar')
                    @include('clients.block.sizebar')
                @show
            </div>
            <div class="col-md-7 col-lg-6 col-el-6  list-post">
            @if($users_acceptor->count() == 0 && $users_request->count() == 0)
                <h4 style="text-align: center; font-size:12px;">Bạn chưa có bạn bè</h4>
            @endif
            @if($users_acceptor)
            @foreach($users_acceptor as $key => $item)
            <div class="confirm" style="margin-bottom:20px; display:flex; justify-content: space-between; margin:15px; background-color:aliceblue">
                    <div>
                        <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                        <a href="{{ route('user-profile', ['id' => $item->id]) }}" style="text-decoration: none; font-weight:900; font-size:12px" type="submit" class="name">{{$item->name}}</a>
                    </div>
                    <div>
                        <button class="btn btn-sm delete-friend" type="submit" style="background-color:red;color:black;margin-left:10px " data-value="{{$item->id}}" data-index-value="{{$key}}" >Hủy kết bạn</button>
                    </div>
                </div>
            @endforeach
            @endif  
            @if($users_request)
            @foreach($users_request as $key => $item)
            <div class="confirm" style="margin-bottom:20px; display:flex; justify-content: space-between; margin:15px; background-color:aliceblue">
                    <div>
                        <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="" class="avatar" style="width: 40px;height: 40px;border-radius: 50%;">
                        <a href="{{route('profile')}}" style="text-decoration: none; font-weight:900; font-size:12px" type="submit" class="name">{{$item->name}}</a>
                    </div>
                    <div>
                        <button class="btn btn-sm delete-friend" type="submit" style="background-color:red;color:black ; margin-left:10px " data-value="{{$item->id}}" data-index-value="{{$key}}" >Hủy kết bạn</button>
                    </div>
                </div>
            @endforeach
            @endif  
            </div>
            <div class="col-md-5 col-lg-3 col-lg-3 navbar_right" >
            
            </div>
        </div>
    </div>
    @endsection
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
     $(document).ready(function(){
        $(".delete-friend").click(function(){
               var deleteFriend = document.getElementsByClassName('delete-friend');
               var confirm = document.getElementsByClassName('confirm');
               var index = $(this).attr('data-index-value')
               var user_id = $(this).attr('data-value');
               
               $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/delete-friend',
                data: {user_id: user_id,},
                success: function(data) {
                    confirm[index].style.display = 'none';
                // Handle successful response
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            }); 
        });

     })
</script>

<style>
   @media only screen and (min-width: 320px) and (max-width: 600px) {
   .navbar_right{
      display: none;
   }
   .navbar_left{
    margin-left: 20%;
   }
   .list-post{
    margin-left: 5px;
   }
 
   }

@media only screen and (min-width: 600px) and (max-width: 1366px) {
     .navbar_right{
      margin-left: 50px
   }
}
@media only screen and (min-width: 768px) and (max-width: 1024px) {
     .navbar_right{
      margin-left: 10px;
      width: 100%;
      
   }
}

@media only screen and (min-width: 1024px) and (max-width: 1366px) {
     .navbar_right{
      margin-left: 90px;
      width: 100%;
      
   }
}

@media only screen and (min-width: 1920px)  {
     .navbar_right{
      margin-left: 90px;
      width: 100%;
      
   }
}
</style>






