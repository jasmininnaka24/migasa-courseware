  <!-- Invalid Modal -->
  <div class="hidden unhide">
    <div class="invalid_modal_container">
      <div class="invalid_modal d-flex flex-column ">
        <div class="h4">
          Please fill out the empty field.
        </div>
        <button
          type="submit"
          style="font-size: 15px"
          class="btn btn-dark text-light rounded-pill mt-2 px-4 py-2 font-bold ok"
          >
          Ok
        </button>
      </div>
    </div>
  </div>

  <!-- Error message pop up -->
  <script>
    const ok = document.querySelector(".ok");
    ok.addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector(".unhide").classList.add("hidden");
        e.preventDefault();
    });
  </script>



<!-- Updated -->
<!-- <div class="updatedd hidden position-fixed" style="top: 0; left: 0; z-index: 9999;">
  <div class="invalid_modal_container">
    <div class="invalid_modal d-flex flex-column" style="background: #ddf5d9; color: #444">
      <div class="h2">
        SUCCESSFULLY UPDATED!
      </div>
    </div>
  </div>
</div>

<script>
    const updatedd = document.querySelector(".updatedd");
    updatedd.addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector(".unhide").classList.add("hidden");
        e.preventDefault();
    });
  </script> -->
    