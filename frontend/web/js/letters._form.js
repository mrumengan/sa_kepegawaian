$(function () {
  var $tagify = $('#letters-members').tagify({
    whitelist: [
      { "id": 1, "value": "some string" }
    ]
  })
    .on('add', function (e, tagName) {
      console.log('JQEURY EVENT: ', 'added', tagName)
    })
    .on("invalid", function (e, tagName) {
      console.log('JQEURY EVENT: ', "invalid", e, ' ', tagName);
    })
    .on('chage', onChange);


  // get the Tagify instance assigned for this jQuery input object so its methods could be accessed
  var jqTagify = $tagify.data('tagify');
  var controller;

  jqTagify.addTags(["orange", "apple"]);
  $tagify.on('input', function (e) {
    console.log(e);
    var value = e.detail.value
    $tagify.whitelist = null // reset the whitelist

    // https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
    controller && controller.abort()
    controller = new AbortController()

    // show loading animation and hide the suggestions dropdown
    $tagify.loading(true).dropdown.hide()

    fetch('http://get_suggestions.com?value=' + value, { signal: controller.signal })
      .then(RES => RES.json())
      .then(function (newWhitelist) {
        $tagify.whitelist = newWhitelist // update inwhitelist Array in-place
        $tagify.loading(false).dropdown.show(value) // render the suggestions dropdown
      })
  });


  function onChange(e) {
    // outputs a String
    console.log(e.target.value);
  }
});