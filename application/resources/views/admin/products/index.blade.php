@extends('adminlte::page')

@section('title', 'Productos')

@section('content')
<div class="container-fluid">
	<section class="content">
		@include('flash::message')
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3>Productos</h3>
					</div>
					<div class="box-body">
						<a href="{{ route('products.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nueva</a>
						<br />
						<br />
						<table class="table table-bordered table-striped">
							<thead>
								<th>ID</th>
								<th>Fecha</th>
								<th>Imagen</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Rubro</th>
								<th>Telefono</th>
								<th>Whatsapp</th>
								<th>Email</th>
								<th>Direction</th>
								<th>Acciones</th>
							</thead>
							<tbody>
								@foreach($products as $product)
								<tr>
									<td>{{ $product->id }}</td>
									<td>{{ date('d-m-Y',strtotime($product->created_at)) }}</td>
									<td>
										@if(isset($product->cover) and !empty($product->cover))
											<img src="{{ asset('application/storage/app/'.$product->cover) }}" class="img-thumbnail" style="width:80px !important; height:80px !important;">
										@else
											Sin Imagen
										@endif
									</td>
									<td>{{ $product->name }}</td>
									<td>{{ $product->description }}</td>
									<td>{{ $product->entry->name }}</td>
									<td>{{ $product->phone }}</td>
									<td>{{ $product->whatsapp }}</td>
									<td>{{ $product->email }}</td>
									<td>{{ $product->direction }}</td>
									<td>
										<a class="btn btn-info" href="{{ route('products.edit',['id' => $product->id]) }}"><i class="fa fa-pencil"></i></a>
										{!! Form::open(['route' => ['products.destroy',$product->id], 'method' => 'DELETE', 'style' => 'display:inline;']) !!}
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