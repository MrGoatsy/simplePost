@extends('layouts.app')

@section('content')
    <div class="col-md-2">
    </div>
    <div class="col-md-8 bg-dark">
        <form action="{{ route('posts') }}" method="POST">
            @csrf
            <div class="mb-4 mt-4">
                <textarea name="body" class="form-control" style="min-height: 100px;" placeholder="Post something cool...">{{ old('body') }}</textarea>
                
            @error('body')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        @if ($posts->count())
                <x-post :posts="$posts" />

            {{ $posts->links() }}
        @else
            There are no posts
        @endif
    </div>
    <div class="col-md-2">
    </div>
@endsection