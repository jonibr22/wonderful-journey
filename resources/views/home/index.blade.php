@extends('layout')
@section('title') Home @endsection
@section('content')
    @guest
    <h5>Welcome, Guest</h5>
    @else
    <h5>Welcome, {{Auth::user()->name}}</h5>
    @endguest
    <hr>
    <div class="d-flex flex-wrap">
        @forelse ($articles as $article)
        <div class="card m-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$article->title}}</h5>
                <p class="card-text">{{substr($article->description,0,50)}}...</p>
                <a href="{{route('home.detail',$article->id)}}" class="card-link">See more</a>
                <div class="card-footer">
                    <div>
                        Category: <a href="{{route('home.category',$article->category->id)}}">{{$article->category->name}}</a>
                    </div>
                    <div>
                        By: <span class="text-secondary">{{$article->user->name}}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h3 class="w-100 text-center d-block my-5">
            Unfortunately, there is no blog posted yet..
        </h3>
        @endforelse
    </div>
@endsection
