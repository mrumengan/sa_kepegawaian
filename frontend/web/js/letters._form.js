$(function () {
  var input = document.querySelector('#letters-members'),
    tagify = new Tagify(input, {
      whitelist: initWhitelist,
      enforceWhitelist: false,
    }),
    controller;

  initWhitelist.forEach(function (elm, i) {
    console.log(elm);
    // tagify.addTags(elm.value);
  });
  tagify.addTags(initWhitelist);
  console.log(tagify.value);

  tagify.on('input', onInput);
  function onInput(e) {
    console.log(e.detail);
    var value = e.detail.value
    console.log(value);
    tagify.whitelist = null // reset the whitelist

    // https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
    controller && controller.abort()
    controller = new AbortController()

    // show loading animation and hide the suggestions dropdown
    tagify.loading(true).dropdown.hide()

    fetch(employeeListUrl + '?q=' + value, { signal: controller.signal })
      .then(RES => {
        // console.log(RES.json());
        return RES.json()
      })
      .then(function (newWhitelist) {
        console.log(newWhitelist);
        tagify.whitelist = newWhitelist;
        tagify.loading(false).dropdown.show(value);
      })
  };


  function onChange(e) {
    // outputs a String
    console.log(e.target.value);
  }
});