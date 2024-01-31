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

    $delete_query5 = $conn->prepare("DELETE FROM last_activity_user_table_tracker WHERE user_id = :user_id");
    $delete_query5->bindParam(":user_id", $user_id);
    $delete_query5->execute();

    $delete_query6 = $conn->prepare("DELETE FROM user_act_score WHERE user_id = :user_id");
    $delete_query6->bindParam(":user_id", $user_id);
    $delete_query6->execute();

    header("Location: ./user_tables.php");
  }
  
?>
<?php include './includes/admin_sidebar_section_header.php';?>


    <article class="mt-4 px-4 table-art anim-to-top-slow">
      <table id="example" class="rounded-pill table table-striped table-bordered" style="width:100%">
        <h2 style="color: #555" class="text-center mb-3">USER DATA</h2>
        <thead class="text-white" style="background: #444;">
          <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Section</th>
                <th style="width: 10rem;">Enrolled Courses (#)</th>
                <th class="text-center">See Progress</th>
                <th class="text-center">Modify Account</th>
            </tr>
        </thead>
        <tbody>
          <?php
            $user_details_info = $conn->prepare("SELECT username, id, firstname, lastname, role, group_name_id FROM user_table WHERE role = 'Professional' OR role = 'Student' ");
            $user_details_info->execute();

            while($fetch_user_details = $user_details_info->fetch(PDO::FETCH_ASSOC)){
              $uname = $fetch_user_details['username'];
              $user_name = $fetch_user_details['firstname'] . ' ' . $fetch_user_details['lastname'];
              $firstname = $fetch_user_details['firstname'];
              $lastname = $fetch_user_details['lastname'];
              $user_id = $fetch_user_details['id'];
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
                  <a href="./users_main.php?user_id=<?php echo $user_id;?>&user_tables">
                    <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px;">See Progress</div>
                  </a>
                </td>
                <td style="text-align: center;">

                  <a class="text-decoration-none" href="./update_user.php?user_id=<?php echo $user_id;?>&user_name=<?php echo $uname;?>&firstname=<?php echo $firstname;?>&lastname=<?php echo $lastname;?>&user_role=<?php echo $user_role;?>&group_name_id=<?php echo $group_name_id;?>&section=<?php echo $section;?>&user_table">

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














