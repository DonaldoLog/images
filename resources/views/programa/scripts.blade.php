@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#programasTabla').DataTable({
                    "language":{"url":"//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"},
                    "processing": true,
                    "serverSide": false,
                    "pageLength": 10,
                    "deferRender": true,
                    "ajax": "catProgramas",
                    "columns": [
                        {data: 'id',name: 'id'},
                        {data: 'nombre',name: 'nombre'},
                        {data: 'componentes_count',name: 'componentes_count'},
                        {data: null,"orderable": false,
                            render: function(data, type, row) {
                                return "<center><a href='{{ url('programa') }}/" + data.id + "/edit' class='btn btn-default'><i class='fa fa-pencil' aria-hidden='true'></i> Administrar</a><button id='borrar' name='" + data.nombre + "' value='" + data.id +"' class='btn btn-danger'><i class='fa fa-trash-o' aria-hidden='true'></i> Eliminar</button></center>"
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
