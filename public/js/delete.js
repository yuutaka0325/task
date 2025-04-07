$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': '{{ csrf_token() }}'
  }
});
function deleteEvent() {
  $('.delete').on('click', function (e) {
    console.log("ajax_start");
    e.preventDefault();
    var deleteConfirm = confirm('削除してよろしいでしょうか？');

    if (deleteConfirm == true) {
      var clickEle = $(this)
      var destroyID = clickEle.attr('data-product_id');

      $.ajax({
        type: 'POST',
        url: 'destroy/' + destroyID,
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { 'id': destroyID },
      })
        .done(function () {
          clickEle.parents('tr').remove();
          doSearch();
        })

        .fail(function () {
          alert('エラー');
        });

    } else {
      (function (e) {
        e.preventDefault()
      });
    };
  });
}

$(function () {
  deleteEvent();
});