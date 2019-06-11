@extends('adminlte::page')

@section('title', 'Nuevo Mensaje')

@section('content')
<div class="container-fluid">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Nuevo Mensaje</h3>
					</div>
					<div class="box-body">
						{!! Form::open(['route' => 'messages.store', 'method' => 'POST']) !!}
						<div class="form-group">
							<label for="subject">Asunto: </label>
							<input type="text" name="subject" id="suject" class="form-control">
						</div>
						<div class="form-group">
							<label for="message">Mensaje: </label>
							<textarea class="form-control" name="message" id="message"></textarea>
						</div>
						<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
						<a class="btn btn-danger" href="{{ route('messages.index') }}"><i class="fa fa-times"></i> Cancelar</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection