@extends('default')
@section('title')
    <title>Site</title>
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
	<h1 class="cover-heading">Sito web</h1>
	<div class="lead">
		<div class="table-content" id="content">
			<table id="table">
				<tr><th>Nome</th><th>Url</th><th>PM</th><th>Coda Support</th><th>Tecnologia</th><th>Macchina</th><th>Document root</th><th>Gruppo</th><th>CMS Admin</th><th>CMS Password</th><th>Auth Name</th><th>Auth Password</th><th>Database_Host</th><th>Database_Username</th><th>Database_Password</th><th>Database_name</th><th>Note</th></tr>
			</table>
		</div>
	</div>
	<input type="hidden" id="id" value="{{ $id }}"><br/>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/sites/'+$('#id').val(),
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var row;
				row = $("<tr><td>" + data.site.name + "</td><td> " + data.site.url + "</td><td> " + data.site.pm + "</td><td> " + data.site.customer.support_queue + '</td><td> ' + data.site.technology.name + '</td><td> ' + data.site.machine.name + '</td><td> ' + data.site.doc_root + '</td><td> ' + data.site.group + '</td><td> ' + data.site.cms_admin + '</td><td> ' + data.site.cms_pass + '</td><td> ' + data.site.auth_name + '</td><td> ' + data.site.auth_pass + '</td>');
				row.append('<td id="db_host'+data.site.id+'"></td><td id="db_user'+data.site.id+'"></td><td id="db_pass'+data.site.id+'"></td><td id="db_name'+data.site.id+'"></td>');
				row.append('<td>' + data.site.notes + '</td></tr>');
				$('#table').append(row);
				for(var key in data.site.database) {
					$('#db_host'+data.site.id).append(data.site.database[key].host + '<br/>');
					$('#db_user'+data.site.id).append(data.site.database[key].username + '<br/>');
					$('#db_pass'+data.site.id).append(data.site.database[key].password + '<br/>');
					$('#db_name'+data.site.id).append(data.site.database[key].db_name + '<br/>');
				}
			  },
			  type: 'GET'
		   });
		});
	</script>
@stop