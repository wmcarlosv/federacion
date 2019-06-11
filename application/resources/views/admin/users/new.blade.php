@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content')
<div class="container-fluid">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Nuevo Usuario</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="name">Nombre: </label>
									<input type="text" name="name" id="name" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="last_name">Apellido: </label>
									<input type="text" name="last_name" id="last_name" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="email">Email: </label>
									<input type="text" name="email" id="email" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="password">Contrase&ntilde;a: </label>
									<input type="password" name="password" id="password" class="form-control">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="camera_id">Camara: </label>
									<input type="text" name="camera_id" id="camera_id" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="role">Perfil: </label>
									<select class="form-control" name="role" id="role">
										<option value="usuario">Usuario</option>
										<option value="camara">Camara</option>
										<option value="administrador">Administrador</option>
									</select>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
						<a class="btn btn-danger" href="{{ route('users.index') }}"><i class="fa fa-times"></i> Cancelar</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection