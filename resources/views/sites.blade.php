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
		<div class="table-content" id="content"></div>
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
				var table = $('<table><thead></thead><tbody></tbody></table>');
				table.append('<tr><th>Cliente</th><th>Url</th><th>PM</th><th>Coda Support</th><th>Tecnologia</th><th>Macchina</th><th>Document root</th><th>Gruppo</th><th>CMS Admin</th><th>CMS Password</th><th>Auth Name</th><th>Auth Password</th><th>Note</th></tr>');
				var row;
				for(var key in data.sites) {
					row = $("<tr><td>" + data.sites[key].customer + "</td><td> " + data.sites[key].url + "</td><td> " + data.sites[key].pm + "</td><td> " + data.sites[key].support_queue + '</td><td> ' + data.sites[key].technology + '</td><td> ' + data.sites[key].machine + '</td><td> ' + data.sites[key].doc_root + '</td><td> ' + data.sites[key].group + '</td><td> ' + data.sites[key].cms_admin + '</td><td> ' + data.sites[key].cms_pass + '</td><td> ' + data.sites[key].auth_name + '</td><td> ' + data.sites[key].auth_pass + '</td><td>' + data.sites[key].notes + '</td><td><button class="btn btn-lg btn-default glyphicon glyphicon-remove" id="delete" value="'+ data.sites[key].id +'"></button></td><td><a href="/site/'+ data.sites[key].id +'/edit" class="btn btn-lg btn-default glyphicon glyphicon-refresh" id="update"></a></td></tr>');
					table.append(row);
				}
				$('#content').append(table);
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