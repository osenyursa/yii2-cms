<?php

use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name',
        'value' => function ($model) {
            $prefix = str_repeat('　', ($model->level - 1) * 2);
            $tab = ($model->level == 1) ? '' : '└──';
            return $prefix . $tab . $model->name;
        }
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'parent_id',
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'route',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'order',
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'data',
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'level',
//    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{create} {view} {update} {delete}',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => 'Delete',
            'data-confirm' => false, 'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item'],
        'buttons' => [
            'create' => function ($url, $model, $key) {
                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-plus"]);
                $url = Url::to(['create', 'parent_id' => $key]);
                $options = ['role' => 'modal-remote', 'title' => 'Create', 'data-toggle' => 'tooltip'];
                return Html::a($icon, $url, $options);
            }
        ]
    ],

];   