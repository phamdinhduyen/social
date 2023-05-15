<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lời mời kết bạn</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container" >
        <div style="display: flex; margin:5px">
            <div class="col-md-3"  style="margin-left:-5%">
                @section('sizebar')
                    @include('clients.block.sizebar')
                @show
            </div>
            <div class="col-md-6">
            @if($users->count() == 0)
            <h4 class="no-friend" style="text-align: center;">Bạn không có lời mời kết bạn</h4>
            @endif
            @if($users)
            @foreach($users as $key => $item)
            <div class="confirm" style="margin-bottom:20px; display:flex; justify-content: space-between; margin:15px; background-color:aliceblue">
                    <div>
                        <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                        <a href="{{route('profile')}}" style="text-decoration: none; font-weight:900; font-size:12px" type="submit" class="name">{{$item->name}}</a>
                    </div>
                    <div>
                        <button class="btn btn-sm confirm-friend" type="submit" style="background-color:#159b4b"  data-value="{{$item->id}}" data-index-value="{{$key}}" >Đồng ý</button>
                        <button class="btn btn-sm delete-friend" type="submit" style="background-color:red;color:black " data-value="{{$item->id}}" data-index-value="{{$key}}" >Xóa</button>
                    </div>
                </div>
            @endforeach
            @endif   
            </div>
            <div class="col-md-3">
            
            </div>
        </div>
    </div>
    @endsection
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
     $(document).ready(function(){
          $(".confirm-friend").click(function(){
               var confirm = document.getElementsByClassName('confirm');
               var index = $(this).attr('data-index-value')
               var user_id = $(this).attr('data-value');
               $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/confirm-friend',
                data: {user_id: user_id,},
                success: function(data) {
                // Handle successful response
                confirm[index].style.display = 'none';
                },
                error: function(xhr, status, error) {
                // Handle error response
                }
            }); 
          });

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
  .no-friend{
    color: #159b4b
  }  
</style>

