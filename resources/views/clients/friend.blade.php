@extends('layouts.app')
@section('content')
<div class="container" >
    <div style="display: flex; margin:5px">
        <div class="col-md-3">
            @section('sizebar')
                @include('clients.block.sizebar')
            @show
        </div>
        <div class="col-md-6">
        @if($users)
        @foreach($users as $key => $item)
        <div class="confirm" style="margin-bottom:20px; display:flex; justify-content: space-between; margin:15px; background-color:aliceblue">
                <div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Elon_Musk_Royal_Society_%28crop2%29.jpg/1200px-Elon_Musk_Royal_Society_%28crop2%29.jpg" alt="Avatar" class="avatar" style="vertical-align: middle;width: 40px;height: 40px;border-radius: 50%;">
                    <a href="{{route('profile')}}" style="text-decoration: none; font-weight:900; font-size:12px" type="submit" class="name">{{$item->name}}</a>
                </div>
                <div>
                    <button class="btn btn-sm delete-friend" type="submit" style="background-color:red;color:black " data-value="{{$item->id}}" data-index-value="{{$key}}" >Hủy kết bạn</button>
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