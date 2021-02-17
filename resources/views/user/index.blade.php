@extends('layout')
@section('title') User @endsection
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
    <table class="table">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Toggle</th>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td><strong>{{$user->name}}</strong></td>
                <td>{{$user->email}}</td>
                <td>
                    <a class="btn btn-danger" href="#" onclick="event.preventDefault();document.getElementById('delete-form#{{$user->id}}').submit();">Delete</a>
                    <form id="delete-form#{{$user->id}}" action="{{route('user.delete',$user->id)}}" method="post" class="d-none">
                        @method('delete')
                        @csrf
                    </form>
                    <a class="btn btn-secondary" href="{{route('user.blog',$user->id)}}">Blogs</a>
                </td>
            </tr>
            @empty
                <td colspan="3" style="text-align: center">No Data Available</td>
            @endforelse
        </tbody>
    </table>
    {{-- <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div> --}}
@endsection