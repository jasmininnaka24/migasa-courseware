<section class="home-section">
    <div class="d-flex align-items-center justify-content-between">
      <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
      <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
      <div class="d-flex align-items-center">
      <a href="./choose.php" class="text-decoration-none">
        <div
          class="btn mt-2 mt-2 d-flex align-items-center"
          style="height: 2.5rem"
        >
          <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med"
            >
            Home
          </p>
          <div>
            <img
            src="./assets/img/exit 2.png"
            style="width: 20px; height: 16px; margin-top: -20px"
            width="100%"
            alt=""
            />
          </div>
        </div>
      </a>
      <?php if(isset($_GET['course_id_display'])) {?>
      <a href="./courses_display.php?language=all_languages" class="text-decoration-none">
        <div
          class="btn mt-2 mt-2 d-flex align-items-center"
          style="height: 2.5rem"
        >
          <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med"
            >
            Course Listing
          </p>
          <div>
            <img
            src="./assets/img/exit 2.png"
            style="width: 20px; height: 16px; margin-top: -20px"
            width="100%"
            alt=""
            />
          </div>
        </div>
      </a>
      <?php } ?>
      </div>
    </div>