<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<title>Trang chủ</title>
@extends('layouts.app')

@section('content')
<div class="container" >
    <div style="display: flex; margin:5px">
        <div class="col-md-3 " style="margin-left:-5%" >
            @section('sizebar')
                @include('clients.block.sizebar')
            @show
        </div>
        <div class="col-md-6 list-post" style="height:600px;overflow-y: scroll; ">
            @section('status')
                @include('clients.news.status')
            @show
        </div>
        <div class="col-md-3" style="margin-left:10%" >
            
            <div style="position: fixed; top:80px; height: 150px; overflow-y: scroll;width: 22%;">
                @include('clients.block.ads')
            </div>

            <div style="position: fixed; bottom:20px; height: 55%; overflow-y: scroll;width: 22%; border-top: 3px solid #A9A9A9; border-left: 3px solid #A9A9A9">
                @include('clients.block.addFriend')
            </div>
        </div>
        
    </div>
</div>
@endsection



