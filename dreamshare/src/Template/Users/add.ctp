<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?= $this->Html->css('app.css') ?>

<div class="addUser">
  <h2>Sign up</h2>
  <?= $this->Form->create($user) ?>
  <div class="content voilet1">
      <span>Name:</span><br>
      <input type="text" name="name" required="required" maxlength="50" id="name" placeholder="name"/>
  </div>
  <div class="content voilet1">
      <span>Surname:</span><br>
      <input type="text" name="surname" required="required" maxlength="50" id="surname" placeholder="surname"/>
  </div>
  <div class="content voilet1">
      <span>Email:</span><br>
      <input type="email" name="email" required="required" maxlength="99" id="email" placeholder="email"/>
  </div>
  <div class="content voilet1">
      <span>Password:</span><br>
      <input type="password" name="password" required="required" id="password" placeholder="password" maxlength="9"/>
  </div>
  <div class="content voilet1">
      <span>Activities:</span><br>
      <textarea name="activities" id="activities" rows="5"></textarea>
  </div>
  <?= $this->Form->button(__('OK')) ?>
  <?= $this->Form->end() ?>
</div>
