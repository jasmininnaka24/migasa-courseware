

<?php
      if(isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];

        $course_title = $conn->prepare("SELECT course_title FROM course_table WHERE id = $course_id");
        $course_title->execute();
        $fetch_course_title = $course_title->fetch(PDO::FETCH_ASSOC);
        $course_title = $fetch_course_title['course_title'];

        ?>
          <div  class="px-4 py-3 bgc-gray-light rounded-3 position-absolute w-75" style="z-index: 350; top: 15%; left: 12%; height: 70vh" >
          
          <a class="text-decoration-none text-dark" href="./users_main.php?user_id=<?php echo $user_id; ?>">
          <div class="d-flex align-items-center justify-content-end w-100">
              <div class="lead font-med" style="font-size: 30px">&times;</div>
            </div>
          </a>

            <h4 class="text-center my-3"><?php echo $user_name; ?>'s <?php echo $course_title; ?> Scores</h4>
            <table class="table">
              <thead style="background: #444; color: #fff">
                <tr>
                  <th></th>
                  <th>Lesson Title</th>
                  <th class="text-center">Quiz Items</th>
                  <th class="text-center">Passing Score</th>
                  <th class="text-center">Score</th>
                </tr>
              </thead>
              <tbody>
                
              
            <?php 
              $select_video_title = $conn->prepare("SELECT id, video_title FROM videos_table WHERE course_id = $course_id");
              $select_video_title->execute();

              $count_num = 0;
              $overall = 0;
              $overall_score = 0;
              while($fetch_video_title = $select_video_title->fetch(PDO::FETCH_ASSOC)){
                $video_id = $fetch_video_title['id'];
                $video_title = $fetch_video_title['video_title']; 
                
                $scoring_db = $conn->prepare("SELECT selected_act, passing_score FROM score_table WHERE course_id = $course_id AND video_id = $video_id");
                $scoring_db->execute();
                $fetch_scoring_db = $scoring_db->fetch(PDO::FETCH_ASSOC);
                $selected_act = $fetch_scoring_db['selected_act'];
                $passing_score = $fetch_scoring_db['passing_score']; 

                $overall += $selected_act;
                $overall_score += $passing_score;
                
                $user_score = $conn->prepare("SELECT user_score FROM user_act_score WHERE course_id = $course_id AND lesson_id = $video_id AND user_id = $user_id");
                $user_score->execute();
                $fetch_user_score = $user_score->fetch(PDO::FETCH_ASSOC);
                $user_score = $fetch_user_score['user_score'];

                $count_num += 1;
                ?>
                  <tr>
                    <td><?php echo $count_num; ?></td>
                    <td><?php echo $video_title; ?></td>
                    <td class="text-center"><?php echo $selected_act; ?></td>
                    <td class="text-center"><?php echo $passing_score; ?></td>
                    <td class="text-center"><?php echo $user_score; ?></td>
                  </tr>

                <?php
                }
                $record_ave = ($overall_score / $overall) * 100;
              ?>
              </tbody>
            </table>
            <div class="lead font-med">Record Average: <?php echo $record_ave; ?></div>
          </div>
          <div class="overlay" style="z-index: 300;"></div>
        <?php
      }
    ?>
