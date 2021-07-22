Dropzone.autoDiscover = false;
$(function () {
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  var uploadUrl = $('#upload-receiver').data('url');
  var viewUrl = $('#upload-receiver').data('view');
  var myDropzone = new Dropzone("#upload-receiver", {
    url: uploadUrl,
    params: { '_csrf-frontend': csrfToken },
    paramName: "pdf_file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    dictDefaultMessage: "Drag dan drop PDF atau klik",
    accept: function (file, done) {
      if (file.name == "justinbieber.jpg") {
        done("Naha, you don\'t.");
      } else { done(); }
    },
  });
  myDropzone.on("complete", function (file) {
    window.location.replace(viewUrl);
  });

});