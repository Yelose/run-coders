@section('title', __('Atletas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>
                                <i class="fab fa-laravel text-info"></i>
							Listado de Atletas</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }}</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar atleta 🔎">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
                        Agregar atleta <i class="fa fa-plus"></i>
						</div>
					</div>
				</div>

				<div class="card-body">
						@include('livewire.atletas.create')
						@include('livewire.atletas.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
								<th>Nombre</th>
								<th>Apellidos</th>
								<th>Licencia</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($atletas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->apellidos }}</td>
								<td>{{ $row->licencia }}</td>
								<td width="90">
								<div class="btn-group">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i title="Editar" class="fa fa-edit"></i></a>
									<a class="dropdown-item" onclick="confirm('Confirm Delete Atleta id {{$row->id}}? \nDeleted Atletas cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i title="Eliminar" class="fa fa-trash"></i> </a>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>
					{{ $atletas->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
