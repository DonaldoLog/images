@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#organizacionesTabla').DataTable({
                    "processing": true,
                    "serverSide": false,
                    "pageLength": 10,
                    "deferRender": true,
                    "ajax": "catOrganizaciones",
                    "columns": [
                        {data: 'id',name: 'id'},
                        {data: 'nombre',name: 'nombre'},
                        {data: 'componente',name: 'componente'},
                        {data: null,"orderable": false,
                            render: function(data, type, row) {
                                return "<center><a href='{{ url('organizacion') }}/" + data.id + "/edit' class='btn btn-default'><i class='fa fa-pencil' aria-hidden='true'></i> Editar</a><button id='borrar' name='" + data.nombre + "' value='" + data.id +"' class='btn btn-danger'><i class='fa fa-trash-o' aria-hidden='true'></i> Eliminar</button></center>"
                            }
                        }
                    ]
        });
        //--------------------------------------------------------------------------ELIMINAR
        $('#organizacionesTabla').on('click', '#borrar', function(){
            this.preventDefault;
            nombre=this.name;
            numero=this.value;
            console.log(numero);
            swal({
                    title: "¿Seguro que desea eliminar la organizacion "+nombre+"?",
                    text: "No podrá deshacer este paso.",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Confirmar",
                    closeOnConfirm: false
            }, function(isConfirm){
                if (isConfirm) {
                    window.location="{{ url('organizacion') }}/"+numero+"/delete";
                }

            });
        });



    });
    </script>

@endpush
