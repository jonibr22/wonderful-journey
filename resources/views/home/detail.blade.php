@extends('layout')
@section('title') Home @endsection
@section('content')
<div class="content">
    <h2>{{$article->title}}</h2>
    <div class="mb-3">
        By: <span class="text-secondary">{{$article->user->name}}</span>
    </div>
    <img src="{{asset('uploads/'.$article->image)}}" style="width:300px;height:300px">
    <p>{{$article->description}}</p>
    <a class="btn btn-primary" href="{{route('home')}}">Back Home</a>
</div>
@endsection