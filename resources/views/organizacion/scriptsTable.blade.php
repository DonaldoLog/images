@push('js')
<script type="text/javascript">

$(".archivo").fileinput({
      language: 'es',
      theme: 'fa',
      showPreview: true,
      showRemove: false,
      showUpload:false,
      allowedFileExtensions: ['jpg', 'jpeg', 'png','xdoc','ppt','pdf', 'xls', 'xlsx']
  });

</script>

@endpush
