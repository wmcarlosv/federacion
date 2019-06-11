@extends('adminlte::page')

@section('title', 'Noticias')

@section('content')
<div class="container-fluid">
	<section class="content">
		@include('flash::message')
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Noticias</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('notices.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva</a>
						<br />
						<br />
						<table class="table table-bordered table-striped">
							<thead>
								<th>ID</th>
								<th>Fecha</th>
								<th>Imagen</th>
								<th>Titulo</th>
								<th>Descripcion</th>
								<th>Categoria</th>
								<th>Acciones</th>
							</thead>
							<tbody>
								@foreach($notices as $notice)
								<tr>
									<td>{{ $notice->id }}</td>
									<td>{{ date('d-m-Y',strtotime($notice->created_at)) }}</td>
									<td>
										@if(isset($notice->image) and !empty($notice->image))
											<img src="{{ asset('application/storage/app/'.$notice->image) }}" class="img-thumbnail" style="width:80px !important; height:80px !important;">
										@else
											Sin Imagen
										@endif
									</td>
									<td>{{ $notice->title }}</td>
									<td>{{ $notice->description }}</td>
									<td>{{ $notice->category->name }}</td>
									<td>
										<a class="btn btn-info" href="{{ route('notices.edit',['id' => $notice->id]) }}"><i class="fa fa-pencil"></i></a>
										{!! Form::open(['route' => ['notices.destroy',$notice->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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