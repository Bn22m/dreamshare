<?php
//////////////////////
// 
// layout
// default.ctp
// Author: Brian M.
///////////////////

$title = 'Dreamshare';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('mainapp.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
  <section id="intro">
      <div class="divH">
      <header id="header">
        <nav>
            <ul>
              <li><a href="/home" class="hlogo">
                <?= $this->Html->image('hlogo.svg') ?>
              </a></li>
              <li><pre id="preH"> </pre></li>
              <li><a href="/activities">Activities</a></li>
              <li><a href="/partners">Partners</a></li>
              <li><a href="/blogs">Blog</a></li>
              <li><a href="/contacts">Contact</a></li>
              <li><a href="/users/login">Log in</a></li>
              <li><button id="btnSign">Sign up</button></li>
            </ul>
        </nav>
      </header>
      </div>
      <div id="divFpp" class="divH">
        <h2>SHARE YOUR <br> HOLIDAY DREAM</h2>
        <pre class="preB"> </pre>
        <p>And find the perfect partner to fulfill it</p>
        <pre class="preB"> </pre>
        <p> <button id="btnFhp">Find your holiday partner</button></p>
      </div>
      <div class="divH"></div>
  </section>
  <div class="divViewp">
    <?= $this->Flash->render() ?>
    <br>
    <div>
      <?= $this->fetch('content') ?>
    </div>
  </div>
  <br>
  <div class="preDfp"><pre id="preDfp1"><hr><pre></div>
  <div id="divFooter" class="divDf">
      <div id="divDf1" class="divDft" >
        <pre class="plogo"></pre>
        <p id="divDfa1"><a href="/home" class="flogo">
            <?= $this->Html->image('flogo.svg') ?></a></p>
      </div>
      <pre class="preB2"> </pre>
      <div id="divDf2" class="divDft" >
        <p id="divDfb1"><b>Company</b></p>
        <p><a href="/about">About</a></p>
        <p><a href="/contacts">Contact</a></p>
        <p><a href="/press">Press</a></p>
        <p><a href="/blogs">Blog</a></p>
        <p><a href="/terms">Terms and Privacy</a></p>
        <p><a href="/help">Help</a></p>
      </div>
      <pre class="preB2"> </pre>
      <div id="divDf3" class="divDft">
        <p id="divDfc1"><b>Activities</b></p>
        <p><a href="/activities/sports">Sports</a></p>
        <p><a href="/activities/wellnes">Wellness and Health</a></p>
        <p><a href="/activities/expeditions">Expeditions</a></p>
        <p><a href="/activities/games">Games</a></p>
        <p><a href="/activities/cultures">Culture and Education</a></p>
        <p id="divDfc6"><a href="/activities/all">View all</a></p>
      </div>
      <pre class="preB2"> </pre>
      <div id="divDf4" class="divDft" >
        <p id="divDfd1"><b>Contact us</b></p>
        <p>Tel:(000) 000-0000</p>
        <p>Email: dreamshare@email.com</p>
      </div>
  </div>

  <script>window.pageInfo = "dlayout"</script>
  <?= $this->Html->script('app') ?>
</body>
</html>
