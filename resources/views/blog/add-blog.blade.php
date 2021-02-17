
@extends('layout')
@section('title') Form @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @elseif (session('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">Add Blog</div>

                <div class="card-body">
                    <form method="POST" action="{{route('blog.insert.submit')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>
                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category" required>
                                    <option value="" selected>-- Select Category --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>                                  
                            </div>
                        </div>

                        <div class="form-group row" style="margin-bottom: 2rem">
                            <label for="file" class="col-md-4 col-form-label text-md-right">Upload image</label>
                            <div class="custom-file col-md-6" style="margin: 0 15px">
                                <input type="file" class="form-control custom-file-input @error('file') is-invalid @enderror" id="fileSelect" name="file" onchange="setFileLabel()">
                                <label class="custom-file-label" for="fileSelect" id="fileLabel">Choose file</label>
                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="story" class="col-md-4 col-form-label text-md-right">Story</label>

                            <div class="col-md-6">
                                <textarea id="story" cols="10" rows="4" class="form-control @error('story') is-invalid @enderror" name="story" value="{{ old('story') }}" required autocomplete="story" autofocus></textarea>

                                @error('story')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   function setFileLabel(){
        var fileName = document.getElementById('fileSelect').files[0].name;
        document.getElementById('fileLabel').innerHTML = fileName;
   }
</script>
@endsection