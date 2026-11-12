<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\report\views\report
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

use open20\amos\core\forms\RequiredFieldsTipWidget;
use open20\amos\core\forms\TextEditorWidget;
use open20\amos\core\helpers\Html;
use open20\amos\report\AmosReport;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<p><?= AmosReport::t('amosreport',
        'Indica di seguito  il tipo ed il contenuto della tua segnalazione;<br/>puoi segnalare errori o contenuti che ritieni non appropriati e richiedere una rettifica se necessario.') ?></p>
<?php

$Report = new \open20\amos\report\models\Report();
$form = ActiveForm::begin([
    'id' => 'report-form',
    'enableClientValidation' => true,
    'options' => [
        'class' => 'form default-form col-xs-12 nop',
    ],
    'action' => '/report/report/create'
]) ?>

<?= $form->field($Report, 'context_id')->hiddenInput(['value' => $context_id])->label(false); ?>
<?= $form->field($Report, 'classname')->hiddenInput(['value' => $classname])->label(false); ?>
<?= $form->field($Report, 'creator_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false); ?>

<?= $form->field($Report, 'type')->widget(Select2::className(), [
    'data' => ArrayHelper::map(open20\amos\report\models\ReportType::find()->orderBy('name')->all(),
        'id', 'name'),
    'options' => [
        'multiple' => false,
        'placeholder' => AmosReport::t('amosreport', 'Enter name of the report type'),
        'id' => 'type-id',
        'class' => 'dynamicCreation',
        'disabled' => false
    ],
]) ?>

<?= $form->field($Report, 'content')->widget(TextEditorWidget::className(), [
    'clientOptions' => [
        'placeholder' => AmosReport::t('amosreport', 'Description...'),
        'lang' => substr(Yii::$app->language, 0, 2)
    ]
]) ?>
<div class="col-xs-12 note_asterisk nop">
    <?= AmosReport::t('amosreport', 'The fields marked with ') ?><span class="red">*</span><?= AmosReport::t('amosreport', ' are required') ?>
</div>
<?= RequiredFieldsTipWidget::widget(); ?>
<div class="form-group">
    <div class="bk-btnFormContainer">
        <?= Html::submitButton(AmosReport::t('amosreport', 'Send'),
            ['class' => 'btn btn-navigation-primary', 'id' => 'submitReportForm']) ?>
        <?= Html::button(AmosReport::t('amosreport', 'Cancel'),
            ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) ?>
    </div>
</div>
<?php
ActiveForm::end();

