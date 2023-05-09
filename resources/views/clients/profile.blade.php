<title>Trang cá nhân</title>
@extends('layouts.app')

@section('content')
@section('post')
<div class="container" >
    <div style="display: flex; margin:5px">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
          @include('clients.news.status')
          @show
        </div>
        <div class="col-md-3">
          
        </div>
     </div>
</div>

@endsection
