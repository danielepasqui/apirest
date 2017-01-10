@extends('default')
@section('title')
    <title>Database</title>
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
	<h1 class="cover-heading">Database</h1>
	<div class="lead">
		<div class="table-content" id="content"></div>
	</div>
	<input type="hidden" id="id" value="{{ $id }}"><br/>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/databases/'+$('#id').val(),
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var table = $('<table><thead></thead><tbody></tbody></table>');
				table.append('<tr><th>Host</th><th>Username</th><th>Password</th><th>DB Name</th></tr>');
				var row;
				row = $("<tr><td>" + data.database.host + "</td><td> " + data.database.username + "</td><td> " + data.database.password + '</td><td> ' + data.database.db_name + '</td></tr>');
				table.append(row);
				$('#content').append(table);
			  },
			  type: 'GET'
		   });
		});
	</script>
@stop