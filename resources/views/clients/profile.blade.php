<title>Trang cá nhân</title>
@extends('layouts.app')

@section('content')
@section('post')
<div class="container" >
    <div style="display: flex; margin:5px">
        <div class="col-md-3">
          @section('sizebar')
            @include('clients.block.sizebar')
          @show
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
