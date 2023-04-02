<br><br>
<form action="" method="POST" enctype="multipart/form-data" class="d-flex flex-column align-items-center justify-content-center mx-auto anim-to-top-slow">

  <h1 class="col-8 mx-auto text-center" style="margin-bottom: 4rem; color: #444">
    Creating a Course
  </h1>


  <div class="col-6">


    <div>
      <!-- file upload -->
      <div class="mx-auto text-center h4" style="margin-bottom: 1rem; color: #555">
        <span class="txt-red-light text-center font-bold">STEP 1: </span>
        Add an Icon
      </div>
      <p style="color: #777; font-size: 18px;" class="text-center mb-4">If you'd like to skip adding icon, you can just do it later.</p>
      <div class="form-group d-flex align-items-center justify-content-center">
        <label
        for="upload_file"
        class="rounded-pill bgc-gray-light px-3 py-1"
        style="border: #555 solid 0.1rem; cursor: pointer"
        >
        Upload File
      </label>
      <input
        type="file"
        name="course_icon"
        id="upload_file"
        
        accept="image/*"
        class="pb-1 mx-2"
        style="border-bottom: #444 solid 2px;"
        />
    </div>
  </div>







    <!-- title upload -->
    <br />
    <div
      class="form-group mt-5"
    >
      <div class="mx-auto text-center h4" style="margin-bottom: 1rem; color: #555">
        <span class="txt-red-light text-center font-bold">STEP 2: </span>
        Add Course Title
      </div>

      <input
        type="text"
        id="title"
        class="form-control text-center text-capitalize"
        name="course_title"
        placeholder="Title here"
        style="border: 0.1rem solid #888; font-size: 20px;"
      />
    </div>
    <!-- Description -->
    <br />
    <div class="mx-auto text-center h4 mt-5" style="margin-bottom: 1rem; color: #555">
      <span class="txt-red-light text-center font-bold">STEP 2: </span>
      Add a Description
    </div>
    <div
      class="input-group d-flex align-items-center justify-content-center position-relative"
    >
      <textarea
        name="course_description"
        id="message"
        cols="20"
        rows="5"
        class="form-control"
        style="border: 0.1rem solid #888; font-size: 20px; resize: none;"
        maxlength="250"
        onkeyup="countCharacters()"></textarea>
      <div class="counter">
        <span id="characterCount">0</span>/250
      </div>
    </div>

    <!-- CHOOSE A LANGUAGE -->
    <br>
    <div class="mx-auto text-center h4 mt-5" style="margin-bottom: 1rem; color: #555">
      <span class="txt-red-light text-center font-bold">STEP 2: </span>
      Choose a language
    </div>
      <select name="course_lang" id="" class="form-control" style="border: 0.1rem solid #888; font-size: 20px;" required>
      <option value="">Select a language🔻</option>
      <?php
        $language_db = $conn->prepare("SELECT * FROM language_table");
        $language_db->execute();
        while($language_row = $language_db->fetch(PDO::FETCH_ASSOC)){
          $language = $language_row['language'];
          echo "<option value='$language'>$language</option>";
        }
      ?>
        
      </select>
    
  </div>
  <div class="d-flex align-items-center justify-content-end">
    <button
      type="submit"
      name="create_course"
      style="font-size: 16px; margin-bottom: 5rem;"
      class="btn bgc-red-light font-med rounded-pill mt-5 px-5 create_course"
    >
      Create
    </button>
  </div>
</form>

