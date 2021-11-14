$(function () {
  console.log('Ready');

  console.log(dateStart);

  var start = moment(dateStart);
  var end = moment(dateEnd);

  function cb(start, end, label) {
    $('#report-range span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    $('#presensisearch-created_at_start').val(start.format('YYYY-MM-DD'));
    $('#presensisearch-created_at_end').val(end.format('YYYY-MM-DD'));
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  }

  $('#report-range').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    alwaysShowCalendars: true,
  }, cb);

  cb(start, end);

  $('#btn-download').on('click', function () {
    console.log(urlDownload + '?start=' + $('#presensisearch-created_at_start').val() + '&end=' + $('#presensisearch-created_at_end').val());
    window.location = urlDownload + '?start=' + $('#presensisearch-created_at_start').val() + '&end=' + $('#presensisearch-created_at_end').val();
  });
});