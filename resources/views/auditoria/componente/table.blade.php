<div class="form-group col-md-12">
    <div class="table-responsive">
        <table id="carpetasTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>ACCION</th>
            </thead>
            <tbody>
                @if (count($carpetas)==0)
                    <tr>
                        <center>
                            <td colspan="3"  style="text-align:center;">SIN REGISTROS</td>
                        </center>
                    </tr>
                @endif
                @foreach ($carpetas as $carpeta)
                    <tr>
                        <td>{!!$carpeta->id!!}</td>
                        <td>{!!$carpeta->nombre!!}</td>
                        <td>
                            <a class="btn btn-info" href="{!!route('ver.auditoria.componente',$carpeta->id)!!}"> <i class="fa fa-wrench"></i> </a>
                            <button id="editar-boton" value="{!!$carpeta->id!!}" name="{!!$carpeta->nombre!!}" class="btn btn-warning" href="#"> <i class="fa fa-edit"></i> </button>
                            <button id="remove-boton" value="{!!$carpeta->id!!}" name="{!!$carpeta->nombre!!}" class="btn btn-danger" href="#"> <i class="fa fa-remove"></i> </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
