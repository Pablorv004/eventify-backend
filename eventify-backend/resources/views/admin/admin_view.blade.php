@extends('layouts.app')
@section('content')

<h1>Hola wenas tarde, soy admin</h1>

@forelse($users as $user)
<h3>Usuario {{ $user -> name }}</h3>
@empty
<h2>No hay usuarios</h2>
@endforelse

@endsection