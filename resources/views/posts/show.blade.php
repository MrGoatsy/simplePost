@extends('layouts.app')

@section('content')
<div class="col-md-2">
</div>
<div class="col-md-8 flex-fill bg-dark">
    <x-post :posts="$post" />
</div>
<div class="col-md-2">
</div>
@endsection