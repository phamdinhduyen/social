<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Trang cá nhân</title>
</head>
<body>
  @extends('layouts.app')
  @section('content')
  @section('post')
    <div class="container" >
        <div style="display: flex;">
            <div class="col-lg-3" style="margin-left: -8%">
                <div style="text-align: center;">
                  @if ($users)
                    @foreach($users as $key => $item)
                      <img src="{{ asset('Uploads/image/'.$item->image_avatar) }}" alt="Avatar" class="avatar">
                      <h4 style="margin-top: 2%">{{$item->name}}</h4>
                    @endforeach
                  @endif
                  <button style="border:1px solid black;" class='btn btn-sm'>Upload Avatar</button>
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
            <div class="col-md-6" style="height:600px;overflow-y: scroll">
              @include('clients.news.status')
              @show
            </div>
            <div class="col-md-3">  
            
            </div>
        </div>
    </div>
  @endsection
</body>
</html>

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

.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 10%;
  padding-left: 30%;
  padding-right: 30%;
  left: 0;
  top: 0;
  overflow: auto;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, .4);
}

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

</style>
<script>
  $(document).ready(function () {
  var modal = $('.modal');
  var btn = $('.btn');
  var span = $('.close');

  btn.click(function () {
    modal.show();
  });

  span.click(function () {
    modal.hide();
  });

  $(window).on('click', function (e) {
    if ($(e.target).is('.modal')) {
      modal.hide();
    }
  });
});

</script>
