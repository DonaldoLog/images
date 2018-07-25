<table class="table responsive" id="users-table">
    <thead>
        <th>NO.</th>
        <th>NOMBRE</th>
        <th>COMPONENTES</th>
        <th>ACCIONES</th>
    </thead>
    <tbody>
        @foreach ($usuarios as $cont => $usuario)
            <tr>
                <td>{!!$usuario->id!!}</td>
                <td>{!!$usuario->nombre!!}</td>
                <td>{!!$usuario->componentes!!}</td>
                <td>
                    <button class="editUser btn btn-warning"  value='{!!$usuario->id!!}'> EDITAR</button>
                    <a class="deleteUser btn btn-danger" href="{!!route('delete.usuario',$usuario->id)!!}"> ELIMINAR</a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
