@extends('layouts.app')

@section('content')
<div class="col-md-2">
</div>
<div class="col-md-8 bg-dark">
    <div>
        Please verify your email.
    </div>
    <div>
        @auth
            <form action="{{route('verification.send')}}" method="post" class="mr-1">
                @csrf
                <button type="submit" class="btn btn-primary">Resend</button>
            </form>
        @endauth
    </div>
</div>
<div class="col-md-2">
</div>
@endsection