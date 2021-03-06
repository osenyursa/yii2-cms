<?php

use app\widgets\RecyclePageButton;
use johnitvn\ajaxcrud\BulkButtonWidget;
use app\assets\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $category \app\models\Category */

$this->title = '回收站';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="document-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => [
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
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'name',
//    ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'title',
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'created_by',
                    'value' => 'createdBy.username'
                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'type',
                    'value' => 'typeLabel'
                ],
//                [
//                    'class' => '\kartik\grid\DataColumn',
//                    'attribute' => 'level',
//                ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'category_id',
                    'value' => 'category.title',
                ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'description',
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'root',
//    ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'pid',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'model_id',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'position',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'link_id',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'cover_id',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'display',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'deadline',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'attach',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'comment',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'extend',
                // ],
                // [
                // 'class'=>'\kartik\grid\DataColumn',
                // 'attribute'=>'created_at:datetime',
                // ],
                [
                    'class' => '\kartik\grid\DataColumn',
                    'format' => ['datetime'],
                    'attribute' => 'updated_at',
                ],
//                [
//                    'class' => '\kartik\grid\DataColumn',
//                    'attribute' => 'updated_by',
//                ],
//                [
//                    'class' => '\kartik\grid\DataColumn',
//                    'attribute' => 'status',
//                ],
//                [
//                    'class' => '\kartik\grid\DataColumn',
//                    'attribute' => 'view',
//                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{restore}',
                    'dropdown' => false,
                    'vAlign' => 'middle',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        return Url::to([$action, 'id' => $key]);
                    },
                    'viewOptions' => ['role' => 'modal-remote', 'title' => '查看', 'data-toggle' => 'tooltip'],
                    'updateOptions' => ['role' => 'modal-remote', 'title' => '更新', 'data-toggle' => 'tooltip'],
                    'deleteOptions' => ['role' => 'modal-remote', 'title' => '删除',
                        'data-confirm' => false, 'data-method' => false,// for overide yii data api
                        'data-request-method' => 'post',
                        'data-toggle' => 'tooltip',
                        'data-confirm-title' => '确认',
                        'data-confirm-message' => '确认要删除这些内容吗'],
                    'buttons' => [
                        'restore' => function ($url, $model, $key) {
                            $icon = Html::tag('span', '', ['class' => '	glyphicon glyphicon-saved']);
                            $option = ['role' => 'modal-remote', 'title' => '还原'];
                            return Html::a($icon, $url, $option);
                        },
                    ],
                ],

            ],
            'toolbar' => [
                [
                    'content' => RecyclePageButton::widget()
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> 回收站',
                'before' => '<em>* 拖动表格边缘来进行缩放.</em>',
                'after' => BulkButtonWidget::widget([
                        'buttons' => Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; 全部删除',
                            ["bulk-delete"],
                            [
                                "class" => "btn btn-danger btn-xs",
                                'role' => 'modal-remote-bulk',
                                'data-confirm' => false, 'data-method' => false,// for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => '确认',
                                'data-confirm-message' => '确认要删除这些内容吗'
                            ]),
                    ]) .
                    '<div class="clearfix"></div>',
            ]
        ]) ?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    'size' => Modal::SIZE_LARGE,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>
