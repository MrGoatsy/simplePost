@props(['error' => 'red', 'green'])

@if (session('status'))
<div class="alert alert-danger">
    <p>{{session('status')}}</p>
</div>
@endif