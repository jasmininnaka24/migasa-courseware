<?php
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './includes/admin_header.php';
  include './includes/admin_sidebar.php';
  

  if(isset($_GET['reset_progress']) && isset($_GET['user_id']) && isset($_GET['course_id'])){
    $user_id = $_GET['user_id'];
    $course_id = $_GET['course_id'];

    $select_retake_num = $conn->prepare("SELECT retake_num FROM enrolled_courses_table WHERE user_id = :user_id AND course_id = :course_id");
    $select_retake_num->bindParam(":user_id", $user_id);
    $select_retake_num->bindParam(":course_id", $course_id);
    $select_retake_num->execute();

    $fetch_retake_num = $select_retake_num->fetch(PDO::FETCH_ASSOC);
    $retake_num = $fetch_retake_num['retake_num'];

    $course_progress = 0;
    $retake_num += 1;
    $user_status = "IN PROGRESS";
    $lifeline = 0;
    $numhours = 0;
    $record_average = "Not Available";

    $reset_user_progress = $conn->prepare("UPDATE enrolled_courses_table SET course_progress = :course_progress, retake_num = :retake_num, user_status = :user_status, lifeline = :lifeline, numhours = :numhours, record_ave = :record_average WHERE user_id = :user_id AND course_id = :course_id");
    $reset_user_progress->bindParam(":course_progress", $course_progress);
    $reset_user_progress->bindParam(":retake_num", $retake_num);
    $reset_user_progress->bindParam(":user_status", $user_status);
    $reset_user_progress->bindParam(":lifeline", $lifeline);
    $reset_user_progress->bindParam(":numhours", $numhours);
    $reset_user_progress->bindParam(":record_average", $record_average);
    $reset_user_progress->bindParam(":user_id", $user_id);
    $reset_user_progress->bindParam(":course_id", $course_id);
    $reset_user_progress->execute();

    $delete_user_acts = $conn->prepare("DELETE FROM user_act_score WHERE user_id = :user_id AND course_id = :course_id");
    $delete_user_acts->bindParam(":user_id", $user_id);
    $delete_user_acts->bindParam(":course_id", $course_id);
    $delete_user_acts->execute();

    header("Location: ./users_main.php?user_id=$user_id&user_tables");
  }
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

  
  #barchart_pagination, 
  #retakers_pagination, 
  #completers_pagination {
    display: flex;
    justify-content: center;
    margin-top: .2rem;
  }

  #barchart_pagination a , 
  #retakers_pagination a , 
  #completers_pagination a{
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

  #barchart_pagination a:hover, 
  #retakers_pagination a:hover, 
  #completers_pagination a:hover{
    background-color: #e7e7e7;
  }

  #barchart_pagination a.active, 
  #retakers_pagination a.active, 
  #completers_pagination a.active {
    color: #fff;
    background-color: #444;
    border-color: #444;
  }
