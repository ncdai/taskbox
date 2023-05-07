(function ($) {
  $.fn.taskStatus = function (selectSelector, finishedDateSelector) {
    return this.each(function () {
      var $element = $(this);
      var $select = $(selectSelector);

      $select.on('change', function () {
        const el = $(this);

        const taskId = el.attr('data-task-id');
        const prevStatus = el.data('prev-status');
        const nextStatus = el.val();

        const finishedDate = nextStatus === "FINISHED"
          ? new Date().toISOString().slice(0, 19).replace("T", " ")
          : "NULL";

        const $finishedDate = $(`${finishedDateSelector}[data-task-id=${taskId}]`);

        $.ajax({
          url: '/task/update-status?id=' + taskId,
          type: 'POST',
          data: {
            status: nextStatus
          },
          success: function (response) {
            console.log('Success:', response);

            el.attr('data-prev-status', status);
            if (nextStatus === 'FINISHED') {
              $finishedDate.html(finishedDate);
            } else {
              $finishedDate.html("---");
            }

            toastr.success('Update status successfully!');
          },
          error: function (xhr, status, error) {
            console.log('Error:', error);

            el.val(prevStatus);
            $finishedDate.html("---");

            toastr.error('Update status failed!');
          }
        });
      });
    });
  };
})(jQuery);