@extends('default')
@section('title')
    <title>New customer</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li class="active"><a href="/customers">Clienti</a></li>
	<li><a href="#">Macchine</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Nuovo Cliente</h1>
	<div class="lead">
		<input type="text" class="form-control custom_form" id="name" name="name" placeholder="Nome"><br/>
		<input type="text" class="form-control custom_form" id="support_queue" name="support_queue" placeholder="Coda support"><br/>
		<p>Attivo</p>
		<input type="radio" name="active" value="1"/> Si
		<input type="radio" name="active" value="0"/> No
		<textarea class="form-control" rows="5" id="notes" name="notes" placeholder="Note"></textarea><br/>
		<button class="btn btn-lg btn-default" id="insert">Inserisci</button>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$('#insert').click(function(){
				$.ajax({
				  url: '/api/v1/customers',
				  error: function() {
					 $('#content').append('<p>An error has occurred</p>');
				  },
				  data: { name: $('#name').val(), support_queue: $('#support_queue').val(), active: document.querySelector('input[name="active"]:checked').value, notes: $('#notes').val()},
				  dataType: 'json',
				  success: function(data) {
					window.location.href = '/customers';
				  },
				  type: 'POST'
			   });
			});
		});
	</script>
@stop