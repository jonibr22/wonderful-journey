@extends('layout')
@section('title') My Blog @endsection
@section('content')
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger" role="alert">
        {{ session('failed') }}
    </div>
    @endif
    <div class="mb-2">
        <a class="btn btn-primary float-right mb-3" href="{{route('blog.create')}}">Add Blog</a>
    </div>
    <table class="table">
        <thead>
            <th>Title</th>
            <th>Toggle</th>
        </thead>
        <tbody>
            @forelse ($articles as $article)
            <tr>
                <td><a href="{{route('home.detail',$article->id)}}">{{$article->title}}</a></td>
                <td>
                    <a class="btn btn-danger" href="#" onclick="event.preventDefault();document.getElementById('delete-form#{{$article->id}}').submit();">Delete</a>
                    <form id="delete-form#{{$article->id}}" action="{{route('blog.delete',$article->id)}}" method="post" class="d-none">
                        @method('delete')
                        @csrf
                    </form>
                </td>
            </tr>
            @empty
                <td colspan="2" style="text-align: center">No Data Available</td>
            @endforelse
        </tbody>
    </table>
    {{-- <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div> --}}
@endsection