<div class="card">
    
    
    <div class="card-header flex items-center">
        
        <label>Buscar:</label>
        <input wire:model="search" class="form-control" placeholder="Ingrese nombre del producto">
       
    </div>
    @if ($users->count())
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover table-bordered table-condensed" id="usuarios">
                <thead>
                    <tr>
                        <th wire:click="order('id')">Id
                            @if ($sort == 'id')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-numeric-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-numeric-down-alt float-right mt-1"></i>
                                @endif

                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th wire:click="order('name')">Nombre
                            @if ($sort == 'name')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif

                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th wire:click="order('lastname')">Apellidos
                            @if ($sort == 'lastname')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif

                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th wire:click="order('company')">Empresa
                            @if ($sort == 'company')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif

                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th wire:click="order('address')">Direccion
                            @if ($sort == 'address')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif

                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th colspan="2">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <th>{{ $user->name }}</th>
                            <th>{{ $user->lastname }}</th>
                            <th>{{ $user->company }}</th>
                            <th>{{ $user->address }}</th>
                            <th>{{ $user->email }}</th>
                            <th>{{ $user->phone }}</th>
                            <th width="10px">
                                <form action="{{route('admin.usuarios.destroy', $user)}}" class="formulario-eliminar" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </th>
                            
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay ningun registro que mostrar</strong>
        </div>
    @endif

</div>
