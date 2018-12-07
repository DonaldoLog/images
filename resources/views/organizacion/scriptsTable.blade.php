@push('js')
<script type="text/javascript">

$(document).ready(function() {

    var ruta = route('documentos.datatable').ziggy.baseUrl + "/documentos-datatable/"+ {!!$organizacion->id!!};
    var asset = '{{ asset('storage/archivos/') }}'+"/";
    console.log(asset);
    $('#organizacionTable').DataTable({
                "language":{"url":'{{ asset('js/Spanish.json') }}'},
                "processing": true,
                "serverSide": false,
                "pageLength": 10,
                "order": [[ 1, "asc" ]],
                "deferRender": true,
                "ajax": ruta,
                "columns": [
                    {data: 'id',name: 'id'},
                    {data: 'nombre',name: 'nombre'},
                    {data: null,"orderable": false,
                        render: function(data, type, row) {
                            return "<center><button type='button' value='"+data.id+"' data-toggle='modal' data-target='#myModal' class='btn btn-info ver'>VER</button>"+
                            "<button type='button' value='"+data.id+"'  data-toggle='modal' data-target='#myModal' class='btn btn-warning editar'>EDITAR</button>"+
                            "<a  href='"+asset+data.archivo+"' download class='btn btn-success'>DESCARGAR</a>"+
                            "<button type='button' name='"+data.nombre+"' value='"+data.id+"' class='btn btn-danger eliminar'>ELIMINAR</button>"+
                            "</center>";
                        }
                    }
                ]
    });
    $(".archivo").fileinput({
        language: 'es',
        theme: 'fa',
        showPreview: true,
        showRemove: false,
        showUpload:false,
        allowedFileExtensions: ['jpg', 'jpeg', 'png','xdoc','ppt','pdf', 'xls', 'xlsx','doc']
    });
});


</script>

@endpush
