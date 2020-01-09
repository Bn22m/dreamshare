<?php
namespace App\Controller;
session_start();

use App\Controller\AppController;

class PartnersController extends AppController
{

  public function index()
  {

  }

  public function pimage()
  {
    if ($this->request->is('post')) {
    //
    if(isset($_SESSION["name"])){
      $name = $_SESSION["name"];
      $email = $_SESSION["email"];
      $imgx = $_SESSION["image"];
      //echo "<h3> Online2: ".$name."</h3>";
    } else {
      header("Location: /users/login");
      exit;
    }
    try {
    //$dt = time();
    //$fname = "webroot/img/img2/".$name.$dt;
    $fname = "webroot/img/img2/".$imgx;
    $jpim = $_FILES["imageupload"]["name"];
    $jpim2 = $_FILES["imageupload"]["tmp_name"];
    list($width, $height, $type, $attr) = getimagesize($jpim2);
    $nwidth = 100;
    $nheight = 100;
    $thumb = imagecreatetruecolor($nwidth, $nheight);
    //
    //echo "<br> $jpim <br>";
    //echo "<br> $jpim2 <br>";
    //echo "<br> $fname <br>";
    //echo "NH: ".$nheight."<br>";
    //echo "H: ".$height."<br>";
    //echo "============== <br>";
    //echo "NW: ".$nwidth."<br>";
    //echo "W: ".$width."<br>";
    //echo "============== <br>";
    //echo "Type: ".$type."<br>";
    //echo "Attr: ".$attr."<br>";
    //
    if($type == 2){
    //$fname .= ".jpg";
    //echo "<br>".$fname."<br>";
    //$fname = null;
    $source = imagecreatefromjpeg($jpim2);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
    header('Content-Type: image/jpeg');
    imagejpeg($thumb, $fname, 75);
    imagedestroy($thumb);
    $this->Flash->success(__("Image saved."));
    header("Location: /partners");
    exit;
    }
    elseif ($type == 3 ) {
    $this->Flash->error(__("Error code: ".$type));
    exit();
    //$fname .= ".png";
    //$source = imagecreatefrompng($jpim2);
    //imagecopyresized($thumb, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
    //header('Content-Type: image/png');
    //imagejpeg($thumb, $fname, 75);
    //imagedestroy($thumb);
    }
    else{
    $jpim = "webroot/img/d5orange.jpg";
    //$fname .= ".jpg";
    $source = imagecreatefromjpeg($jpim);
    list($width, $height, $type, $attr) = getimagesize($jpim);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
    header('Content-Type: image/jpeg');
    imagejpeg($thumb, $fname, 75);
    imagedestroy($thumb);
    $this->Flash->error(__("Image not supported."));
    exit();
    }
    //echo "<br> $fname <br>";
    } catch (Exception $ex) {
    echo $ex->getMessage();
    }
   //
   }
  }

}
