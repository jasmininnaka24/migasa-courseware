    <!-- Javascript Links -->
    <!-- Summernote Script Functionality -->
    <script src="../../assets/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/summernote/summernote-lite.min.js"></script>
    <script src="../../assets/js/modals.js"></script>
    <script src="../../assets/js/general_func.js"></script>
    <script src="../../assets/js/CRUD_manual.js"></script>
    <script src="../../assets/js/verification.js"></script>
    <script src="../../assets/js/admin_sidebar.js"></script>
    <script src="../../assets/js/guide.js"></script>
    <script src="../../assets/js/add_video.js"></script>
    <script src="../../assets/js/activities_list.js"></script>
    <script src="../../assets/js/activities_crud.js"></script>
    <script>
      $(document).ready(function () {
        $(".summernote").each(function () {
          $(this).summernote({
            height: 100,
            placeholder: "Type something...",
            tableClassName: function () {
              $(this)
                .addClass("table table-bordered")

                .attr("cellpadding", 12)
                .attr("cellspacing", 0)
                .attr("border", 1)
                .css("borderCollapse", "collapse");

              $(this)
                .find("td")
                .css("borderColor", "#999")
                .css("background", "#f5f5f5")
                .css("padding", "15px");
            },

            toolbar: [
            ['font', ['fontsize', 'fontname', 'color']],
            ['style', ['bold', 'italic', '', 'clear']],
            ['insert', ['picture']],
            ['code', ['codeview']],
            ['undo', ['undo']],
            ['redo', ['redo']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
        ],
          });
        });
      });
    </script>




  </body>
</html>
