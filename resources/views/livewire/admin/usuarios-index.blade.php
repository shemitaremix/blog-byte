<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="buscar" type="text" class="form-control" placeholder="Ingrese el nombre del usuario">
        </div>
        @if ($usuarios->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->id}}</td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td width = "10px">
                                    <a class="btn btn-primary" href="{{route('admin.usuarios.editar', $usuario->id)}}">Roles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$usuarios->links()}}
            </div>
        @else
        <div class="card-body">
            <strong>
                No se encontraron usuarios
            </strong>
        </div>
        @endif
    </div>
</div>
