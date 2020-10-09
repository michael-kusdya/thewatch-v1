<?php

use yii\helpers\Html;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Product Features
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-cog"></i>Catalogue</a></li>
    <li><a href="#">Product Features</a></li>
  </ol>
</section>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

