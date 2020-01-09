<?php
  //session_start();
  if(isset($_SESSION["name"])){
    $name = $_SESSION["name"];
    $email = $_SESSION["email"];
    $crf = $_COOKIE["csrfToken"];
    echo "<h3> Online: ".$name."</h3>";
  } else {
    header("Location: /users/login");
    exit;
  }
 ?>
<?= $this->Html->css('app.css') ?>

<div class="addUser">
  <h2>Add your photo</h2>
  <form enctype="multipart/form-data" action="/partners/pimage" method="post">
  <div style="display:none;">
    <input type="hidden" name="_method" value="POST"/>
    <input type="hidden" name="_csrfToken" autocomplete="off" value="<?= $crf ?>"/>
  </div>
  <div>
    <input type="hidden" name="MAX_FILE_SIZE" value="51200"/>
  </div>
  <div class="content voilet1">
      <span>Name:</span><br>
      <input type="text" name="name" value="<?= $name ?>" required="required" maxlength="50" id="name" placeholder="name" readonly/>
  </div>
  <div class="content voilet1">
      <span>Email:</span><br>
      <input type="email" name="email" value="<?= $email ?>" required="required" maxlength="99" id="email" placeholder="email" readonly/>
  </div>
  <div class="content voilet1">
      <span>Image to upload:</span><br>
      <input type="file" name="imageupload" required="required" id="imageupload" accept=".jpg"/>
  </div>
  <div>
    Accepts jpg images only.
  </div>
  <div>
    <input type="submit" value="OK">
  </div>
</form>

</div>
