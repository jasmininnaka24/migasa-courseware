<?php
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './includes/admin_header.php';
  include './includes/admin_sidebar.php';

  if(isset($_GET['delete'])){
    $user_id = $_GET['delete'];

    $delete_query = $conn->prepare("DELETE FROM user_table WHERE id = :user_id");
    $delete_query->bindParam(":user_id", $user_id);
    $delete_query->execute();

    $delete_query2 = $conn->prepare("DELETE FROM activity_tracker_user_table WHERE user_id = :user_id");
    $delete_query2->bindParam(":user_id", $user_id);
    $delete_query2->execute();

    $delete_query3 = $conn->prepare("DELETE FROM enrolled_courses_table WHERE user_id = :user_id");
    $delete_query3->bindParam(":user_id", $user_id);
    $delete_query3->execute();

    $delete_query4 = $conn->prepare("DELETE FROM finished_courses_table WHERE user_id = :user_id");
    $delete_query4->bindParam(":user_id", $user_id);
    $delete_query4->execute();

    // $delete_query5 = $conn->prepare("DELETE FROM last_activity_user_table WHERE user_id = :user_id");
    // $delete_query5->bindParam(":user_id", $user_id);
    // $delete_query5->execute();

    $delete_query6 = $conn->prepare("DELETE FROM progress_table WHERE user_id = :user_id");
    $delete_query6->bindParam(":user_id", $user_id);
    $delete_query6->execute();

    $delete_query6 = $conn->prepare("DELETE FROM user_act_score WHERE user_id = :user_id");
    $delete_query6->bindParam(":user_id", $user_id);
    $delete_query6->execute();

    header("Location: ./user_tables.php");
  }
  
?>
<?php include './includes/admin_sidebar_section_header.php';?>


    <article class="mt-4 px-4 table-art anim-to-top-slow">
      <table id="example" class="rounded-pill table table-striped table-bordered" style="width:100%">
        <h2 style="color: #555" class="text-center mb-3">COURSE DATA</h2>
        <thead class="text-white" style="background: #444;">
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

              <tr>
                <td><?php echo $course_id; ?></td>
                <td><?php echo $course_title; ?></td>
                <td class="text-center"><?php echo $course_lang; ?></td>
                <td class="text-center"><?php echo $enrolled_user_count; ?></td>
                <td class="text-center"><?php echo $success_rate; ?></td>
                <td class="text-center"><?php echo $retaker_count; ?></td>
                <td class="text-center"><?php echo $general_record_average; ?></td>
                <td style="text-align: center;">
                  <a href="./course_report.php?course_id=<?php echo $course_id;?>&course_table">
                    <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px;">See Data</div>
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














