<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      View Group 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i>Administration</a></li>
      <li><a href="#">Group</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-lg-12">
          <!-- Horizontal Form -->
              <div class="box box-info">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'branch_id',
                        'companies_company_id',
                        'branch_name',
                        'branch_address',
                        'branch_created_date',
                        'branch_status',
                    ],
                ]) ?>
              </div>
          
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->branch_id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->branch_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
        </div>
    </div>
</section>
