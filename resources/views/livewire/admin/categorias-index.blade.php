<div class="card">
    <div class="card-header">
        <input wire:model="buscar" type="text" class="form-control" placeholder="Ingrese el nombre de la Categoria">
    </div>
    @if ($categorias->count())
        <div class="card-header">
            <a class = "btn btn-secondary" href = "{{route('admin.categorias.create')}}">Agregar Categoria</a>
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
                    @foreach ($categorias as $categoria)
                        @if ($categoria->status == 1)
                            <tr>
                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->nombre}}</td>
                                @can('categorias.editar')
                                    <td Width="10PX"><a class="btn btn-primary btn-sm" href="{{route('admin.categorias.edit', $categoria)}}">EDITAR</a></td>
                                    <td Width="10PX">
                                        <form action="{{route('admin.categorias.destroy',$categoria)}}" method="post" class="form-eliminar">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endif
                    @endforeach
                <tbody>
                </tbody>
            </table>
        </div>
    @else
        <div class="card-body">
            <div class="alert alert-info">
                No hay categorias registradas
            </div>
        </div>
    @endif
</div>
