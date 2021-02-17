@extends('layout')
@section('title') Home @endsection
@section('content')
    <h4 class="d-block">Category: {{$category->name}}</h4>
    <div class="d-flex flex-wrap">
        @forelse ($category->articles as $article)
        <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">{{$article->title}}</h5>
                <p class="card-text">{{substr($article->description,0,50)}}...</p>
                <a href="{{route('home.detail',$article->id)}}" class="card-link">See more</a>
                <div class="card-footer">
                    By: <span class="text-secondary">{{$article->user->name}}</span>
                </div>
            </div>
        </div>
        @empty
        <h4 class="w-100 text-center d-block my-5">
            Unfortunately, there is no blog posted for this category..
        </h4>
        @endforelse
    </div>
@endsection
