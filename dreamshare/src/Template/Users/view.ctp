<?php
  session_start();
  if(isset($_SESSION["name"])){
    echo "<h3> Online: ".$_SESSION["name"]."</h3>";
  } else {
    header("Location: /users/login");
    exit;
  }
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div id="divMeetph01" class="divMeetph0">
    <div id="divMeetp1" class="divMeetp">
      <div class="divPartner01">
        <div id="divP1aa" class="divMeetpartner"><?= $this->Html->image("img2/".$user->image) ?></div>
        <div id="divP1bb" class="divMeetpartnerb">
          <?php
            $id = $user->id;
            if($id % 4 == 0){
              $image = "d5purple.jpg";
              $image2 = "airplane.svg";
            } elseif($id % 4 == 1){
              $image = "d5pink.jpg";
              $image2 = "music.svg";
            } elseif($id % 4 == 2){
              $image = "d5green.jpg";
              $image2 = "brush.svg";
            } else{
              $image = "d5orange.jpg";
              $image2 = "camera.svg";
            }
           ?>
          <?= $this->Html->image($image) ?>
        </div>
        <div id="divP1cc" class="divMeetpartner02">
          <?= $this->Html->image($image2) ?>
        </div>
      </div>
    </div>
    <div class="divMeetpp">
      <br>
      <div>
        <b><?= h($user->name) ?> <?= h($user->surname) ?></b>
      </div>
      <br>
      <div>
        <?= $this->Text->autoParagraph(h($user->activities)); ?>
      </div>
    </div>
</div>
<br>
<div id="divSop1" class="divSop">
  <button id="btnSop">See other partners</button>
</div>
<div>
  <input type="text" value="<?= $image2  ?>" id="txtAiro" hidden/>
</div>

<script>
  document.getElementById('btnSop').onclick = function(){
    //alert("See other partners...");
    //alert(window.pageInfo+": "+aUrl);
    window.location = "/users/all";
  };
  var airoplane = document.getElementById("divP1cc");
  var image2 = document.getElementById("txtAiro").value;
  //alert(image2);
  if(image2 == "airplane.svg"){
    //alert("rotate");
    airoplane.style = "transform: rotate(-30deg)";
    //alert("done");
  }
</script>
