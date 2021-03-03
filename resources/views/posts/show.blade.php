@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-gray-700 p-6 m-6">
            <x-post :post="$post" />
        </div>
    </div>
@endsection