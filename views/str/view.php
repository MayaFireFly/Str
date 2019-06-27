<?php
use yii\helpers\Html;
?>

<ul>
    <li><label>Begin string</label> - <?= Html::encode($model->str) ?></li>
    <li><label>Cutted string</label> - <?= Html::encode($model->cutStr()) ?></li>
    <li><label>Modified string</label> - <?= Html::encode($model->capitalizeWords()) ?></li>
    <li><label>Latin string</label> - <?= Html::encode($model->latinStr()) ?></li>
</ul>

