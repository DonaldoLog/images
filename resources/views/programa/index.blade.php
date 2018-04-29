@extends('adminlte::page') @section('title', 'SAGARPA') @section('content_header')

<h1>INICIO</h1> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!--box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">PROGRAMAS</h3>
            </div>

            <!--box-body -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="pull-right">
                            <a type="button" href="#" class="btn btn-default">AGREGAR PROGRAMA</a>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="table-responsive">
                            <table class="table no-margin" id="programasTabla">
                                <thead>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>No. Componentes</th>
                                    <th>Accion</th>
                                </thead>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
            <!--box-footer -->
            <div class="box-footer">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#programasTabla').DataTable({
                    "processing": true,
                    "serverSide": false,
                    "pageLength": 10,
                    "deferRender": true,
                    "ajax": "catProgramas",
                    "columns": [
                        {data: 'id',name: 'id'},
                        {data: 'nombre',name: 'nombre'},
                        {data: 'Componentes',name: 'Componentes'},
                        {data: null,"orderable": false,
                            render: function(data, type, row) {
                                return "<center><a href='{{ url('programa') }}/" + data.id + "/edit' class='btn btn-default btn-xs'><i class='fa fa-pencil' aria-hidden='true'></i> Editar</a><button id='borrar' name='" + data.nombre + "' value='" + data.id +"' class='btn btn-danger'><i class='fa fa-trash-o' aria-hidden='true'></i> Eliminar</button></center>"
                            }
                        }
                    ]
        });
        //--------------------------------------------------------------------------ELIMINAR
        $('#programasTabla').on('click', '#borrar', function(){
            this.preventDefault;
            nombre=this.name;
            numero=this.value;
            console.log(numero);
            swal({
                    title: "¿Seguro que desea eliminar el programa "+nombre+"?",
                    text: "No podrá deshacer este paso.",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Confirmar",
                    closeOnConfirm: false
            }, function(isConfirm){
                if (isConfirm) {
                    window.location="{{ url('programa') }}/"+numero+"/delete";
                }

            });
        });
    });
    </script>

@endpush
