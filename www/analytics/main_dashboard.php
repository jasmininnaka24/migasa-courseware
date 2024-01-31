<?php
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './includes/admin_header.php';
  include './includes/admin_sidebar.php';

  if(isset($_POST['admin_logout'])){
    $_SESSION['password'] = null;
    $_SESSION['username'] = null;
    $_SESSION['role'] = null;
    
    header("Location: ../hero_section.php");
  }
  
?>
<style>

  *{
    font-family: 'Open Sans', sans-serif;
  }

  /* fonts in classes */
  .font-reg{
    font-family: 'Open Sans', sans-serif;  
  }
  .font-med{
    font-family: 'Open Sans', sans-serif; 
    font-weight: 600; 
  }
  .font-bold{
    font-family: 'Open Sans', sans-serif;  
    font-weight: 700; 
  }
  .font-italic{
    font-family: 'Open Sans', sans-serif;  
  }


  #enrollees_pagination, 
  #retakers_pagination, 
  #completers_pagination {
    display: flex;
    justify-content: center;
    margin-top: .2rem;
  }

  #enrollees_pagination a , 
  #retakers_pagination a , 
  #completers_pagination a{
    display: inline-block;
    padding: 0.2rem .5rem;
    margin: 0 0.2rem;
    color: #444;
    background-color: #eaeae5;
    border: 2px solid #444;
    border-radius: 0.25rem;
    text-decoration: none;
    transition: background-color 0.2s ease;
  }

  #enrollees_pagination a:hover, 
  #retakers_pagination a:hover, 
  #completers_pagination a:hover{
    background-color: #e7e7e7;
  }

  #enrollees_pagination a.active, 
  #retakers_pagination a.active, 
  #completers_pagination a.active {
    color: #fff;
    background-color: #444;
    border-color: #444;
  }

  ::-webkit-scrollbar {
    width: 0px;
  }

  ::-webkit-scrollbar-track {
    background: transparent; 
  }
  
  ::-webkit-scrollbar-thumb {
    background: transparent; 
    border-radius: 10px;

  }

  ::-webkit-scrollbar-thumb:hover {
    background: transparent; 
  }

</style>


