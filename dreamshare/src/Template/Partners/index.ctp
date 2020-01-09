
<div id="divMeet">
    <h3>Meet a partner for your best holiday</h3>
</div>
<br>
<div id="divMeetph0" class="divMeetph">
  <div id="divMeetp1" class="divMeetp">
    <div class="divPartner01">
      <div id="divP1aa" class="divMeetpartner"><?= $this->Html->image('part1.jpg') ?></div>
      <div id="divP1bb" class="divMeetpartnerb"><?= $this->Html->image('d5pink.jpg') ?></div>
      <div id="divP1cc" class="divMeetpartner02"><?= $this->Html->image('music.svg') ?></div>
    </div>
  </div>
  <div class="divMeetpp">
    <br>
    <div id="divP1dd"><b>Bradley Hitch</b></div>
    <br>
    <div id="divP1ee">Based in Chicago. I love playing <br>tennis and loud music.<br></div>
  </div>
  <div id="divMeetp2" class="divMeetp">
    <div class="divPartner01">
      <div id="divP2aa" class="divMeetpartner"><?= $this->Html->image('part1.jpg') ?></div>
      <div id="divP2bb" class="divMeetpartnerb"><?= $this->Html->image('d5green.jpg') ?></div>
      <div id="divP2cc" class="divMeetpartner02"><?= $this->Html->image('brush.svg') ?></div>
    </div>
  </div>
  <div>
    <div class="divMeetpp">
      <br>
      <div id="divP2dd"><b>Marie Bell</b></div>
      <br>
      <div id="divP2ee">Currently living in Colorado. Lover of <br>art, languages and travelling.<br></div>
    </div>
  </div>
  <div id="divMeetp3" class="divMeetp">
    <div class="divPartner01">
      <div id="divP3aa" class="divMeetpartner"><?= $this->Html->image('part1.jpg') ?></div>
      <div id="divP3bb" class="divMeetpartnerb"><?= $this->Html->image('d5orange.jpg') ?></div>
      <div id="divP3cc" class="divMeetpartner02"><?= $this->Html->image('camera.svg') ?></div>
    </div>
  </div>
  <div>
    <div class="divMeetpp">
      <br>
      <div id="divP3dd"><b>Diana Win</b></div>
      <br>
      <div id="divP3ee">Living in Athens, Greece. I love black <br>and white classics, chillout music <br>
      and green tea.<br></div>
    </div>
  </div>
  <div id="divMeetp4" class="divMeetp">
    <div class="divPartner01">
      <div id="divP4aa" class="divMeetpartner"><?= $this->Html->image('part1.jpg') ?></div>
      <div id="divP4bb" class="divMeetpartnerb"><?= $this->Html->image('d5purple.jpg') ?></div>
      <div id="divP4cc" class="divMeetpartner02"><?= $this->Html->image('airplane.svg') ?></div>
    </div>
  </div>
  <div>
    <div class="divMeetpp">
      <br>
      <div id="divP4dd"><b>Christopher Pen</b></div>
      <br>
      <div id="divP4ee">Star Wars fanatic. I have a <br>persistent enthusiasm to create <br>new things.<br></div>
    </div>
  </div>
</div>
<br>
<div id="divSop1" class="divSop">
  <button id="btnSop">See other partners</button>
</div>

<script>
  document.getElementById('btnSop').onclick = function(){
    //alert("See other partners...");
    //alert(window.pageInfo+": "+aUrl);
    window.location = "/users/all";
  };
</script>
