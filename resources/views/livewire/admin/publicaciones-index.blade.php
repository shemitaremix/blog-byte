<div class="card">
    <div class="card-header">
        <input wire:model="buscar" type="text" class="form-control" placeholder="Ingrese el nombre de la publicacion">
    </div>
    @if ($publicaciones->count())
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
                    @foreach ($publicaciones as $publicacion)
                        <tr>
                            <td>{{$publicacion->id}}</td>
                            <td>{{$publicacion->nombre}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{route('publicacion.editar', $publicacion->id)}}">Editar</a>
                            </td>
                            <td>
                                <form action="{{route('admin.publicaciones.eliminar', $publicacion->id)}}" method="POST" class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{$publicaciones->links()}}
        </div>
    @else
        <div class="card-body">
            <div class="alert alert-info">
                No hay publicaciones registradas
            </div>
        </div>
    @endif
</div>
