<script src="{{ asset('tinymce/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#content', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
    toolbar: `undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table |
    formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat |
    image
    `
  });

  tinymce.init({
    selector: 'input#input', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
    toolbar: `undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table |
    formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat |
    image
    `
  });
</script>
