<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
  </style>
</head>
<body>
  @extends('layouts.app')
  
  @section('content')
    <div class="container">
      <div style="display: flex;">
        <div class="col-lg-3" style="margin-left: -8%">
          <div style="text-align: center;">
            @if($users)
              @foreach($users as $key => $item)
                @if(isset($item->image_avatar))
                  <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="" class="avatar">
                @else
                  <img src="{{ asset('Uploads/image/') }}" alt="" class="avatar">
                @endif
                <h4 style="margin-top: 2%">{{$item->name}}</h4>
                <a href="{{ route('chatify') }}/{{$item->id}}">Nhắn tin</a>
              @endforeach
            @endif
          </div>
          <hr>
          <div class="mobile" style="display:none">@include('clients.news.status')</div>
          <div>
          
          </div>
        </div>
        <div class="col-md-6" style="height:600px;overflow-y: scroll">
          @include('clients.news.status')
        </div>
        <div class="col-md-3">  
        
        </div>
      </div>
    </div>
  @endsection
</body>
</html>
