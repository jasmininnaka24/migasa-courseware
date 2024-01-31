<?php
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './includes/admin_header.php';
  include './includes/admin_sidebar.php';



  if(isset($_POST['update_user_details'])){
    if(isset($_GET['user_id'])){
      $user_id = $_GET['user_id'];
    }
    $user_name = $_POST['user_name'];
    $firstname = ucwords(trim($_POST['firstname']));
    $lastname = ucwords(trim($_POST['lastname']));
    $group_id = $_POST['group_id'];

    $edit_query = $conn->prepare("UPDATE user_table SET username = :username, firstname = :firstname, lastname = :lastname, group_name_id = :group_id WHERE id = :user_id");
    $edit_query->bindParam(":username", $user_name);
    $edit_query->bindParam(":firstname", $firstname);
    $edit_query->bindParam(":lastname", $lastname);
    $edit_query->bindParam(":group_id", $group_id);
    $edit_query->bindParam(":user_id", $user_id);
    $edit_query->execute();

    if(isset($_GET['update_password'])){
      $new_pass = $_POST['new_pass'];

      $salt = "@specialpassworddummyy";
      $encrypted_password = sha1($new_pass.$salt);

      $update_pass = $conn->prepare("UPDATE user_table SET password = :password WHERE id = :user_id");
      $update_pass->bindParam(":password", $encrypted_password);
      $update_pass->bindParam(":user_id", $user_id);
      $update_pass->execute();

    }


    header("Location: ./user_tables.php");
  }
  
?>




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
          if(isset($_GET['user_table'])){
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
                Back to User Table
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


<h1 class="text-center my-4" style="color: #444">USER DETAILS UPDATE</h1>

<div class="col-8 mx-auto">
<h3 class="added p-3 text-center rounded-3 mb-4 hidden" style="background: cadetblue; color: #fff; transition: all .5s ease-in; font-size: 1.2rem;">Successfully added</h3>
 
</div>

    <article class="col-8 mx-auto mt-4 px-5 pt-5 pb-2 rounded-3 table-art anim-to-top-slow" style="box-shadow: 0 3px 15px #444;">

    <form action="" method="POST">
      <?php 
          if(isset($_GET['user_id']) && isset($_GET['user_name']) && ($_GET['firstname']) && isset($_GET['lastname'])  && isset($_GET['user_role']) && ($_GET['group_name_id']) && isset($_GET['section'])){
            $user_id = $_GET['user_id'];
            $user_name = $_GET['user_name']; 
            $firstname = $_GET['firstname']; 
            $lastname = $_GET['lastname']; 
            $user_role = $_GET['user_role']; 
            $group_name_id = $_GET['group_name_id']; 
            $section = $_GET['section']; 
            
            ?>
            
          <div class="form-group mb-3">
            <label for="" class="font-med mb-2" style="font-size: 18px;">Username:</label>
            <input type="text" name="user_name" class="font-med form-control" style="border: #555 solid 2px" value="<?php echo $user_name; ?>">
          </div>
            
            
          <div class="form-group mb-3">
            <label for="" class="font-med mb-2" style="font-size: 18px;">First name:</label>
            <input type="text" name="firstname" class="font-med form-control text-capitalize" style="border: #555 solid 2px" value="<?php echo $firstname; ?>">
          </div>
            
            
          <div class="form-group mb-3">
            <label for="" class="font-med mb-2" style="font-size: 18px;">Last name:</label>
            <input type="text" name="lastname" class="font-med form-control text-capitalize" style="border: #555 solid 2px" value="<?php echo $lastname; ?>">
          </div>
            
          <div class="form-group mb-3">
            <label for="" class="font-med mb-2" style="font-size: 18px;">Group/Section:</label>
            <select name="group_id" class="form-control font-med" style="border: #555 solid 2px" id="">
              <option value="<?php echo $group_name_id; ?>"><?php echo $section; ?></option>
              <?php 
                $select_groups_db = $conn->prepare("SELECT id, group_name FROM user_group_table WHERE group_name != :group_name");
                $select_groups_db->bindParam(":group_name", $section);
                $select_groups_db->execute();
                
                while($fetch_group_name = $select_groups_db->fetch(PDO::FETCH_ASSOC)){
                  $group_id = $fetch_group_name['id'];
                  $group_name = $fetch_group_name['group_name'];
                  echo "<option value='$group_id'>$group_name</option>";
                }
              ?>
            </select>
          </div>
            
          <div class="form-group mb-3">
            <label for="" class="font-med mb-2" style="font-size: 18px;">Role:</label>
            <input type="text" class="font-med form-control" style="border: #555 solid 2px" value="<?php echo $user_role; ?>" readonly>
          </div>

          <div class="d-flex align-items-center justify-content-end">
            <a class="text-decoration-none" href="./update_user.php?user_id=<?php echo $user_id;?>&user_name=<?php echo $user_name;?>&firstname=<?php echo $firstname;?>&lastname=<?php echo $lastname;?>&user_role=<?php echo $user_role;?>&group_name_id=<?php echo $group_name_id;?>&section=<?php echo $section;?>&update_password">

              <div class="btn px-3 bgc-gray-light rounded-pill font-med" style="border: 2px solid #444; font-size: 16px;">Change password</div>

            </a>
          </div>


          <?php 
            if(isset($_GET['update_password'])){ ?>
              <div class="form-group mb-3">
                <label for="" class="font-med mb-2" style="font-size: 18px;">Type a new password here:</label>
                <input type="text" name="new_pass" class="font-med form-control" style="border: #555 solid 2px">
              </div>

              <script>
                window.onload = function () {
                  window.scrollTo(0, document.body.scrollHeight);
                };
              </script>
            <?php }
          ?>

          <div class="d-flex align-items-center justify-content-center mt-5">
            <a href="./user_tables.php">
              <div name="cancel" class="btn bgc-gray-light font-med rounded-pill mx-2" style="border: solid 1px #444;">Cancel</div>
            </a>
            <button type="submit" name="update_user_details" class="btn bgc-red-light font-med rounded-pill mx-2">UPDATE</button>
          </div>
            



            <?php 
          }
        ?>
      </div>
  </form>

      <br>
    </article>
  <br>
  <br>
  <br>
</section>
<?php include './includes/admin_footer.php'; ?>
