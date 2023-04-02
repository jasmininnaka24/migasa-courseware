<?php 
  ob_start();
  session_start();
  include '../database.php';
  include '../a_includes/admin_header.php';
?>

<div class="container-fluid">
  <nav>
    <div class="row">
      <div class="col-12">
        <div
          class="d-flex align-items-center justify-content-between mt-4 px-5"
        >
          <div class="d-flex py-3">
            <div style="width: 4rem">
              <img src="../../assets/img/migasa 2.png" width="100%" alt="" />
            </div>
            <h2 style="margin-left: 1rem" class="font-bold">Language Maintenance</h2>

          </div>

          <div class="d-flex align-items-center">
            <a href="../../admin_home.php" class="text-decoration-none">
            <button
              class="btn mt-3 d-flex align-items-center justify-content-center"
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
                  src="../../assets/img/exit.png"
                  style="width: 20px; height: 16px; margin-top: -20px"
                  width="100%"
                  alt=""
                />
              </div>
            </button>
          </a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div>
    <table class="table text-center mx-auto" style="width: 90%;" border="5">
      <thead>
        <tr>
          <th colspan="2">Languages</th>
          <th colspan="2">Maintenance</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="2">Language</td>
          <td>Edit</td>
          <td>Delete</td>
        </tr>
        <tr>
          <td colspan="2">Language</td>
          <td>Edit</td>
          <td>Delete</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<?php include '../a_includes/admin_footer.php' ;?>