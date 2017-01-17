@extends('default')
@section('title')
    <title>Technologies</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li><a href="/customers">Clienti</a></li>
	<li class="active"><a href="#">Tecnologie</a></li>
	<li><a href="/machines">Macchine</a></li>
	<li><a href="/databases">Database</a></li>
	<li><a href="/sites">Siti</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Tecnologie</h1>
	<div class="lead">
		<a href="/technology/add" class="btn btn-lg btn-default">Nuova tecnologia</a>
	</div>
	<div class="lead">
		<div class="table-content" id="content"></div>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/technologies',
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var table = $('<table><thead></thead><tbody></tbody></table>');
				table.append('<tr><th>Nome</th><th>Note</th></tr>');
				var row;
				for(var key in data.technologies) {
					row = $("<tr><td>" + data.technologies[key].name + "</td><td>" + data.technologies[key].notes + '</td><td><button class="btn btn-lg btn-default glyphicon glyphicon-remove" id="delete" value="'+ data.technologies[key].id +'"></button></td><td><a href="/technology/'+ data.technologies[key].id +'/edit" class="btn btn-lg btn-default glyphicon glyphicon-refresh" id="update"></a></td></tr>');
					table.append(row);
				}
				$('#content').append(table);
			  },
			  type: 'GET'
		   });
		   $(document).on('click','#delete',function(){
		   		if(confirm('Sei sicuro?')) {
					$.ajax({
					  url: '/api/v1/technologies/'+$(this).val(),
					  error: function() {
						 $('#content').append('<p>An error has occurred</p>');
					  },
					  dataType: 'json',
					  success: function(data) {
						window.location.href = '/technologies';
					  },
					  type: 'DELETE'
				   });
				}		  
		   });
		});
	</script>
@stop