@extends('default')
@section('title')
    <title>New Site</title>
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
	<h1 class="cover-heading">Nuovo Sito</h1>
	<div class="lead">
		<input type="text" class="form-control custom_form" id="nome" name="nome" placeholder="Nome"><br/>
		<input type="text" class="form-control custom_form" id="url" name="url" placeholder="Url"><br/>
		<input type="text" class="form-control custom_form" id="doc_root" name="doc_root" placeholder="Document root"><br/>
		<input type="text" class="form-control custom_form" id="auth_name" name="auth_name" placeholder="Authentication name"><br/>
		<input type="text" class="form-control custom_form" id="auth_pass" name="auth_pass" placeholder="Authentication password"><br/>
		<input type="text" class="form-control custom_form" id="cms_admin" name="cms_admin" placeholder="CMS Admin"><br/>
		<input type="text" class="form-control custom_form" id="cms_pass" name="cms_pass" placeholder="CMS Password"><br/>
		<input type="text" class="form-control custom_form" id="pm" name="pm" placeholder="PM"><br/>
		<input type="text" class="form-control custom_form" id="group" name="group" placeholder="gruppo"><br/>
		<textarea class="form-control" rows="5" id="notes" name="notes" placeholder="Note"></textarea><br/>
		Tecnologia: <select class="form-control" id="technologies"></select><br/>
		Macchina: <select class="form-control" id="machines"></select><br/>
		Databases: <select multiple class="form-control" id="databases"></select><br/>
		Cliente: <select class="form-control" id="customers"></select><br/>
		<button class="btn btn-lg btn-default" id="insert">Inserisci</button>
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
				var option;
				for(var key in data.databases) {
					option = $('<option value="'+ data.databases[key].did +'">'+ data.databases[key].db_name +'</option>');
					$('#databases').append(option);
				}
			  },
			  type: 'GET'
		   	});
			
			$.ajax({
			  url: '/api/v1/customers',
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var option;
				for(var key in data.customers) {
					option = $('<option value="'+ data.customers[key].cid +'">'+ data.customers[key].name +'</option>');
					$('#customers').append(option);
				}
			  },
			  type: 'GET'
		   });
		   $.ajax({
			  url: '/api/v1/technologies',
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var option;
				for(var key in data.technologies) {
					option = $('<option value="'+ data.technologies[key].tid +'">'+ data.technologies[key].name +'</option>');
					$('#technologies').append(option);
				}
			  },
			  type: 'GET'
		   });
		   $.ajax({
			  url: '/api/v1/machines',
			  error: function() {
				 $('#content').append('<p>An error has occurred</p>');
			  },
			  dataType: 'json',
			  success: function(data) {
				var option;
				for(var key in data.machines) {
					option = $('<option value="'+ data.machines[key].mid +'">'+ data.machines[key].name +'</option>');
					$('#machines').append(option);
				}
			  },
			  type: 'GET'
		   });
			$('#insert').click(function(){
				$empty = false;
				$('input').each(function() {
				    if ($(this).val() == "")
				    	$empty = true;
				});
				if($empty == true)
					alert('Riempire tutti i campi (eccetto le note)');
				else
				{
					$.ajax({
					  url: '/api/v1/sites',
					  error: function() {
						 $('#content').append('<p>An error has occurred</p>');
					  },
					  data: { name: $('#nome').val(), 
							  url: $('#url').val(), 
							  doc_root: $('#doc_root').val(), 
							  auth_name: $('#auth_name').val(), 
							  auth_pass: $('#auth_pass').val(), 
							  cms_admin: $('#cms_admin').val(),
							  cms_pass: $('#cms_pass').val(),
							  pm: $('#pm').val(),
							  group: $('#group').val(),
							  notes: $('#notes').val(),
							  tid: $('#technologies').val(),
							  mid: $('#machines').val(),
							  cid: $('#customers').val(),
							  dids: $('#databases').val()},
					  dataType: 'json',
					  success: function(data) {
						window.location.href = '/sites';
					  },
					  type: 'POST'
				   });
				}
			});
		});
	</script>
@stop