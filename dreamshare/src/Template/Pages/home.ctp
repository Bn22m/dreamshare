<?php
////////////////////////////////
//
// home.ctp
// author: Brian M
// 2019, 2020
//////////////////////////////////

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = false;

$title = 'Dreamshare';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('mainhome.css') ?>
</head>
<body class="home">

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
            <li><a href="/users">Partners</a></li>
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
      <p><button id="btnFhp">Find your holiday partner</button></p>
    </div>
    <div class="divH"></div>
</section>

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

<div id="divDiscover">
<h3>Discover holiday activity ideas</h3>
</div>
<br>
<div id="divDiscover1" class="divDhactivity1">
  <div id="divActivity1a"><a href="/activities/sports">Sports</a></div>
  <div id="divActivity1b"><a href="/activities/wellnes">Wellness and Health</a></div>
  <div id="divActivity1c"><a href="/activities/expeditions">Expeditions</a></div>
</div>
<div id="divDiscover2" class="divDhactivity1">
  <div id="divActivity2a"><a href="/activities/games">Games</a></div>
  <div id="divActivity2b"><a href="/activities/cultures">Culture and Education</a></div>
</div>
<div id="divDiscover3" class="divDhactivity1">
  <div id="divActivity3a"><a href="/activities/beauty">Beauty and Relaxation</a></div>
  <div id="divActivity3b"><a href="/activities/travelling">Travelling</a></div>
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

  <script>window.pageInfo = "home"</script>
  <?= $this->Html->script('app') ?>
</body>
</html>
