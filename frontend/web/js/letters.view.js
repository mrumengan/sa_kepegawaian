$(function () {
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  var uploadUrl = $('#upload-receiver').data('url');
  var viewUrl = $('#upload-receiver').data('view');

  $('#letters-pdf_file').on('change', function (evt) {
    let fileName = evt.target.files[0].name;
    if (evt.target.files[0].name) {
      $('label.custom-file-label').text(fileName);
    }
  });

  $('#btn-upload').on('click', function () {
    var hasError = false;
    console.log($('#letters-pdf_file').prop('files')[0], $('#letters-pdf_file').prop('files')[0]);
    if (!$('#letters-pdf_file').prop('files')[0]) {
      hasError = true;
      alert('File belum dipilih');
    }
    if ($('#letters-status').val() == 5) {
      hasError = true;
      alert('Status belum diganti');
    }
    if (!hasError) {
      $('#form-upload').submit();
    }
  });
});