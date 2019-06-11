@extends('adminlte::page')

@section('title', 'Usuarios')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
@endsection

@section('content')
<div class="container-fluid">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Usuarios</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('users.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</a>
						<br />
						<br />
						<table class="table table-bordered table-striped display responsive nowrap">
							<thead>
								<th>ID</th>
								<th>Foto</th>
								<th>Fecha</th>
								<th>Usuario</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Activo</th>
								<th>Perfil</th>
								<th>Camara</th>
								<th>Email</th>
								<th>Telefono</th>
								<th>Localidad</th>
								<th>Direccion</th>
								<th>Pais</th>
								<th>Lugar</th>
								<th>Tipo Socio</th>
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
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("table.table").DataTable({
			responsive: true
		});
	});
</script>
@endsection