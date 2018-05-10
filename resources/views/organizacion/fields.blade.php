<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('idComponente', 'Componente:') !!}
    {!!Form::select('idComponente',$componentes,null, ['class'=>'form-control','placeholder' => 'Selecciona un componente'])!!}
</div>





@push('js')
    <script type="text/javascript">
    $(document).ready(function() {
        //--------------------------------------------------------------------------
        $('select').select2();
    });
    </script>
@endpush
