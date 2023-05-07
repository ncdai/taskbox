<script>
  $(document).ready(function () {
    <?php if ($action === "update"): ?>
      $("#name").val("<?php echo $category['name']; ?>");
    <?php endif; ?>

    $("#form-category").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        }
      },
      messages: {
        name: {
          required: "Please enter a name",
          minlength: "Name must be at least 3 characters"
        }
      },
      submitHandler: function (form) {
        $.ajax({
          url: "/category/form?action=<?php echo $action; ?>",
          type: "POST",
          data: $(form).serialize(),
          success: function (response) {
            console.log("Form submitted successfully!", response);
            alert("Form submitted successfully!");
            window.location.href = "/category";
          },
          error: function (xhr, status, error) {
            console.log("Form submission error:", error);
            toastr.error("Form submission error!");
          }
        });
      }
    });
  })
</script>