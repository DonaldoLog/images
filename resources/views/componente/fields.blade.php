<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('imagen', 'Imagen:') !!}
    <input type="file" id="imagen" name="imagen">
</div>

<div class="form-group col-sm-6">
    {!! Form::label('idPrograma', 'Programa:') !!}
    {!!Form::select('idPrograma',[],null, ['class'=>'form-control','placeholder' => 'Pick...'])!!}
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
              allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif', 'pdf']
          });
    });

    </script>
@endpush
