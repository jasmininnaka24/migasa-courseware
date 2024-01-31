<?php include './includes/database.php'; ?>
<?php
  ob_start();
  session_start();
  if(isset($_POST['insert'])){
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $course_prog = $_POST['course_prog'];
    $user_status = $_POST['user_status'];

    $insert = $conn->prepare("INSERT INTO enrolled_courses_table (user_id, course_id, course_progress, user_status) VALUES (:user_id, :course_id, :course_prog, :user_status)");

    $insert->bindParam(":user_id", $user_id);
    $insert->bindParam(":course_id", $course_id);
    $insert->bindParam(":course_prog", $course_prog);
    $insert->bindParam(":user_status", $user_status);

    $insert->execute();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body class="m-5 p-5">
  <div>
    <?php 
      if(isset($_GET['user_id'])){ 
        $user_id = $_GET['user_id'];
        ?> 
        
        <a href="./add_values.php?user_id=<?php echo $user_id; ?>&course_id">Start</a>

        <?php
      }
    ?>

<?php 
          if(isset($_GET['course_id']) && isset($_GET['user_id']) && !isset($_GET['lesson_id'])){ 
            $user_id = $_GET['user_id'];
            ?>
          <form action="" method="POST">
            <label for="">course id</label>
            <select name="course_id" style="width: 5rem;">
              <?php
                $select_course_id = $conn->prepare("SELECT course_id FROM enrolled_courses_table WHERE user_id = :user_id");
                $select_course_id->bindParam(":user_id", $user_id);
                $select_course_id->execute();
                while($fetch_course_id = $select_course_id->fetch(PDO::FETCH_ASSOC)){
                  $course_id = $fetch_course_id['course_id'];
                  echo "<option value='$course_id'>$course_id</option>";
                }
                ?>
            </select>
            <button name="get_course_id">Next</button>
          </form>
            <?php 
              if(isset($_POST['get_course_id'])){
                $course_id = $_POST['course_id'];
                $_SESSION['course_id'] = $course_id;
                echo "
                  <script>
                    document.location.href = './add_values.php?user_id=$user_id&course_id=$course_id&lesson_id';
                  </script>
                ";
              }
            ?>
          <?php 
          }
        ?>

        <?php 
          if(isset($_GET['lesson_id']) && isset($_GET['user_id']) && isset($_GET['course_id'])){ 
            $user_id = $_GET['user_id'];
            $course_id = $_GET['course_id'];
            ?>
          <form action="" method="POST">
            <label for="">lesson id</label>
            <select name="lesson_id" style="width: 5rem;">
              <?php                
                $select_lesson_id = $conn->prepare("SELECT id FROM videos_table WHERE course_id = :course_id");
                $select_lesson_id->bindParam("course_id", $course_id);
                $select_lesson_id->execute();
                while($fetch_lesson_id = $select_lesson_id->fetch(PDO::FETCH_ASSOC)){
                  $lesson_id = $fetch_lesson_id['id'];
                  echo "<option value='$lesson_id'>$lesson_id</option>";
                }
                ?>
            </select>
            <button name="get_lesson_id">Next</button>
            <?php 
              if(isset($_POST['get_lesson_id'])){
                $_SESSION['lesson_id'] = $_POST['lesson_id'];
                $lesson_id = $_SESSION['lesson_id'];
                header("Location: ./add_values.php?user_id=$user_id&score");
              }
            ?>
          </form>
          <?php 
          }
        ?>

        <?php 
          if(isset($_GET['score']) && isset($_GET['user_id'])){ ?>
          <form action="" method="POST">
            <label for="">passing score</label>
            <?php
              $course_id = $_SESSION['course_id'];
              $lesson_id = $_SESSION['lesson_id'];

              $select_passing_score = $conn->prepare("SELECT passing_score FROM score_table WHERE course_id = $course_id AND video_id = $lesson_id");
              $select_passing_score->execute();

              $fetch_passing_score = $select_passing_score->fetch(PDO::FETCH_ASSOC);
              $passing_score = $fetch_passing_score['passing_score'];

              $select_selected_act = $conn->prepare("SELECT selected_act FROM score_table WHERE course_id = $course_id AND video_id = $lesson_id");
              $select_selected_act->execute();

              $fetch_selected_act = $select_selected_act->fetch(PDO::FETCH_ASSOC);
              $selected_act = $fetch_selected_act['selected_act'];
            ?>
            <input type="text" readonly value="<?php echo $passing_score; ?>">
            <label for="">Selected act</label>
            <input type="text" readonly value="<?php echo $selected_act; ?>">
            <label for="">put your score</label>
            <input type="text" name="score">
            <button name="get_score">Next</button>
          </form>
          <?php
            if(isset($_POST['get_score'])){
              
              if(isset($_GET['user_id'])){
                $user_id = $_GET['user_id'];
              }
              $user_id = $_SESSION['user_id'];
              $course_id = $_SESSION['course_id'];
              $lesson_id = $_SESSION['lesson_id'];
              $score = $_POST['score'];
              
              $insert_val = $conn->prepare("INSERT INTO user_act_score (user_id, course_id, lesson_id, user_score) VALUES (:user_id, :course_id, :lesson_id, :user_score)");
              $insert_val->bindParam(":user_id", $user_id);
              $insert_val->bindParam(":course_id", $course_id);
              $insert_val->bindParam(":lesson_id", $lesson_id);
              $insert_val->bindParam(":user_score", $score);
              $insert_val->execute();
              header("Location: ./add_values.php?user_id=$user_id&course_id");
            } 
          ?>
          <?php 
          }?>


  </div>
  <a href="./main_dashboard.php">Link back</a>
</body>
</html>