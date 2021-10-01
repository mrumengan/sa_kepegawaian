$(function () {
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  var uploadUrl = $('#upload-receiver').data('url');
  var viewUrl = $('#upload-receiver').data('view');

  $('#karyawan-photo_file').on('change', function (evt) {
    let fileName = evt.target.files[0].name;
    if (evt.target.files[0].name) {
      $('label.custom-file-label').text(fileName);
    }
  });
  $('#btn-edit-photo').on('click', function () {
    $('#modal-upload').modal({});
  });

  $('#btn-upload').on('click', function () {
    var hasError = false;
    console.log($('#karyawan-photo_file'));
    if (!$('#karyawan-photo_file').prop('files')[0]) {
      hasError = true;
      alert('PDF belum dipilih');
    }
    if (!hasError) {
      $('#form-upload').submit();
    }
  });
});