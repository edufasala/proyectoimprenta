@extends('pages.app')
@section('title','Login')

@section('content')


{{ auth()->user() }}
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Salir</button>
</form>


@endsection
