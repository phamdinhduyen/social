<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <scrip src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Trang cá nhân</title>
  <style>
    form {
      max-width: 500px;
      margin: auto;
      border-radius: 10px;
      padding: 20px;
    }
    
    input[type="file"] {
      display: block;
      margin-bottom: 20px;
    }
    
    input[type="submit"] {
      background-color: #4CAF50;
      border-radius: 1px;
      font-size: 1em;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }

    .avatar {
      vertical-align: middle;
      width: 100px;
      height: 100px;
      border: 3px solid #a9a9a9;
      border-radius: 50%;
    }
    
    body {
      font-family: Arial, Helvetica, sans-serif;
    }
  
@media only screen and (min-width: 768px){
   .col{
    display: flex;
   }
}
  </style>
</head>
<body>
  @extends('layouts.app')
  
  @section('content')
    <div class="container">
      <div class="col">
        <div class="col-md-3 col-sm-12 col-lg-3 col-el-3 navbar_left">
          <div style="text-align: center;">
            @if($users)
              @foreach($users as $key => $item)
                @if(isset($item->image_avatar))
                  <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="" class="avatar">
                @else
                  <img src="{{ asset('Uploads/image/') }}" alt="" class="avatar">
                @endif
                <h4 style="margin-top: 2%">{{$item->name}}</h4>
              @endforeach
            @endif
            <a href="{{ route('chatify') }}/{{$item->id}}">Nhắn tin</a>
          </div>
          <hr>
          <div class="modal">
            <div class="modal-content">
              <span class="close">×</span>   
              <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <h2>Cập nhật ảnh đại diện</h2>
                <div>
                  <input id="file" type="file" name="file" accept="image/jpeg, image/png">
                </div>
                <div>
                  <button class="btn btn-secondary" type="submit">Tải lên</button>
                </div>
              </form>  
            </div>
          </div>
          <div>
          
        </div>
      </div>
      <div class="col-md-7 col-lg-6 col-el-6 list-post " style="height:600px;overflow-y: scroll">
        @include('clients.news.status')
      </div>
      </div>
    </div>
  @endsection
</body>
</html>

