@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-gray-700 p-6 m-6">
            <div class="flex items-center">
                Please verify your email.
            </div>
            <div class="flex items-center">
                @auth
                    <form action="{{route('verification.send')}}" method="post" class="mr-1">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Resend</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
@endsection