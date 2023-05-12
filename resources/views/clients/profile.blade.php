<title>Trang cá nhân</title>
@extends('layouts.app')

@section('content')
@section('post')
<div class="container" >
    <div style="display: flex; margin:5px">
        <div class="col-md-3">
          <div >
            <div>
              @if ($users)
                @foreach($users as $key => $item)
                  <img style="margin-left:20%" src="{{ asset('Uploads/image/'.$item->image) }}" alt="Avatar" class="avatar">
                  <h4 style="margin-top: 2%">{{$item->name}}</h4>
                @endforeach
                  
              @endif
            </div>
             <div>
              <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <input id="file" type="file" name="file" accept="image/jpeg, image/png">
                  </div>
                  <div>
                    <button class="btn btn-secondary" type="submit">Đăng</button>
                  </div>
              </form>  
          </div>
          </div>
          <div>
           
          </div>
        </div>
        <div class="col-md-6" style="height:600px;overflow-y: scroll">
          @include('clients.news.status')
          @show
        </div>
        <div class="col-md-3">  
        
        </div>
     </div>
</div>

@endsection

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
    
  </style>
