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
          <h1 class="text-center mb-4">USER DATA</h1>
          <table class="course-list px-3 table-bordered">
            <thead class="px-4 rounded-3" style="background: #f7fafa; color: #444;">
            <tr>
                <th style="border-bottom: solid 4px #777;">ID</th>
                <th style="border-bottom: solid 4px #777;">Name</th>
                <th style="border-bottom: solid 4px #777;">Role</th>
                <th style="border-bottom: solid 4px #777;">Section</th>
                <th style="width: 11rem; border-bottom: solid 4px #777;">Enrolled Courses (#)</th>
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