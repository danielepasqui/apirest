@extends('default')
@section('title')
    <title>Machines</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li><a href="/technologies">Tecnologie</a></li>
	<li class="active"><a href="#">Macchine</a></li>
	<li><a href="/databases">Database</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Macchine</h1>
	<div class="lead">
		<a href="/newmachine" class="btn btn-lg btn-default">Nuova Macchina</a>
	</div>
	<div class="lead">
		<div class="table-content" id="content"></div>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/machines',
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var table = $('<table><thead></thead><tbody></tbody></table>');
				table.append('<tr><th>Nome</th><th>Note</th></tr>');
				var row;
				for(var key in data.machines) {
					row = $("<tr><td>" + data.machines[key].name + "</td><td>" + data.machines[key].notes + '</td><td><button class="btn btn-lg btn-default glyphicon glyphicon-remove" id="delete" value="'+ data.machines[key].id +'"></button></td></tr>');
					table.append(row);
				}
				$('#content').append(table);
			  },
			  type: 'GET'
		   });
		   $(document).on('click','#delete',function(){
				$.ajax({
				  url: '/api/v1/machines/'+$(this).val(),
				  error: function() {
					 $('#content').append('<p>An error has occurred</p>');
				  },
				  dataType: 'json',
				  success: function(data) {
					window.location.href = '/machines';
				  },
				  type: 'DELETE'
			   });			  
		   });
		});
	</script>
@stop