@extends('default')
@section('title')
    <title>Home</title>
@stop

@section('menu')
	<li class="active"><a href="#">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li><a href="/technologies">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
	<li><a href="/databases">Database</a></li>
	<li><a href="/sites">Siti</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Home Page</h1>
	<p class="lead"></p>
@stop