@extends('default')
@section('title')
    <title>Not Found</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li><a href="/technologies">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
	<li><a href="/databases">Database</a></li>
	<li><a href="/sites">Siti</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Not found</h1>
	<div class="lead">
		<p style="font-size: x-large; margin-top: 100px;">La pagina che stai cercando non esiste</p>
	</div>
@stop