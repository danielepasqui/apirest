@extends('default')
@section('title')
    <title>Databases</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li><a href="/technologies">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
	<li class="active"><a href="#">Database</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Database</h1>
	<div class="lead">
		<a href="/newdatabase" class="btn btn-lg btn-default">Nuovo DB</a>
	</div>
	<div class="lead">
		<div class="table-content" id="content"></div>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/databases',
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var table = $('<table><thead></thead><tbody></tbody></table>');
				table.append('<tr><th>Host</th><th>Username</th><th>Password</th><th>DB Name</th></tr>');
				var row;
				for(var key in data.databases) {
					row = $("<tr><td>" + data.databases[key].host + "</td><td> " + data.databases[key].username + "</td><td> " + data.databases[key].password + '</td><td> ' + data.databases[key].db_name + '</td><td><button class="btn btn-lg btn-default glyphicon glyphicon-remove" id="delete" value="'+ data.databases[key].id +'"></button></td></tr>');
					table.append(row);
				}
				$('#content').append(table);
			  },
			  type: 'GET'
		   });
		   $(document).on('click','#delete',function(){
				$.ajax({
				  url: '/api/v1/databases/'+$(this).val(),
				  error: function() {
					 $('#content').append('<p>An error has occurred</p>');
				  },
				  dataType: 'json',
				  success: function(data) {
					window.location.href = '/databases';
				  },
				  type: 'DELETE'
			   });			  
		   });
		});
	</script>
@stop