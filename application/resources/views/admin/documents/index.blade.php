@extends('adminlte::page')

@section('title', 'Documentos')

@section('content')
<div class="container-fluid">
	<section class="content">
		@include('flash::message')
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Documentos</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('documents.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</a>
						<br />
						<br />
						<table class="table table-bordered table-striped">
							<thead>
								<th>ID</th>
								<th>Fecha</th>
								<th>Imagen</th>
								<th>Titulo</th>
								<th>Descripcion</th>
								<th>Documento</th>
								<th>Categoria</th>
								<th>Acciones</th>
							</thead>
							<tbody>
								@foreach($documents as $document)
								<tr>
									<td>{{ $document->id }}</td>
									<td>{{ date('d-m-Y',strtotime($document->created_at)) }}</td>
									<td>
										@if(isset($document->image) and !empty($document->image))
											<img src="{{ asset('application/storage/app/'.$document->image) }}" class="img-thumbnail" style="width:80px !important; height:80px !important;">
										@else
											Sin Imagen
										@endif
									</td>
									<td>{{ $document->title }}</td>
									<td>{{ $document->description }}</td>
									<td>
										@if(isset($document->file) and !empty($document->file))
											<a href="{{ asset('application/storage/app/'.$document->file) }}" class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Descargar</a>
										@else
											Sin Archivo
										@endif
									</td>
									<td>{{ $document->category->name }}</td>
									<td>
										<a class="btn btn-info" href="{{ route('documents.edit',['id' => $document->id]) }}"><i class="fa fa-pencil"></i></a>
										{!! Form::open(['route' => ['documents.destroy',$document->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
										<button type="submit" class="btn btn-danger delete-row"><i class="fa fa-times"></i></button>
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
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

		$(".delete-row").click(function(){
			if(!confirm("Esta seguro de Eliminar este Registro?")){
				return false;
			}
		});

		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	});
</script>
@endsection