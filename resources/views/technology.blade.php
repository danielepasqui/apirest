@extends('default')
@section('title')
    <title>Technology</title>
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
	<h1 class="cover-heading">Tecnologia</h1>
	<div class="lead">
		<div class="table-content" id="content"></div>
	</div>
	<input type="hidden" id="id" value="{{ $id }}"><br/>
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
				var table = $('<table><thead></thead><tbody></tbody></table>');
				table.append('<tr><th>Nome</th><th>Note</th></tr>');
				var row;
				row = $("<tr><td>" + data.technology.name + "</td><td>" + data.technology.notes + '</td></tr>');
				table.append(row);
				$('#content').append(table);
			  },
			  type: 'GET'
		   });
		});
	</script>
@stop