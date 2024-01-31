<?php
  ob_start();
  session_start();

  include './includes/database.php';
  include './includes/session_role.php';
  include './includes/admin_header.php';
  include './includes/admin_sidebar.php';

  if(isset($_POST['add_section'])){
    $section_name = $_POST['section_name'];

    $insert_section_name = $conn->prepare("INSERT INTO user_group_table (group_name) VALUES (:group_name)");
    $insert_section_name->bindParam(":group_name", $section_name);
    $insert_section_name->execute();

    echo "
    <script>
    setTimeout(() => {
      document.querySelector('.added').classList.remove('hidden');
    }, 0000)
    setTimeout(() => {
      
      document.location.href = './add_section.php';
      document.querySelector('.added').classList.add('hidden');
    }, 1000)
    </script>
    ";

  header('Location: add_section.php');
  }


  if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    $delete_query = $conn->prepare("DELETE FROM user_group_table WHERE id = :group_id");
    $delete_query->bindParam(":group_id", $delete_id);
    $delete_query->execute();

    header("Location: ./add_section.php");
  }

  if(isset($_POST['edit'])){
    if(isset($_GET['edit_id'])){
      $edit_id = $_GET['edit_id'];
    }
    $edit_name = $_POST['section_name'];

    $edit_query = $conn->prepare("UPDATE user_group_table SET group_name = :group_name WHERE id = :edit_id");
    $edit_query->bindParam(":edit_id", $edit_id);
    $edit_query->bindParam(":group_name", $edit_name);
    $edit_query->execute();

    header("Location: ./add_section.php");
  }
  
?>




<?php include './includes/admin_sidebar_section_header.php';?>

<h1 class="text-center my-4" style="color: #444">SECTIONS</h1>

<div class="col-8 mx-auto">
<h3 class="added p-3 text-center rounded-3 mb-4 hidden" style="background: cadetblue; color: #fff; transition: all .5s ease-in; font-size: 1.2rem;">Successfully added</h3>
  <form action="" method="POST">
    <div class="input-group">
      <?php 
        if(isset($_GET['edit_id']) && isset($_GET['edit_name'])){
          $edit_id = $_GET['edit_id'];
          $edit_group_name = $_GET['edit_name']; ?>
          
          <input type="text" name="section_name" class="form-control" style="border: #999 solid 2px" placeholder="Type section name..." value="<?php echo $edit_group_name; ?>">
          <button class="bgc-red-light btn" name="edit">Edit Section</button>

          <?php 

        } else { ?>

          <input type="text" name="section_name" class="form-control" style="border: #999 solid 2px" placeholder="Type section name...">
          <button class="bgc-red-light btn" name="add_section">Add Section</button>

        <?php }
      ?>
    </div>
  </form>
</div>

<article class="col-8 mx-auto mt-4 p-5 rounded-3 table-art anim-to-top-slow" style="box-shadow: 0 3px 15px #444;">
      <table id="example" class="rounded-pill table table-striped table-bordered" style="width:100%">
        <thead class="text-white" style="background: #444;">
          <tr>
                <th>ID</th>
                <th>Section</th>
                <th class="text-center">Modify Account</th>
            </tr>
        </thead>
        <tbody>
          <?php
            $group_name_db = $conn->prepare("SELECT id, group_name FROM user_group_table");
            $group_name_db->execute();

            while($fetch_group_name = $group_name_db->fetch(PDO::FETCH_ASSOC)){
              $group_name_id = $fetch_group_name['id'];
              $group_name = $fetch_group_name['group_name'];

              ?>

              <tr>
                <td><?php echo $group_name_id; ?></td>
                <td class="text-capitalize"><?php echo $group_name; ?></td>
                <td style="text-align: center;">
                  <a class="text-decoration-none" href="./add_section.php?edit_id=<?php echo $group_name_id;?>&edit_name=<?php echo $group_name;?>">
                    <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px; width: 30%;">Edit</div>
                  </a>
                  <a class="text-decoration-none" href="./add_section.php?delete=<?php echo $group_name_id; ?>" onclick="return confirm('Are you sure you want to delete? Some data may lose from the analytics.')">
                    <div class="btn bgc-gray-light rounded-pill" style="border: 1px solid #444; font-size: 16px; width: 30%;">Delete</div>
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
