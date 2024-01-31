<?php
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './includes/admin_header.php';
  include './includes/admin_sidebar.php';
  include './includes/admin_sidebar_section_header.php';

  
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
  
  

.course-container {
  padding: .5rem 1rem;
  border: 1px solid #ccc;
  box-shadow: 0 3px 20px #888;
  background-color: #f7f7f7;
  padding: 10px;
  overflow-y: scroll;
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


      <div class="row mt-5 mb-3 anim-to-top-slow">
      <div class="col-12">
        <div id="printableArea" class="course-container px-4 py-2 mx-auto" style="width: 8.5in; height: 11in; border: #444 solid 1px;">
          <h1 class="text-center mb-4">COURSE DATA</h1>
          <table class="course-list px-3 table-bordered">
            <thead class="px-4 rounded-3" style="background: #f7fafa; color: #444;">
              <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th class="text-center">Language</th>
                <th class="text-center">Total Enrollees</th>
                <th class="text-center">Completers (#)</th>
                <th class="text-center">Retakers (#)</th>
                <th class="text-center">General Record Average</th>
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

                    <th">
                      <td><?php echo $course_id; ?></td>
                      <td><?php echo $course_title; ?></td>
                      <td class="text-center"><?php echo $course_lang; ?></td>
                      <td class="text-center"><?php echo $enrolled_user_count; ?></td>
                      <td class="text-center"><?php echo $success_rate; ?></td>
                      <td class="text-center"><?php echo $retaker_count; ?></td>
                      <td class="text-center"><?php echo $general_record_average; ?></td>

                    </tr>

                  <?php
                }

              ?>
            </tbody>
          </table>
        </div>

        <div class="d-flex align-items-center justify-content-center">
          <button class="btn bgc-red-light mt-4 rounded-pill px-5 font-med" type="button" onclick="printDiv('printableArea')">Print</button>
        </div>

        <script>
          function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
          }
        </script>
      </div>
    </div>




       
    <br>
    <br>
  </section>
  <?php include './includes/admin_footer.php'; ?>