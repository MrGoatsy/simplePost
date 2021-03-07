@extends('layouts.app')

@section('content')
<div class="col-md-2">
</div>
<div class="col-md-8 bg-dark">
    @auth
    <x-alert error="red" />
    <form action="{{route('posts.update', $post)}}" method="post">
        @method('PATCH')
        @csrf
        <div class="mb-4">
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" class="form-control" style="min-height: 100px;" placeholder="Post something cool...">{{$post->content}}</textarea>
        @error('body')
            <div style="color: red;">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endauth
</div>
<div class="col-md-2">
</div>
@endsection