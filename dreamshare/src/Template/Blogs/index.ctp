<h2>Blog<h2>

  <label id="lblTime" class="lblt">
    <div id="divT1"><button id="btnTime" class="lblt2"></button><button id="btnX" class="lblt2">Exit</button></div>
    <div id="divT2"><button id="btnTime2" class="lblt2">Disconnect</button><button id="btnX2" class="lblt2">Reset</button></div>
  </label>
  <label></label>
  <label></label>
  <hr>
  <h3>Look who is Chatting...<h3>
  <label id="lblchat"></label>
  <hr>
  <div class="divBlogv1V">
    <div id="divBlogV10"><?= $this->Html->image('d5orange.jpg') ?></div>
    <div id="divBlogV20"><?= $this->Html->image('part1.jpg') ?></div>
  </div>
  <hr>
  <div class="divBlogv2V">
    <div id="divBlogV40"><?= $this->Html->image('imgs/block5Culture.jpg') ?></div>
    <div id="divBlogV50"><?= $this->Html->image('part1.jpg') ?></div>
    <div id="divBlogV30"><?= $this->Html->image('part1.jpg') ?></div>
  </div>
  </div>
  <textarea id="txta" placeholder="comment" rows="3" maxlength="250" required="true"></textarea>

  <hr>
  <div id="messages"></div>

  <?= $this->Html->script('blobp') ?>
