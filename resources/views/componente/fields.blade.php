<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('idPrograma', 'Programa:') !!}
    {!!Form::select('idPrograma',$programas,null, ['class'=>'form-control','placeholder' => 'Selecciona un programa'])!!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('imagen', 'Imagen:') !!}
    <input type="file" id="imagen" name="imagen">
</div>




@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        //--------------------------------------------------------------------------
        $("#imagen").fileinput({
              language: 'es',
              theme: 'fa',
              showPreview: false,
              showRemove: false,
              showUpload: false,
              allowedFileExtensions: ['jpg', 'jpeg', 'png']
          });
    });
    $('select').select2();
    @isset($componente)
    imagen='{{$componente->imagen}}';
    url1="../../storage/componenteImagen//"+imagen;
    $("#imagen").fileinput({
        initialPreview: [url1],
        initialPreviewAsData: true,
        deleteUrl: "",
        overwriteInitial: true,
        maxFileSize: 100,
    });
    @endisset
    </script>
@endpush
