<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Blog $blog
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Blogs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="blogs form large-9 medium-8 columns content">
    <?= $this->Form->create($blog) ?>
    <fieldset>
        <legend><?= __('Add Blog') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('surname');
            echo $this->Form->control('email');
            echo $this->Form->control('title');
            echo $this->Form->control('body');
            echo $this->Form->control('imagelink');
            echo $this->Form->control('comments');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