</style>

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
          if(isset($_GET['user_tables'])){
          ?>
        <a href="./user_tables.php" class="text-decoration-none">
          <button
            class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
            style="height: 2.5rem"
            name="home"
          >
            <p
            style="margin-right: 0.4rem; font-size: 18px"
            class="font-med"
            >
            Back to Users Table
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
          <?php }
        ?>
        </div>
      </div>


  <main class="container-fluid">
    <div id="courses">
      <section>
        <article class="rounded-3" style="margin-top: 2%;">
          <?php
            if(isset($_GET['user_id'])){
              $user_id = $_GET['user_id'];
            
              $user_details_db = $conn->prepare("SELECT firstname, lastname, role FROM user_table WHERE id = :user_id");
              $user_details_db->bindParam("user_id", $user_id);
              $user_details_db->execute();

              $fetch_user_det = $user_details_db->fetch(PDO::FETCH_ASSOC);

              $user_name = $fetch_user_det['firstname'] . " " .  $fetch_user_det['lastname'];
              $user_role = $fetch_user_det['role'];

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
              $enrolled_courses_db =  $conn->prepare("SELECT course_id FROM enrolled_courses_table WHERE user_id = :user_id");
              $enrolled_courses_db->bindParam(":user_id", $user_id);
              $enrolled_courses_db->execute();

              $enrolled_courses_count = 0;
              while($enrolled_courses_db->fetch(PDO::FETCH_ASSOC)){
                $enrolled_courses_count += 1;
              }

              ?>

              <div style="padding-top: 3%; padding-bottom: 5%;" id="dlthis">
                <h2 class="container-fluid text-center px-5" style="color: #555"><?php echo $user_name; ?>'s <span style="color: #555;">Performance Rate</span></h2>
                
                <div class="row mt-2">
                  <div class="col-6" >
                  <?php 
                    $success_course_rate = $conn->prepare("SELECT COUNT(*) AS count_finished FROM enrolled_courses_table WHERE course_progress = 100 AND user_id = $user_id");
                    $success_course_rate->execute();
                    $fetch_progress_fin = $success_course_rate->fetch(PDO::FETCH_ASSOC);
                    $success_rate = $fetch_progress_fin['count_finished'];

                    $inprogress_course = $conn->prepare("SELECT COUNT(*) AS count_inprogress FROM enrolled_courses_table WHERE course_progress != 100 AND user_id = $user_id");

                    $inprogress_course->execute();
                    $fetch_progress_inp = $inprogress_course->fetch(PDO::FETCH_ASSOC);
                    $inprogress = $fetch_progress_inp['count_inprogress'];

                          
                    // Set up the Chart.js data object
                    $data = array(
                      'labels' => array('Finished Courses', 'In Progress Courses'),
                      'datasets' => array(
                        array(
                          'label' => 'Dataset 1',
                          'data' => array($success_rate, $inprogress),
                          'backgroundColor' => array('#F5F5DC', '#ADD8E6'),
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
                    document.getElementById('finished').textContent = 'Finished Courses: ' + finished;
                    document.getElementById('inprogress').textContent = 'In Progress Courses: ' + inprogress;
                  </script>
                  </div>


                  <div class="col-6" style="margin-left: -8rem; margin-top: 2rem;">

                  <?php

                  $select_nums_label = $conn->prepare("SELECT DISTINCT course_id FROM enrolled_courses_table WHERE user_id = :user_id");
                  $select_nums_label->bindParam(":user_id", $user_id);
                  $select_nums_label->execute();
                  $prog_count = 0;
                  $course_progress = [];


                  // COURSE PROGRESS GRAPH
                  while($row = $select_nums_label->fetch(PDO::FETCH_ASSOC)) {
                      $prog_count += 1;
                      $course_progress[] = $row['course_id'];
                      
                      // $course_id_chart = $row['course_id'];
                      // $course_title_db = $conn->prepare("SELECT course_title, course_lang_id FROM course_table WHERE id = :course_id");
                      // $course_title_db->bindParam("course_id", $course_id_chart);
                      // $course_title_db->execute();

                      // $fetch_course_title_chart = $course_title_db->fetch(PDO::FETCH_ASSOC);
                      // $course_lang_id_chart = $fetch_course_title_chart['course_lang_id'];
                      
                      // $course_language_db = $conn->prepare("SELECT language FROM language_table WHERE id = :course_lang_id");
                      // $course_language_db->bindParam("course_lang_id", $course_lang_id_chart);
                      // $course_language_db->execute();
                      // $fetch_course_lang_chart = $course_language_db->fetch(PDO::FETCH_ASSOC);
                      // $course_language = $fetch_course_lang_chart['language'];


                      // $course_progress[] = $fetch_course_title_chart['course_title'] . " (".  $course_language . ")";

                  }

                  $select_nums_data = $conn->prepare("SELECT course_progress FROM enrolled_courses_table WHERE user_id = :user_id");
                  $select_nums_data->bindParam(":user_id", $user_id);
                  $select_nums_data->execute();

                  $course_progress_data = [];
                  while ($row_data = $select_nums_data->fetch(PDO::FETCH_ASSOC)) {
                    $course_progress_data[] = $row_data['course_progress'];

                  }

                  ?>

                  <canvas id="barchart" width="100%" height="50%"></canvas>
                  <div id="barchart_pagination"></div>

                  <div class="d-flex justify-content-end mt-3">
                      <div class="btn text-white mx-2" style="cursor: default; background: #555;">No. of enrolled courses: <?php echo $enrolled_courses_count; ?></div>
                  </div>

                  <script>

                  // setup
                  const course_progress = <?php echo json_encode($course_progress); ?>;
                  const course_progress_data = <?php echo json_encode($course_progress_data); ?>;

                  const data = {
                      labels: course_progress,
                      datasets: [{
                          label: "<?php echo $user_name; ?>'s Learning Progress",
                          data: course_progress_data,
                          backgroundColor: [
                              '#9BC2B1',
                              '#BDB6D9',
                              '#ADD8E6',
                              '#D3D3D3',
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
          const paginationContainer = document.getElementById("barchart_pagination");
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
            document.querySelector('.table-art').classList.remove('hidden');
          }, 1000); 
        </script>

      <div class="d-flex align-items-center mx-4">
        <button onclick="downloadPDF()" class="mb-4 btn bgc-gray-light px-4 mx-2 rounded-pill" style="border: 1px solid #444;">Get Chart Data (PDF)</button>
        <button onclick="printDiv('printableArea')" class="mb-4 btn bgc-gray-light px-4 mx-2 rounded-pill" style="border: 1px solid #444;">Get User Data (PDF)</button>
      </div>


      <article class="hidden rounded-3 anim-to-top-slow hidden table-art px-4 mx-4 py-4 my-2 course-container" id="printableArea">
        <div>
          <h3 class="my-b" style="color: #555">Learning Records</h3>
          <table class="course-list table table-bordered">
          <thead class="px-4 rounded-3" style="background: #555; color: #444; background: #e7e7e7;">
              <tr>
                <th class="text-center" style="width: 8%;">ID</th>
                <th>Course Name</th>
                <th class="text-center">Course Language</th>
                <th class="text-center">Learning Progress</th>
                <th class="text-center">Study Hours</th>
                <th class="text-center">Record Average</th>
                <th class="text-center">Retakes (#)</th>
                <th class="text-center">Lifelines Left (#)</th>
                <th class="text-center">Reset Lifeline</th>
                <th class="text-center">Quiz Scores</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(isset($_GET['user_id'])){
                  $user_id = $_GET['user_id'];
                
                $course_details_db = $conn->prepare("SELECT * FROM enrolled_courses_table WHERE user_id = :user_id");
                $course_details_db->bindParam(":user_id", $user_id);
                $course_details_db->execute();

                while($fetch_course_det = $course_details_db->fetch(PDO::FETCH_ASSOC)){
                  $course_id = $fetch_course_det['course_id'];
                  $course_progress = $fetch_course_det['course_progress'];
                  $retake_num = $fetch_course_det['retake_num'];
                  $lifeline = $fetch_course_det['lifeline'];
                  $numhours = $fetch_course_det['numhours'];
                  $record_ave = $fetch_course_det['record_ave'];

                  // getting course details thru its id
                  $course_details =  $conn->prepare("SELECT course_title, course_lang_id FROM course_table WHERE id = :course_id");
                  $course_details->bindParam(":course_id", $course_id);
                  $course_details->execute();
                  $fetch_course_lang = $course_details->fetch(PDO::FETCH_ASSOC);
                  $course_title = $fetch_course_lang['course_title'];
                  $course_lang_id = $fetch_course_lang['course_lang_id'];

                  // getting course details thru its id
                  $course_id_db =  $conn->prepare("SELECT language FROM language_table WHERE id = :course_lang_id");
                  $course_id_db->bindParam(":course_lang_id", $course_lang_id);
                  $course_id_db->execute();
                  $fetch_course_lang = $course_id_db->fetch(PDO::FETCH_ASSOC);
                  $course_lang = $fetch_course_lang['language'];

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
                    <tr class="course-list-row">
                      <td class="text-center"><?php echo $course_id; ?></td>
                      <td>
                        <a class="text-dark text-decoration-none" href="./course_report.php?course_id=<?php echo $course_id;?>">
                          <?php echo $course_title; ?>
                        </a>    
                      </td>                      
                      <td class="text-center"><?php echo $course_lang; ?></td>
                      <td class="text-center"><?php echo $course_progress; ?>%</td>
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
                      <td class="text-center"><?php echo $lifeline; ?></td>
                      <td style="text-align: center;">
                        <a href="./users_main.php?user_id=<?php echo $user_id; ?>&course_id=<?php echo $course_id; ?>&user_tables&reset_progress" onclick="return confirm('Are you sure you want to reset the student\'s progress?')">
                          <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px;">Reset</div>
                        </a>
                      </td>
                      <td style="text-align: center;">
                      <a href="./user_main_score.php?user_id=<?php echo $user_id; ?>&course_id=<?php echo $course_id; ?>">
                        <button class="btn bgc-gray-light rounded-pill user_scores" style="border: 1px solid #444; font-size: 16px;" onclick="show(<?php echo $course_id; ?>)">View</button>
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
      <br>
    </section>

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
          pdf.save('user_learning_progress_chart.pdf');
        });
      }


      function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

        document.location.href = './users_main.php?user_id=<?php echo $user_id; ?>';
      }
    </script>
    


  </main>
  
</section>
<?php include './includes/admin_footer.php'; ?>
