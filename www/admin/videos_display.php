<?php 
  ob_start();
  session_start();
  include './includes/database.php';
  include './includes/session_role.php';
  include './category_includes/video_folder/processingVideoFunctionality.php';
  include './includes/admin_header.php';

  if(isset($_GET['course_id_display'])){
    $course_id = $_GET['course_id_display'];

    $fetchCourseTitle = $conn->prepare("SELECT * FROM course_table WHERE id = :course_id");
    $fetchCourseTitle->bindParam(":course_id", $course_id);
    $fetchCourseTitle->execute();
    $titleRow = $fetchCourseTitle->fetch(PDO::FETCH_ASSOC);
    $courseTitle = $titleRow['course_title'];
  }

?>

    <style>
      .langwi p {
        font-size: 30px;
      }
      .btn-gray {
        background-color: #c2beaa;
      }
      .btn {
        font-size: 22px;
      }
      .hidden {
        display: none;
      }
      .show_vid_style {
        object-fit: cover;
        height: 100%;
        width: 100%;
      }
      .show_vid_container {
        width: 100%;
        height: 20vh;
        overflow: hidden;
      }
      .grid_videos {
        display: grid;
        grid-template-columns: repeat(4, 22%);
        justify-content: space-between;
      }
      .course_crud {
        display: flex;
        align-items: center;
      }
      .maintenance_icons{
        display: flex;
        align-items: center;
        justify-content: end;
      }
      table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
        border: 1px solid #ddd;
      }

   
      .table td {
        text-align: left;
        padding: 10px;
        border: 1px solid #ddd;
      }

      .table th {
        background-color: #f2f2f2;
        /* border-top: 1px solid #ddd;
        border-left: 1px solid #ddd; */
      }

      .table button {
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 17px;
        margin-right: 5px;
        border-radius: 4px;
        outline: none;
      }



      .course, .video, .activity, .scoring{
        transition: all .2s linear;
      }
      .course:hover, .video:hover, .activity:hover, .scoring:hover{
        background: #f2f2f2;
      }


      @media (max-width: 760px) {
        .grid_videos {
          grid-template-columns: repeat(2, 40%);
          justify-content: space-evenly;
        }
        .show_vid_container {
          margin: 1rem;
        }
      }

      @media (max-width: 500px) {
        .course_crud {
          flex-direction: column;
          margin: none;
        }
        .title {
          text-align: center;
        }
        .course_crud div a {
          /* justify-content: start; */
          margin: 0;
        }
        .grid_videos {
          grid-template-columns: repeat(1, 70%);
          justify-content: space-evenly;
        }
        .show_vid_container {
          margin: 1rem;
        }
      }
    </style>
  </head>
  <body>
    <!-- SIDEBAR NAVIGATION -->
    <?php include './includes/admin_sidebar.php'; ?>
    <?php include './includes/admin_sidebar_section_header.php'; ?>
      <!-- main -->
      <main style="min-height: 90%;" class="w-100 d-flex align-items-center justify-content-center flex-column anim-to-top-slow mt-2">
        <div class="d-flex align-items-center justify-content-center text-center mb-4">
          <div class="display-5 font-med"><?php echo $courseTitle; ?> Lesson List 
            <img src="./assets/img/videos.png" width="4%" alt="">
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center mx-3">
          <a href="./read/videos/adminUploadVideoUI.php?course_id_uploadvid=<?php echo $course_id; ?>&add_video_title" class="text-decoration-none">
              <button
                style="font-size: 18px"
                class="btn bgc-red-light px-3 py-1 rounded-pill font-reg"
              >
                +Add a lesson in this course
              </button>
            </a>
          </div>

        <?php 
        $videoCount = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id");
        $videoCount->bindParam(":course_id", $course_id);
        $videoCount->execute();

        $count = 0;
        while($videoCount->fetch(PDO::FETCH_ASSOC)){
          $count += 1;
        }

        if($count === 0){
          echo "
            <div class='text-center font-med display-4 py-5'>NO VIDEO HAS BEEN UPLOADED</div>
          ";
        } else { ?>


      <div class="col-12 mx-auto text-center h5 my-4" style="color: #555;">
        To modify the details of a particular video, you can click the edit button icon located in the modify column. Additionally, you can delete the video entirely as well as its activities and scoring by clicking on the delete button located beside the edit button.
      </div>
      <table class="table mt-4">
          <thead>
            <tr>
              <th class="text-center"></th>
              <th class="text-center">Video</th>
              <th class="text-center">Video Title</th>
              <th class="text-center">List of Activities</th>
              <th class="text-center">Scoring</th>
              <th class="text-center">Modify</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $select_videos = $conn->prepare("SELECT * FROM videos_table WHERE course_id = :course_id");
              $select_videos->bindParam(":course_id", $course_id);
              $select_videos->execute();
              
              $num_count = 1;
              while($video_row = $select_videos->fetch(PDO::FETCH_ASSOC)){
                $video_id = $video_row['id'];
                $video_title = $video_row['video_title'];
                $video_file_name = $video_row['video_file_name'];

                $video_file_name = str_replace("../../../backend_storage/uploaded_vids/","",$video_file_name);
                
                ?>

                <tr>
                  <td class="text-center font-med course pt-3"><?php echo $num_count; ?></td>
                  <td class="text-center video">
                    <div class="d-flex align-items-center justify-content-center pt-1">
                      <div style="width: 150px; object-fit: cover;">
                        <video loop autoplay muted src="../backend_storage/uploaded_vids/<?php echo $video_file_name; ?>" width="100%"></video>
                     
                      </div>
                    </div>
                  </td>
                  <td class="text-center font-med course pt-5" style="font-style: 22px;"><?php echo $video_title; ?></td>
                  <td class="text-center font-med course" style="padding-top: 35px;">
                    <a href="./read/activity/updateActivityUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>&listOfAllActivities" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                      <button class="bgc-gray-light rounded-pill px-4" style="border: #222 1px solid;">List of Activities</button>
                    </a>
                  </td>
                  <td class="text-center font-med course" style="padding-top: 35px;">
                    <a href="./read/scoring/updateScoringUI.php?update_course_id=<?php echo $course_id; ?>&update_video_activity=<?php echo $video_id; ?>" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                      <button class="bgc-gray-light rounded-pill px-4" style="border: #222 1px solid;">See Scoring</button>
                    </a>
                  </td>

                  <td class="" style="padding-top: 35px;">
                    <div class="d-flex align-items-center justify-content-center">

                      <a href="./read/videos/updateVideoUI.php?update_course_id=<?php echo $course_id; ?>&update_video_id=<?php echo $video_id; ?>" class="text-decoration-none d-flex align-items-center justify-content-center mt-1">
                        <button class="bg-transparent rounded-pill px-4" style="border: #2e6341 1px solid; color: #2e6341;">Edit Video</button>
                    </a>
                    <a onClick="return confirm('Are you sure you want to delete?')" href="./videos_display.php?course_id_display=<?php echo $course_id; ?>&delete_video_lesson=<?php echo $video_id; ?>">
                      <button class="rounded-pill bg-transparent" style="border: #cc2b0e 1px solid; color: #cc2b0e;">Delete Video</button>
                    </a>
                  </div>
                  </td>
                </tr>
                <?php 
                $num_count += 1;
                
              }
            }
            ?>

          </tbody>
        </table>
      </main>

    </section>


  <div class="overlay hidden"></div>
<?php   include './includes/admin_footer.php'; ?>
