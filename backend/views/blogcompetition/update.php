<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\KontesSeoContent */

$this->title = 'Update Blog Competition Content: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Blog Competition Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kontes-seo-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
