<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <title>Trang chủ</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container" >
        <div style="display: flex; margin:5px">
            <div class="col-md-1 col-sm-1 col-lg-3  col-el-3 " style="margin-left:-5%" >
                @section('sizebar')
                    @include('clients.block.sizebar')
                @show
            </div>
            <div class="col-md-7 col-lg-6 col-el-6  list-post" style="height:560px;overflow-y: scroll; ">
               <div class="status">
                    @section('status')
                    @include('clients.news.status')
                @show
               </div>
            </div>
            <div class="col-md-5 col-lg-3 col-lg-3 navbar_right"  >
                
                <div style=" width:100%; height:210px; overflow-y: scroll;">
                    @include('clients.block.ads')
                </div>

                <div style=" width:100%; height:310px; overflow-y: scroll; border-top: 3px solid #A9A9A9; border-left: 3px solid #A9A9A9">
                    @include('clients.block.addFriend')
                </div>
            </div>
            
        </div>
    </div>
@endsection
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<style>
   @media only screen and (min-width: 320px) and (max-width: 600px) {
   .navbar_right{
      display: none;
   }
   .status{
    margin-left: 10px
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





