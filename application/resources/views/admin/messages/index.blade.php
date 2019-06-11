@extends('adminlte::page')

@section('title', 'Mensajes')

@section('content')
<div class="container-fluid">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Mensajes</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('messages.write_message',['role' => 'administrador']) }}" class="btn btn-success"><i class="fa fa-user"></i> Administradores</a> <a href="{{ route('messages.write_message',['role' => 'camara']) }}" class="btn btn-warning"><i class="fa fa-user"></i> Camaras</a> <a href="{{ route('messages.write_message',['role' => 'usuario']) }}" class="btn btn-info"><i class="fa fa-user"></i> Usuarios</a> <a href="{{ route('messages.write_message',['role' => 'todos']) }}" class="btn btn-default"><i class="fa fa-users"></i> Todos</a>
						<br />
						<br />
						<table class="table table-bordered table-striped">
							<thead>
								<th>ID</th>
								<th>Fecha</th>
								<th>De</th>
								<th>Para</th>
								<th>Asunto</th>
								<th>Mensaje</th>
								<th>Acciones</th>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$("table.table").DataTable();
	});
</script>
@endsection