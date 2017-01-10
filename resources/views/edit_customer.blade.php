@extends('default')
@section('title')
    <title>Edit customer</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li class="active"><a href="/customers">Clienti</a></li>
	<li><a href="/technologies">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
	<li><a href="/databases">Database</a></li>
	<li><a href="/sites">Siti</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Modifica Cliente</h1>
	<div class="lead">
		<input type="hidden" id="id" value="{{ $id }}"><br/>
		<input type="text" class="form-control custom_form" id="name" name="name" placeholder="Nome"><br/>
		<input type="text" class="form-control custom_form" id="support_queue" name="support_queue" placeholder="Coda support"><br/>
		<p>Attivo</p>
		<input type="radio" id="1" name="active" value="1"/> Si
		<input type="radio" id="0" name="active" value="0"/> No
		<textarea class="form-control" rows="5" id="notes" name="notes" placeholder="Note"></textarea><br/>
		<button class="btn btn-lg btn-default" id="update">Modifica</button>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/customers/'+$('#id').val(),
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				$('#name').val(data.customer.name);
				$('#support_queue').val(data.customer.support_queue);
				if(data.customer.active==1)
					$('#1').prop({"checked":true});
				else
					$('#0').prop({"checked":true});
				$('#notes').val(data.customer.notes);
			  },
			type: 'GET'
		   });
			$('#update').click(function(){
				$empty = false;
				$('input').each(function() {
				    if ($(this).val() == "")
				    	$empty = true;
				});
				if($empty == true)
					alert('Riempire tutti i campi (eccetto le note)');
				else
				{
					$.ajax({
					  url: '/api/v1/customers/'+$('#id').val(),
					  error: function() {
						 $('#content').append('<p>An error has occurred</p>');
					  },
					  data: { name: $('#name').val(), support_queue: $('#support_queue').val(), active: document.querySelector('input[name="active"]:checked').value, notes: $('#notes').val()},
					  dataType: 'json',
					  success: function(data) {
						window.location.href = '/customers';
					  },
					  type: 'PUT'
				   });
				}
			});
		});
	</script>
@stop