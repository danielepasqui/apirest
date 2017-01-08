@extends('default')
@section('title')
    <title>Edit technology</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li class="active"><a href="/technologies">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
	<li><a href="/databases">Database</a></li>
    <li><a href="/sites">Siti</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Modifica Tecnologia</h1>
	<div class="lead">
		<input type="hidden" id="id" value="{{ $id }}"><br/>
		<input type="text" class="form-control custom_form" id="name" name="name" placeholder="Nome"><br/>
		<textarea class="form-control" rows="5" id="notes" name="notes" placeholder="Note"></textarea><br/>
		<button class="btn btn-lg btn-default" id="update">Modifica</button>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/technologies/'+$('#id').val(),
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				$('#name').val(data.technology.name);
				$('#notes').val(data.technology.notes);
			  },
			type: 'GET'
		   });
			$('#update').click(function(){
				$.ajax({
				  url: '/api/v1/technologies/'+$('#id').val(),
				  error: function() {
					 $('#content').append('<p>An error has occurred</p>');
				  },
				  data: { name: $('#name').val(), notes: $('#notes').val()},
				  dataType: 'json',
				  success: function(data) {
					window.location.href = '/technologies';
				  },
				  type: 'PUT'
			   });
			});
		});
	</script>
@stop