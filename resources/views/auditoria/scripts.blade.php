@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#componentesTabla').DataTable({
                    "language":{"url":'{{ asset('js/Spanish.json') }}'},
                    "processing": true,
                    "serverSide": false,
                    "pageLength": 10,
                    "deferRender": true,
                    "ajax": route('componetes.auditoria.dataTable').template,
                    "columns": [
                        {data: 'id',name: 'id'},
                        {data: 'nombre',name: 'nombre'},
                        {data: null,"orderable": false,
                            render: function(data) {
                                return "<center><a href='"+route('auditoria.componente',data.id)+"' class='btn btn-default'><i class='fa fa-pencil' aria-hidden='true'></i> Administrar</a></center>"
                            }
                        }
                    ]
        });
        //--------------------------------------------------------------------------ELIMINAR
        $('#componentesTabla').on('click', '#borrar', function(){
            this.preventDefault;
            nombre=this.name;
            numero=this.value;
            console.log(numero);
            swal({
                    title: "¿Seguro que desea eliminar el componente "+nombre+"?",
                    text: "No podrá deshacer este paso.",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Confirmar",
                    closeOnConfirm: false
            }, function(isConfirm){
                if (isConfirm) {
                    // window.location="{{ url('componente') }}/"+numero+"/delete";
                }

            });
        });
    });
    </script>

@endpush
