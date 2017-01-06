@extends('default')
@section('title')
    <title>New technology</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li class="active"><a href="/technologies">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Nuova Tecnologia</h1>
	<div class="lead">
		<input type="text" class="form-control custom_form" id="name" name="name" placeholder="Nome"><br/>
		<textarea class="form-control" rows="5" id="notes" name="notes" placeholder="Note"></textarea><br/>
		<button class="btn btn-lg btn-default" id="insert">Inserisci</button>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$('#insert').click(function(){
				$.ajax({
				  url: '/api/v1/technologies',
				  error: function() {
					 $('#content').append('<p>An error has occurred</p>');
				  },
				  data: { name: $('#name').val(), notes: $('#notes').val()},
				  dataType: 'json',
				  success: function(data) {
					window.location.href = '/technologies';
				  },
				  type: 'POST'
			   });
			});
		});
	</script>
@stop