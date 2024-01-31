<?php
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './includes/admin_header.php';
  include './includes/admin_sidebar.php';
  
?>
<style>
    .table-art{
      box-shadow: 0 3px 20px #888;
      margin: 0 .5 1rem .5rem;
    }
    /* Track */
    ::-webkit-scrollbar-track {
    background: transparent; 
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: transparent; 
    border-radius: 10px;

  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: transparent; 
  }

  #course_report_pagination{
    display: flex;
    justify-content: center;
    margin-top: .2rem;
  }

  #course_report_pagination a {
    display: inline-block;
    padding: 0.2rem .5rem;
    margin: 0 0.2rem;
    color: #555;
    background-color: #eaeae5;
    border: 2px solid #444;
    border-radius: 0.25rem;
    text-decoration: none;
    transition: background-color 0.2s ease;
  }

  #course_report_pagination a:hover{
    background-color: #e7e7e7;
  }

  #course_report_pagination a.active {
    color: #fff;
    background-color: #444;
    border-color: #444;
  }
  
  .course-container {
    padding: .5rem 1rem;
    border: 1px solid #ccc;
    box-shadow: 0 3px 20px #888;
    background-color: #f7f7f7;
    padding: 10px;
    /* overflow-y: scroll; */
    /* min-height: 140px;
    max-height: 320px; */
  }

  .course-container h3 {
    margin-top: 0;
  }

  .course-item {
    list-style: none;
    padding: 5px;
    border-bottom: 1px solid #ccc;
  }

  .course-list {
    border-collapse: collapse;
    /* width: 100%; */
    /* max-width: 600px; */
    margin: auto;
  }

  .course-list th, .course-list td {
    padding: 8px;
    text-align: left;
    vertical-align: top;
  }

  .course-list th {
    font-weight: bold;
    border-bottom: 2px solid #ddd;
  }

  .course-list-row:nth-child(even) {
    background-color: #f2f2f2;
  }
