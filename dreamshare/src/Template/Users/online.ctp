<?php
  session_start();
  if(isset($_SESSION["name"])){
    echo "<h3> Online: ".$_SESSION["name"]."</h3>";
  } else {
    header("Location: /users/login");
    exit;
  }
 ?>
<h2> Welcome Back. </h2>
