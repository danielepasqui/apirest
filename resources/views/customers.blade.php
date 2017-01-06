@extends('default')
@section('title')
    <title>Customers</title>
@stop

@section('menu')
	<li><a href="/">Home</a></li>
	<li class="active"><a href="#">Clienti</a></li>
	<li><a href="#">Macchine</a></li>
@stop

@section('main-content')
	<h1 class="cover-heading">Clienti</h1>
	<div class="lead">
		<a href="/newcustomer" class="btn btn-lg btn-default">Nuovo cliente</a>
	</div>
	<div class="lead">
		<div class="table-content" id="content"></div>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function(){
			$.ajax({
			  url: '/api/v1/customers',
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var table = $('<table><thead></thead><tbody></tbody></table>');
				table.append('<tr><th>Nome</th><th>Coda support</th><th>Attivo</th><th>Note</th></tr>');
				var row;
				for(var key in data.customers) {
					row = $("<tr><td>" + data.customers[key].name + "</td><td> " + data.customers[key].support_queue + "</td><td> " + (data.customers[key].active == 1 ? "Si" : "No") + '</td><td> ' + data.customers[key].notes + '</td></tr>');
					table.append(row);
				}
				$('#content').append(table);
			  },
			  type: 'GET'
		   });
		});
	</script>
@stop