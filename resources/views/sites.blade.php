@extends('default')
@section('title')
    <title>Sites</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li><a href="/technologies">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
	<li><a href="/databases">Database</a></li>
	<li class="active"><a href="/sites">Siti</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Siti web</h1>
	<div class="lead">
		<a href="/site/add" class="btn btn-lg btn-default">Nuovo Sito</a>
	</div>
	<div class="lead">
		<div class="table-content" id="content">
			<table id="table">
				<tr><th>Cliente</th><th>Url</th><th>PM</th><th>Coda Support</th><th>Tecnologia</th><th>Macchina</th><th>Document root</th><th>Gruppo</th><th>CMS Admin</th><th>CMS Password</th><th>Auth Name</th><th>Auth Password</th><th>Database_Host</th><th>Database_Username</th><th>Database_Password</th><th>Database_name</th><th>Note</th></tr>
			</table>
		</div>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/sites',
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var row;
				for(var key in data.sites) {
					row = $("<tr><td>" + data.sites[key].customer.name + "</td><td> " + data.sites[key].url + "</td><td> " + data.sites[key].pm + "</td><td> " + data.sites[key].customer.support_queue + '</td><td> ' + data.sites[key].technology.name + '</td><td> ' + data.sites[key].machine.name + '</td><td> ' + data.sites[key].doc_root + '</td><td> ' + data.sites[key].group + '</td><td> ' + data.sites[key].cms_admin + '</td><td> ' + data.sites[key].cms_pass + '</td><td> ' + data.sites[key].auth_name + '</td><td> ' + data.sites[key].auth_pass + '</td>');
					row.append('<td id="db_host'+data.sites[key].sid+'"></td><td id="db_user'+data.sites[key].sid+'"></td><td id="db_pass'+data.sites[key].sid+'"></td><td id="db_name'+data.sites[key].sid+'"></td>');
					row.append('<td>' + data.sites[key].notes + '</td><td><button class="btn btn-lg btn-default glyphicon glyphicon-remove" id="delete" value="'+ data.sites[key].sid +'"></button></td><td><a href="/site/'+ data.sites[key].sid +'/edit" class="btn btn-lg btn-default glyphicon glyphicon-refresh" id="update"></a></td></tr>');
					$('#table').append(row);
					for(var chiave in data.sites[key].database) {
						$('#db_host'+data.sites[key].sid).append(data.sites[key].database[chiave].host + '<br/>');
						$('#db_user'+data.sites[key].sid).append(data.sites[key].database[chiave].username + '<br/>');
						$('#db_pass'+data.sites[key].sid).append(data.sites[key].database[chiave].password + '<br/>');
						$('#db_name'+data.sites[key].sid).append(data.sites[key].database[chiave].db_name + '<br/>');
					}
				}
			  },
			  type: 'GET'
		   });
		   $(document).on('click','#delete',function(){
				$.ajax({
				  url: '/api/v1/sites/'+$(this).val(),
				  error: function() {
					 $('#content').append('<p>An error has occurred</p>');
				  },
				  dataType: 'json',
				  success: function(data) {
					window.location.href = '/sites';
				  },
				  type: 'DELETE'
			   });			  
		   });
		});
	</script>
@stop