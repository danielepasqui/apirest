@extends('default')
@section('title')
    <title>New database</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li><a href="/technologies">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
	<li class="active"><a href="/databases">Database</a></li>
	<li><a href="/sites">Siti</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Nuovo Database</h1>
	<div class="lead">
		<input type="text" class="form-control custom_form" id="host" name="host" placeholder="Host"><br/>
		<input type="text" class="form-control custom_form" id="username" name="username" placeholder="Username"><br/>
		<input type="text" class="form-control custom_form" id="password" name="password" placeholder="Password"><br/>
		<input type="text" class="form-control custom_form" id="db_name" name="db_name" placeholder="Database name"><br/>
		<button class="btn btn-lg btn-default" id="insert">Inserisci</button>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$('#insert').click(function(){
				$empty = false;
				$('input').each(function() {
				    if ($(this).val() == "")
				    	$empty = true;
				});
				if($empty == true)
					alert('Riempire tutti i campi');
				else
				{
					$.ajax({
					  url: '/api/v1/databases',
					  error: function() {
						 $('#content').append('<p>An error has occurred</p>');
					  },
					  data: { host: $('#host').val(), username: $('#username').val(), password: $('#password').val(), db_name: $('#db_name').val()},
					  dataType: 'json',
					  success: function(data) {
						window.location.href = '/databases';
					  },
					  type: 'POST'
				   });
				}
			});
		});
	</script>
@stop