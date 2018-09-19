@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        //--------------------------------------------------------------------------ELIMINAR
        $('#carpetasTable').on('click', '#remove-boton', function(){
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
                    window.location="{{ url('auditoria') }}/"+numero+"/delete";
                }

            });
        });
        //--------------------------------------------------------------------------EDITAR
        $('#carpetasTable').on('click', '#editar-boton', function(){
            $('#modal-editar').modal('toggle');
            this.preventDefault;
            nombre=this.name;
            numero=this.value;
            console.log(numero);
            $('#idAuditoriaEdit').val(numero);
            $('#nombreEdit').val(nombre);
        });
    });
    </script>

@endpush