</style>
<body class="bg-light">
<body class="bg-light">
  <section class="home-section">
      <div class="d-flex align-items-center justify-content-between">
        <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
        <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
        <div class="d-flex justify-content-end">
  
          <a href="./main_dashboard.php" class="text-decoration-none">
            <button
            class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
            style="height: 2.5rem"
            name="home"
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
          </button>
        </a>
        <?php 
          if(isset($_GET['course_table'])){
            ?>

            <a href="./course_table.php" class="text-decoration-none">
              <button
                class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
                style="height: 2.5rem"
                name="home"
              >
                <p
                style="margin-right: 0.4rem; font-size: 18px"
                class="font-med"
                >
                Back to Course Table
              </p>
              <div>
                <img
                src="./assets/img/exit 2.png"
                style="width: 20px; height: 16px; margin-top: -20px"
                width="100%"
                alt=""
                />
              </div>
            </button>
            </a>

            <?php
          }
        ?>
        </div>
      </div>
      
  <main class="container-fluid">
    <div id="courses">
      <section>
        <article class="rounded-3" style="margin-top: 2%;">
          <?php
            if(isset($_GET['course_id'])){
              $course_id = $_GET['course_id'];
            
              $course_details_db = $conn->prepare("SELECT id, course_title, course_lang_id FROM course_table WHERE id = :course_id");
              $course_details_db->bindParam(":course_id", $course_id);
              $course_details_db->execute();

              $fetch_course_det = $course_details_db->fetch(PDO::FETCH_ASSOC);

              $course_title = $fetch_course_det['course_title'];
              $course_lang_id = $fetch_course_det['course_lang_id'];

              // getting course_title
              $course_db =  $conn->prepare("SELECT course_title FROM course_table WHERE id = :course_id");
              $course_db->bindParam(":course_id", $course_id);
              $course_db->execute();
              $fetch_course_title = $course_db->fetch(PDO::FETCH_ASSOC);
              $course_title = $fetch_course_title['course_title'];

              // getting language thru its id
              $lang_id_db =  $conn->prepare("SELECT language FROM language_table WHERE id = :course_lang_id");
              $lang_id_db->bindParam(":course_lang_id", $course_lang_id);
              $lang_id_db->execute();
              $fetch_course_lang = $lang_id_db->fetch(PDO::FETCH_ASSOC);
              $course_lang = $fetch_course_lang['language'];

              // getting the number of enrolled student under this course
              $enrolled_db =  $conn->prepare("SELECT user_id FROM enrolled_courses_table WHERE course_id = :course_id");
              $enrolled_db->bindParam(":course_id", $course_id);
              $enrolled_db->execute();

              $enrolled_user_count = 0;
              while($enrolled_db->fetch(PDO::FETCH_ASSOC)){
                $enrolled_user_count += 1;
              }

              ?>

              <div style="padding-top: 2%; padding-bottom: 3%;" id="dlthis" >
                <h1 class="container text-center mb-1" style="color: #444;"><?php echo $course_title; ?> <span style="color: #777; font-size: 16px;">(<?php echo $course_lang;?>)</span></h1>
                <h5 class="text-center" style="color: #777; padding-bottom: 2%;">Success Performance Rate</h5>
                
                <div class="row mt-2">
                  <div class="col-6" >
                  <?php 
                    $success_course_rate = $conn->prepare("SELECT COUNT(*) AS count_finished FROM enrolled_courses_table WHERE course_progress = 100 AND course_id = $course_id");
                    $success_course_rate->execute();
                    $fetch_progress_fin = $success_course_rate->fetch(PDO::FETCH_ASSOC);
                    $success_rate = $fetch_progress_fin['count_finished'];

                    $inprogress_course = $conn->prepare("SELECT COUNT(*) AS count_inprogress FROM enrolled_courses_table WHERE course_progress != 100 AND course_id = $course_id");

                    $inprogress_course->execute();
                    $fetch_progress_inp = $inprogress_course->fetch(PDO::FETCH_ASSOC);
                    $inprogress = $fetch_progress_inp['count_inprogress'];

                          
                    // Set up the Chart.js data object
                    $data = array(
                      'labels' => array('Finished Status', 'In Progress Status'),
                      'datasets' => array(
                        array(
                          'label' => 'Dataset 1',
                          'data' => array($success_rate, $inprogress),
                          'backgroundColor' => array('#BDB6D9', '#ADD8E6'),
                          'borderColor' => array('rgba(0, 0, 0, .8)', 'rgba(0, 0, 0, .8)'),
                          'borderWidth' => 1,
                        ),
                      ),
                    );

                    // Set up the Chart.js config object
                    $config = array(
                      'type' => 'pie',
                      'data' => $data,
                      'options' => array(
                        'responsive' => true,
                        'plugins' => array(
                          'legend' => array(
                            'position' => 'top',
                          ),
                          'title' => array(
                            'display' => true,
                            'text' => 'Chart.js Pie Chart',
                          ),
                        ),
                        'animation' => array(
                          'animateScale' => true, // Enable scale animation
                          'animateRotate' => true // Enable rotation animation
                        )
                      ),
                    );

                    

                  ?>
                  <div class="mt-3">
                    <canvas id="pieChart_<?php echo $course_id; ?>"></canvas>
                  </div>
                  <div class="mt-3 d-flex align-items-center justify-content-center">
                    <div id="finished" class="mx-4"></div>
                    <div id="inprogress" class="mx-4"></div>
                  </div>

                  <!-- setup block -->
                  <script>
                    // Render the chart
                    const pieChart_<?php echo $course_id; ?> = new Chart (
                      document.getElementById('pieChart_<?php echo $course_id; ?>'),
                      <?php echo json_encode($config); ?>
                    );

                    const finished = <?php echo $success_rate; ?>;
                    const inprogress = <?php echo $inprogress; ?>;
                    document.getElementById('finished').textContent = 'Finished Status: ' + finished;
                    document.getElementById('inprogress').textContent = 'In Progress Status: ' + inprogress;


                  </script>
                  </div>


                  <div class="col-6" style="margin-left: -8rem; margin-top: 2rem;">

                  <?php

                  $select_nums_label = $conn->prepare("SELECT DISTINCT course_progress FROM enrolled_courses_table WHERE course_id = :course_id");
                  $select_nums_label->bindParam(":course_id", $course_id);
                  $select_nums_label->execute();
                  $prog_count = 0;
                  $course_progress = [];

                  while($row = $select_nums_label->fetch(PDO::FETCH_ASSOC)) {
                      $prog_count += 1;
                      $course_progress[] = $row['course_progress'];
                  }

                  $select_nums_data = $conn->prepare("SELECT DISTINCT course_progress FROM enrolled_courses_table WHERE course_id = :course_id");
                  $select_nums_data->bindParam(":course_id", $course_id);
                  $select_nums_data->execute();

                  $retaker_count_num = $conn->prepare("SELECT user_id FROM enrolled_courses_table WHERE course_id = :course_id AND retake_num != 0");
                  $retaker_count_num->bindParam(":course_id", $course_id);
                  $retaker_count_num->execute();

                  $retaker_count = 0;
                  while($retaker_count_num->fetch(PDO::FETCH_ASSOC)){
                    $retaker_count += 1;
                  }

                  $course_progress_data = [];
                  while ($row_data = $select_nums_data->fetch(PDO::FETCH_ASSOC)) {
                      $column_count = $row_data['course_progress'];

                      $progress_count = $conn->prepare("SELECT COUNT(*) AS count_val FROM enrolled_courses_table WHERE course_progress = :column_count AND course_id = :course_id");
                      $progress_count->bindParam(":column_count", $column_count);
                      $progress_count->bindParam(":course_id", $course_id);
                      $progress_count->execute();
                      $val_count = $progress_count->fetch(PDO::FETCH_ASSOC);
                      $course_progress_data[] = $val_count['count_val'];
                  }

                  ?>

                  <canvas id="barchart" width="100%" height="50%"></canvas>
                  <div id="course_report_pagination" class="mb-5"></div>

                  <div class="d-flex justify-content-center mt-3">
                      <div class="btn text-white mx-2" style="cursor: default; background: #555;">No. of enrollees: <?php echo $enrolled_user_count; ?></div>
                      <div class="btn text-white mx-2" style="cursor: default; background: #555;">No. of completers: <?php echo $success_rate; ?></div>
                      <div class="btn text-white" style="cursor: default; background: #555;">No. of retakers: <?php echo $retaker_count; ?></div>
                  </div>

                  <script>

                  // setup
                  const course_progress = <?php echo json_encode($course_progress); ?>;
                  const course_progress_data = <?php echo json_encode($course_progress_data); ?>;

                  const options = {
                    title: {
                      display: false 
                    },
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem) {
                          return tooltipItem.yLabel;
                        }
                      }
                    }
                  };

                  const data = {
                      labels: course_progress_data,
                      datasets: [{
                          label: "<?php echo $course_title; ?>'s Performance Rate",
                          data: course_progress,
                          backgroundColor: [
                              '#BDB6D9',
                              '#9BC2B1',
                              '#F5F5DC',
                              '#ADD8E6'
                          ],
                          borderColor: [
                              'rgba(0, 0, 0, .8)',
                              'rgba(0, 0, 0, .8)',
                              'rgba(0, 0, 0, .8)',
                              'rgba(0, 0, 0, .8)',
                          ],

                          borderWidth: 1
                        }]
                    };

                    // config
                    const config = {
                      type: 'bar',
                      data,
                      options: {
                        scales: {
                          yAxes: [{
                            ticks: {
                              beginAtZero:true,
                              max: 100,
                            }
                          }]
                        }
                      }
                    }
                    

                    // render
                    const barchart = new Chart(
                      document.getElementById('barchart'),
                      config
                    )

                    

                    // BAR GRAPH'S PAGINATION FUNCTIONALITY
                    const itemsPerPage = 4;

                    // Get the data for the chart
                    const chartData = data.datasets[0].data;
                    const chartLabels = data.labels;

                    // Calculate the total number of pages
                    const totalPages = Math.ceil(chartData.length / itemsPerPage);

                    // Define the current page and starting index
                    let currentPage = 1;
                    let startIndex = 0;

                    // Render the pagination links
                    const paginationContainer = document.getElementById("course_report_pagination");
                    for (let i = 1; i <= totalPages; i++) {
                      const link = document.createElement("a");
                      link.href = "#";
                      link.textContent = i;
                      if (i === currentPage) {
                        link.classList.add("active");
                      }
                      link.addEventListener("click", (event) => {
                        event.preventDefault();
                        currentPage = i;
                        startIndex = (i - 1) * itemsPerPage;
                        renderChart();
                        updatePagination();
                      });
                      paginationContainer.appendChild(link);
                    }

                    // Define a function to update the pagination links
                    function updatePagination() {
                      const links = paginationContainer.querySelectorAll("a");
                      links.forEach((link, index) => {
                        const pageNumber = index + 1;
                        if (pageNumber < currentPage - 1 || pageNumber > currentPage + 1) {
                          link.style.display = "none";
                        } else {
                          link.style.display = "inline-block";
                          link.textContent = pageNumber;
                          if (pageNumber === currentPage) {
                            link.classList.add("active");
                          } else {
                            link.classList.remove("active");
                          }
                        }
                      });
                    }

                    // function updatePagination() {
                    //   const links = paginationContainer.querySelectorAll("a");
                    //   links.forEach((link, index) => {
                    //     if (index + 1 === currentPage) {
                    //       link.classList.add("active");
                    //     } else {
                    //       link.classList.remove("active");
                    //     }
                    //   });
                    // }

                    // Define a function to render the chart
                    function renderChart() {
                      const chartDataSubset = chartData.slice(startIndex, startIndex + itemsPerPage);
                      const chartLabelsSubset = chartLabels.slice(startIndex, startIndex + itemsPerPage);
                      barchart.data.datasets[0].data = chartDataSubset;
                      barchart.data.labels = chartLabelsSubset;
                      barchart.update();
                    }

                    // Render the initial chart and pagination
                    renderChart();
                    updatePagination();

                  </script>


                  </div>
                </div>
              </div>
              <?php
            }            
          ?>

      <script>
          setTimeout(function() {
            document.getElementById('course-det').classList.remove('hidden');
            document.querySelector('.table-art').classList.remove('hidden');
          }, 1000); 
        </script>
      </script>

      <div class="d-flex align-items-center mx-4">
        <button onclick="downloadPDF()" class="mb-4 btn bgc-gray-light px-4 mx-2 rounded-pill" style="border: 1px solid #444;">Get Chart Data (PDF)</button>
        <button onclick="printDiv('printableArea')" class="mb-4 btn bgc-gray-light px-4 mx-2 rounded-pill" style="border: 1px solid #444;">Get User Data (PDF)</button>
      </div>

      <article class="hidden rounded-3 anim-to-top-slow hidden table-art px-4 mx-4 py-4 my-2 course-container" id="printableArea">
        <div class="anim-to-top-slow hidden" id="course-det">
          <h3 class="my-b" style="color: #555">Users who are taking <?php echo $course_title; ?></h3>
          <table class="course-list table table-bordered">
            <thead class="px-4 rounded-3" style="background: #555; color: #444; background: #e7e7e7;">
              <tr>
                <th class="text-center" style="width: 8%;">ID</th>
                <th>User Name</th>
                <th class="text-center">Course Progress</th>
                <th class="text-center">Study Hours</th>
                <th class="text-center">Record Average</th>
                <th class="text-center">Retakes (#)</th>
                <th class="text-center">Quiz Scores</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(isset($_GET['course_id'])){

                  
                  $course_id = $_GET['course_id'];
                
                  $course_details_db = $conn->prepare("SELECT * FROM enrolled_courses_table WHERE course_id = :course_id");
                  $course_details_db->bindParam(":course_id", $course_id);
                  $course_details_db->execute();

                while($fetch_course_det = $course_details_db->fetch(PDO::FETCH_ASSOC)){
                  $user_id = $fetch_course_det['user_id'];
                  $course_progress = $fetch_course_det['course_progress'];
                  $numhours = $fetch_course_det['numhours'];
                  $record_ave = $fetch_course_det['record_ave'];
                  $retake_num = $fetch_course_det['retake_num'];

                  $username_db = $conn->prepare("SELECT firstname, lastname FROM user_table WHERE id = :user_id");
                  $username_db->bindParam(":user_id", $user_id);
                  $username_db->execute();
                  $fetch_username = $username_db->fetch(PDO::FETCH_ASSOC);
                  $username = $fetch_username['firstname'] . " " . $fetch_username['lastname'];

                  ?>

                    <tr class="course-list-row">
                      <td class="text-center"><?php echo $user_id; ?></td>
                      <td>
                        <a class="text-dark text-decoration-none" href="./users_main.php?user_id=<?php echo $user_id;?>">
                          <?php echo $username; ?>
                        </a>    
                      </td>                     <td class="text-center"><?php echo $course_progress; ?>%</td>
                      <td class="text-center">
                        <?php
                          $numhours_display = $numhours . ($numhours > 1 ? ' hrs' : ' hr');
                          echo $numhours_display;
                        ?>
                      </td>
                      <td class="text-center">
                        <?php
                          $record_ave = $record_ave != 100 ? $record_ave : $record_ave;
                          echo $record_ave;
                        ?>
                      </td>
                      <td class="text-center"><?php echo $retake_num; ?></td>
                      <td style="text-align: center;">
                        <a href="./course_main_scores.php?course_id=<?php echo $course_id;?>&user_id=<?php echo $user_id;?>">
                          <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px;">View</div>
                        </a>
                      </td>
                     </tr>

                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        </article>

        <br>
        </article>
        
      </section>
    </div>


    <script src="./assets/pdf.js-master/src/pdf.js"></script>
    <script src="./assets/pdf.js-master/src/pdf.worker.js"></script>
    <script src="./assets/pdf.js-master/src/jspdf.debug.js"></script>
    <script src="../admin/assets/html2canvas/dist/html2canvas.min.js"></script>
    <script>
                
      function downloadPDF() {
        const dlthis = document.getElementById('dlthis');

        // create a new canvas with a white background
        html2canvas(dlthis).then(canvas => {
          // determine the image dimensions based on the canvas size and desired width
          const imageWidth = 8.5 * 72; // convert inches to points (72 points per inch)
          const imageHeight = (canvas.height / canvas.width) * imageWidth;

          // calculate the total height of the PDF (including margins)
          const totalHeight = imageHeight + 40;

          // convert the canvas to an image with the desired dimensions
          const chartImage = canvas.toDataURL('image/jpeg', 1.0);
          const resizedImage = new Image();
          resizedImage.src = chartImage;
          resizedImage.width = imageWidth;
          resizedImage.height = imageHeight;

          // create the PDF
          const pdf = new jsPDF('landscape', 'pt', [imageWidth, totalHeight]);
          pdf.setFontSize(20);

          // add the resized image to the PDF with margins
          pdf.addImage(resizedImage, 'JPEG', 0, 20, imageWidth, imageHeight, null, 'FAST');


          // save the PDF
          pdf.save('course_performance_rate_chart.pdf');
        });
      }


      function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

        document.location.href = './course_report.php?course_id=<?php echo $course_id; ?>';
      }
    </script>
    
  </main>

</section>
<?php include './includes/admin_footer.php'; ?>
