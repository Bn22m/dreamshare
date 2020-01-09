<?= $this->Html->css('app.css') ?>

<div class="addUser">
  <h2>Login</h2>
  <?= $this->Form->create($user) ?>
  <div class="content voilet1">
      <span>Email:</span><br>
      <input type="email" name="email" required="required" maxlength="99" id="email" placeholder="email"/>
  </div>
  <div class="content voilet1">
      <span>Password:</span><br>
      <input type="password" name="password" required="required" id="password" placeholder="password" maxlength="19"/>
  </div>
  <?= $this->Form->button(__('OK')) ?>
  <?= $this->Form->end() ?>
</div>
