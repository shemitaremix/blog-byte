<div class="card">
    <div class="card-header">
        <input wire:model="buscar" type="text" class="form-control" placeholder="Ingrese el nombre de la Etiqueta">
    </div>
    @if ($etiquetas->count())
        <div class="card-header">
            <a class = "btn btn-secondary" href = "{{route('admin.etiquetas.crear')}}">Agregar Etiqueta</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etiquetas as $etiqueta)
                        @if ($etiqueta->status == 1)
                        <tr>
                            <td>{{$etiqueta->id}}</td>
                            <td>{{$etiqueta->nombre}}</td>
                            @can('etiquetas.editar')
                                <td width="10px">
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.etiquetas.editar', $etiqueta)}}">Editar</a>
                                </td>
                                <td width="10px">
                                    <form action="{{route('admin.etiquetas.eliminar', $etiqueta->id)}}" method="post" class="form-eliminar">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm " type="submit" >Eliminar</button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="card-body">
            <div class="alert alert-info">
                No hay etiquetas registradas
            </div>
        </div>
    @endif
</div>