<section class="home-section">
    <div class="d-flex align-items-center justify-content-between">
      <i class='bx bx-menu-alt-left' style="font-size: 38px; cursor: pointer;"></i>
      <i class="fa-regular fa-circle-xmark hidden" style="font-size: 30px; cursor: pointer;"></i>
      <form action="" method="POST">

        <button
        class="btn mt-2 mt-2 d-flex align-items-center justify-content-center"
        style="height: 2.5rem"
        name="admin_logout"
        >
          <p
          style="margin-right: 0.4rem; font-size: 18px"
          class="font-med"
          >
          Logout
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
    </form>
    </div>

    







    <main class="container-fluid mt-3">
    
    <div id="todl">
      <div class="d-flex px-4 align-items-center justify-content-center">
        <?php 
          $total_users_db = $conn->prepare("SELECT id FROM user_table WHERE role = 'Professional' OR role = 'Student'");
          $total_users_db->execute();
          $total_user_count = 0;
          while($total_users_db->fetch(PDO::FETCH_ASSOC)){
            $total_user_count += 1;
          }

          
          $section_db = $conn->prepare("SELECT id FROM user_group_table");
          $section_db->execute();
          $total_sec_count = 0;
          while($section_db->fetch(PDO::FETCH_ASSOC)){
            $total_sec_count += 1;
          }

          
          $courses_db = $conn->prepare("SELECT id FROM course_table");
          $courses_db->execute();
          $total_course_count = 0;
          while($courses_db->fetch(PDO::FETCH_ASSOC)){
            $total_course_count += 1;
          }

          
          $language_db = $conn->prepare("SELECT id FROM language_table");
          $language_db->execute();
          $total_lang_count = 0;
          while($language_db->fetch(PDO::FETCH_ASSOC)){
            $total_lang_count += 1;
          }


        ?>
        <div class="col-3 mx-1 p-3 " style="height: 7rem; background: #f7fafa; color:#444; border: #999 1px solid; font-size: 20px; border-radius: 10px;">
          <div class="text-center font-bold" style="font-size: 35px;"><?php echo $total_user_count; ?></div>
          <div class="text-center">
            <span class="count_top">
              <i class="fa fa-user" style="margin-right: .2rem; font-size: 23px;"></i>
            </span>
            <span style="font-size: 20px;">
              Total Users
            </span>
          </div>
        </div>

        <div class="col-3 mx-1 p-3 " style="height: 7rem; background: #f7fafa; color:#444; border: #999 1px solid; font-size: 20px; border-radius: 10px;">
          <div class="text-center font-bold" style="font-size: 35px;"><?php echo $total_sec_count; ?></div>
          <div class="text-center">
            <span class="count_top">
              <i class="fa fa-user" style="margin-right: .2rem; font-size: 23px;"></i>
            </span>
            <span style="font-size: 20px;">
              Number of Sections
            </span>
          </div>
        </div>

        <div class="col-3 mx-1 p-3" style="height: 7rem; background: #f7fafa; color:#444; border: #999 1px solid; font-size: 20px; border-radius: 10px;">
          <div class="text-center font-bold" style="font-size: 35px;"><?php echo $total_course_count; ?></div>
          <div class="text-center">
            <span class="count_top">
              <i class="fa fa-user" style="margin-right: .2rem; font-size: 23px;"></i>
            </span>
            <span style="font-size: 20px;">
              Number of Courses
            </span>
          </div>
        </div>

        <div class="col-3 mx-1 p-3" style="height: 7rem; background: #f7fafa; color:#444; border: #999 1px solid; font-size: 20px; border-radius: 10px;">
          <div class="text-center font-bold" style="font-size: 35px;"><?php echo $total_lang_count; ?></div>
          <div class="text-center">
            <span class="count_top">
              <i class="fa fa-book" style="margin-right: .1rem; font-size: 21px;"></i>
            </span>
            <span style="font-size: 20px;">
              Number of Languages
            </span>
          </div>
        </div>
        </div>

      <div class="row mt-4">
        <div class="col-5">
          <?php 
            $prof_user_db = $conn->prepare("SELECT COUNT(*) AS count_prof FROM user_table WHERE role = 'Professional'");
            $prof_user_db->execute();
            $fetch_prof_count = $prof_user_db->fetch(PDO::FETCH_ASSOC);
            $prof_count = $fetch_prof_count['count_prof'];

            $stud_user_db = $conn->prepare("SELECT COUNT(*) AS count_stud FROM user_table WHERE role = 'Student'");
            $stud_user_db->execute();
            $fetch_stud_count = $stud_user_db->fetch(PDO::FETCH_ASSOC);
            $stud_count = $fetch_stud_count['count_stud'];
                  
            // Set up the Chart.js data object
            $data = array(
              'labels' => array('Professional', 'Student'),
              'datasets' => array(
                array(
                  'label' => 'Dataset 1',
                  'data' => array($prof_count, $stud_count),
                  'backgroundColor' => array('#F5F5DC', '#9BC2B1'),
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
              ),
            );


          ?>
          <div>
            <h4 class="text-center" style="color: #444">USER CATEGORY</h4>
            <canvas id="pieChart" width="50%" height="32%"></canvas>
          </div>
          <div class="d-flex flex-column text-center">
            <div id="studCount" class="mx-4 font-med"></div>
            <div id="profCount" class="mx-4 font-med"></div>
          </div>

          <!-- setup block -->
          <script>
            // Render the chart
            const pieChart = new Chart (
              document.getElementById('pieChart'),
              <?php echo json_encode($config); ?>
            );

            // Calculate and display the total number of users
            const profCount = <?php echo $prof_count; ?>;
            const studCount = <?php echo $stud_count; ?>;
            document.getElementById('profCount').textContent = 'Professional users: ' + profCount;
            document.getElementById('studCount').textContent = 'Student users: ' + studCount;

            setTimeout(() => {
              document.querySelector('.table-art').classList.remove('hidden');
            }, 0500);

          </script>

        </div>

        <div class="col-7 anim-to-top" style="margin-left: -3rem;">
          <div id="dlthis">
            <h4 class="text-center" style="color: #444">NUMBER OF ENROLLEES PER COURSE</h4>
            <canvas id="enrollees_chart" width="100%" height="50%"></canvas>
            <div id="enrollees_pagination"></div>
          </div>
          <?php



            $select_nums_label = $conn->prepare("SELECT id FROM course_table");
            $select_nums_label->execute();
            $prog_count = 0;
            $enrolled_users_label = [];
            $enrolled_users_data = [];

            while($row = $select_nums_label->fetch(PDO::FETCH_ASSOC)) {
              $course_id= $row['id'];
              $enrolled_users_label[] = $row['id'];


              $progress_count = $conn->prepare("SELECT COUNT(DISTINCT user_id) FROM enrolled_courses_table WHERE course_id = :course_id");
              $progress_count->bindParam(':course_id', $course_id);
              $progress_count->execute();
              $count = $progress_count->fetchColumn();

              $enrolled_users_data[] = $count;
              

            }


          ?>

          <script>

          // setup
          const course_progress = <?php echo json_encode($enrolled_users_data); ?>;
          const course_progress_data = <?php echo json_encode($enrolled_users_label); ?>;
          const data = {
              labels: course_progress_data,
              datasets: [{
                  label: "Number of Enrollees per Course",
                  data: course_progress,
                  backgroundColor: [
                      '#BDB6D9',
                      '#ADD8E6',
                      '#9BC2B1',
                      '#D3D3D3',
                  ],
                  borderColor: [
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                      'rgba(0, 0, 0, .8)',
                  ],

                  borderWidth: 1
                }]
            };


            const bgColor = {
              id: 'bgColor',
              beforeDraw: (chart, options) => {
                const { ctx, width, height } = chart;
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, width, height);
                ctx.restore();
              }
            }

            // config
            const config = {
              type: 'bar',
              data,
              options: {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero:true,
                      max: <?php echo $total_user_count; ?>,
                    }
                  }]
                }
              },
              plugins: [bgColor]
            }

            // render
            const enrollees_chart = new Chart(
              document.getElementById('enrollees_chart'),
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
            const paginationContainer = document.getElementById("enrollees_pagination");
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
              enrollees_chart.data.datasets[0].data = chartDataSubset;
              enrollees_chart.data.labels = chartLabelsSubset;
              enrollees_chart.update();
            }

            // Render the initial chart and pagination
            renderChart();
            updatePagination();

          </script>
        </div>

      </div>
    </div>

    <button onclick="downloadPDF()" class="mt-5 btn bgc-gray-light px-4 mx-2 rounded-pill" style="border: 1px solid #444;">Get Chart Data (PDF)</button>


    <script src="./assets/pdf.js-master/src/pdf.js"></script>
    <script src="./assets/pdf.js-master/src/pdf.worker.js"></script>
    <script src="./assets/pdf.js-master/src/jspdf.debug.js"></script>
    <script src="../admin/assets/html2canvas/dist/html2canvas.min.js"></script>
    <script>
      function downloadPDF() {
        const dlthis = document.getElementById('todl');

        // create a new canvas with a white background
        html2canvas(dlthis).then(canvas => {
          // determine the image dimensions based on the canvas size and desired width
          const imageWidth = 8.5 * 72; // convert inches to points (72 points per inch)
          const imageHeight = (canvas.height / canvas.width) * imageWidth;

          // calculate the total height of the PDF (including margins)
          const totalHeight = imageHeight + 35;

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
          pdf.save('home_chart.pdf');
        });
      }
    </script>

    <div class="row mt-5 mb-3 anim-to-top-slow">
      <div class="col-12">
        <div class="course-list-container">
          <table class="course-list">
            <thead class="px-4 rounded-3" style="background: #f7fafa; color: #444;">
              <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th class="text-center font-bold">Language</th>
                <th class="text-center font-bold">Total Enrollees</th>
                <th class="text-center font-bold">Completers (#)</th>
                <th class="text-center font-bold">Retakers (#)</th>
                <th class="text-center font-bold">General Record Average</th>
                <th class="text-center font-bold">See Data</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $course_deatils_db = $conn->prepare("SELECT id, course_title, course_lang_id FROM course_table");
                $course_deatils_db->execute();

                while($fetch_course_det = $course_deatils_db->fetch(PDO::FETCH_ASSOC)){
                  $course_id = $fetch_course_det['id'];
                  $course_title = $fetch_course_det['course_title'];
                  $course_lang_id = $fetch_course_det['course_lang_id'];

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

                  $success_course_rate = $conn->prepare("SELECT COUNT(*) AS count_finished FROM enrolled_courses_table WHERE course_progress = 100 AND course_id = $course_id");
                  $success_course_rate->execute();
                  $fetch_progress_fin = $success_course_rate->fetch(PDO::FETCH_ASSOC);
                  $success_rate = $fetch_progress_fin['count_finished'];

                  $retaker_count_num = $conn->prepare("SELECT user_id FROM enrolled_courses_table WHERE course_id = :course_id AND retake_num != 0");
                  $retaker_count_num->bindParam(":course_id", $course_id);
                  $retaker_count_num->execute();

                  $gen_record_ave_db = $conn->prepare("SELECT record_ave FROM enrolled_courses_table WHERE course_id = :course_id AND user_status = 'FINISHED'");
                  $gen_record_ave_db->bindParam(":course_id", $course_id);
                  $gen_record_ave_db->execute();
                  
                  $gen_record_count = 0;
                  $record_ave_gen = 0;
                  while($fetch_gen_rec = $gen_record_ave_db->fetch(PDO::FETCH_ASSOC)){
                    $record_ave_gen += $fetch_gen_rec['record_ave'];
                    $gen_record_count += 1;
                  }

                  if ($gen_record_count > 0) {
                    $general_record_average = round($record_ave_gen / $gen_record_count);
                  } else {
                    $general_record_average = 0;
                  }
                  
                  $retaker_count = 0;
                  while($retaker_count_num->fetch(PDO::FETCH_ASSOC)){
                    $retaker_count += 1;
                  }

                  $enrolled_user_count = 0;
                  while($enrolled_db->fetch(PDO::FETCH_ASSOC)){
                    $enrolled_user_count += 1;
                  }

                
                  $gen_record_ave_db = $conn->prepare("SELECT record_ave FROM enrolled_courses_table WHERE course_id = :course_id AND user_status = 'FINISHED'");
                  $gen_record_ave_db->bindParam(":course_id", $course_id);
                  $gen_record_ave_db->execute();
                  
                  ?>

                    <tr class="course-list-row">
                      <td><?php echo $course_id; ?></td>
                      <td><?php echo $course_title; ?></td>
                      <td class="text-center"><?php echo $course_lang; ?></td>
                      <td class="text-center"><?php echo $enrolled_user_count; ?></td>
                      <td class="text-center"><?php echo $success_rate; ?></td>
                      <td class="text-center"><?php echo $retaker_count; ?></td>
                      <td class="text-center"><?php echo $general_record_average; ?></td>
                      <td style="text-align: center;">
                        <a href="./course_report.php?course_id=<?php echo $course_id;?>">
                          <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px;">See Data</div>
                        </a>
                      </td>
                    </tr>

                  <?php
                }

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>



<br>

    <article class="hidden table-art anim-to-top-slow">
      <table id="example" class="rounded-pill table table-striped table-bordered" style="width:100%">
        <h4>USER DATA</h4>
        <thead style="color: #fff; background: #555">
          <tr>
                <th class="font-bold" style="border-bottom: solid 4px #777;">ID</th>
                <th class="font-bold" style="border-bottom: solid 4px #777;">Name</th>
                <th class="font-bold" style="border-bottom: solid 4px #777;">Role</th>
                <th class="font-bold" style="border-bottom: solid 4px #777;">Section</th>
                <th class="font-bold" style="width: 10rem; border-bottom: solid 4px #777;">Enrolled Courses (#)</th>
                <th class="font-bold text-center" style="border-bottom: solid 4px #777;">See Progress</th>
                <th class="font-bold text-center" style="border-bottom: solid 4px #777;">Modify Account</th>
            </tr>
        </thead>
        <tbody>
          <?php
            $user_details_info = $conn->prepare("SELECT id, username, firstname, lastname, role, group_name_id FROM user_table WHERE role = 'Professional' OR role = 'Student' ");
            $user_details_info->execute();

            while($fetch_user_details = $user_details_info->fetch(PDO::FETCH_ASSOC)){
              $user_name = $fetch_user_details['firstname'] . ' ' . $fetch_user_details['lastname'];
              $user_id = $fetch_user_details['id'];
              $firstname = $fetch_user_details['firstname'];
              $uname = $fetch_user_details['username'];
              $lastname = $fetch_user_details['lastname'];
              $user_role = $fetch_user_details['role'];
              $group_name_id = $fetch_user_details['group_name_id'];

              $section_db =  $conn->prepare("SELECT group_name FROM user_group_table WHERE id = :group_name_id");
              $section_db->bindParam(":group_name_id", $group_name_id);
              $section_db->execute();
              $fetch_group_name = $section_db->fetch(PDO::FETCH_ASSOC);
              $section = $fetch_group_name['group_name'];

              $num_course_enrolled =  $conn->prepare("SELECT course_id FROM enrolled_courses_table WHERE user_id = :user_id");
              $num_course_enrolled->bindParam(":user_id", $user_id);
              $num_course_enrolled->execute();
                            
              $courses_enrolled_count = 0;
              while($num_course_enrolled->fetch(PDO::FETCH_ASSOC)){
                $courses_enrolled_count += 1;
              }
              ?>

              <tr>
                <td><?php echo $user_id; ?></td>
                <td><?php echo $user_name; ?></td>
                <td><?php echo $user_role; ?></td>
                <td class="text-capitalize"><?php echo $section; ?></td>
                <td class="text-center"><?php echo $courses_enrolled_count; ?></td>
                <td style="text-align: center;">
                  <a href="./users_main.php?user_id=<?php echo $user_id;?>">
                    <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px;">See Progress</div>
                  </a>
                </td>
                <td style="text-align: center;">
                  
                  <a class="text-decoration-none" href="./update_user.php?user_id=<?php echo $user_id;?>&user_name=<?php echo $uname;?>&firstname=<?php echo $firstname;?>&lastname=<?php echo $lastname;?>&user_role=<?php echo $user_role;?>&group_name_id=<?php echo $group_name_id;?>&section=<?php echo $section;?>">
                    <div class="btn px-3 bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px;">Edit</div>
                  </a>

                  <a class="text-decoration-none" href="./user_tables.php?delete=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to delete? Some data may lose from the analytics.')">
                    <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px;">Delete</div>
                  </a>
                </td>
              </tr>

              <?php
            }
          ?>

          </tbody>
      </table>
      <br>
    </article>
    
    
    </section>

    
  <?php include './includes/admin_footer.php'; ?>

