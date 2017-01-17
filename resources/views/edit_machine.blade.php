@extends('default')
@section('title')
    <title>Edit Machine</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li><a href="/technologies">Tecnologie</a></li>
	<li class="active"><a href="/machines">Macchine</a></li>
	<li><a href="/databases">Database</a></li>
	<li><a href="/sites">Siti</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Modifica Macchina</h1>
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
			  url: '/api/v1/machines/'+$('#id').val(),
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				$('#name').val(data.machine.name);
				$('#notes').val(data.machine.notes);
			  },
			type: 'GET'
		   });
			$('#update').click(function(){
				$.ajax({
				  url: '/api/v1/machines/'+$('#id').val(),
				  error: function(data) {
 				  	if(data.status == 422) {
				  	 	for(var key in data.responseJSON.name) {
					 		alert(data.responseJSON.name[key]);
				  	 	}
					} else {
					 	alert('Errore, riprovare più tardi');
					}
				  },
				  data: { name: $('#name').val(), notes: $('#notes').val()},
				  dataType: 'json',
				  success: function(data) {
					window.location.href = '/machines';
				  },
				  type: 'PUT'
			   });
			});
		});
	</script>
@stop