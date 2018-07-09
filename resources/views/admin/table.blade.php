<table class="table responsive" id="users-table">
    <thead>
        <th>NO.</th>
        <th>NOMBRE</th>
        <th>PROGRAMAS</th>
        <th>ACCIONES</th>
    </thead>
    <tbody>
        @foreach ($usuarios as $cont => $usuario)
            <tr>
                <td>{!!$usuario->id!!}</td>
                <td>{!!$usuario->nombre!!}</td>
                <td>{!!$usuario->programas!!}</td>
                <td>
                    <button class="editUser btn btn-warning"  value='{!!$usuario->id!!}'> EDITAR</button>
                    <button class="deleteUser btn btn-danger"  value='{!!$usuario->id!!}'> ELIMINAR</button>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
