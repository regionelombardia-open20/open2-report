<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    amos-report
 * @category   Model
 */


namespace open20\amos\report\models;

use open20\amos\notificationmanager\behaviors\NotifyBehavior;
use yii\helpers\ArrayHelper;

class Report extends \open20\amos\report\models\base\Report
{
    /**
     * @see    \yii\db\BaseActiveRecord::init()    for more info.
     */
    public function init()
    {
        parent::init();
    }

    public function afterFind()
    {
        parent::afterFind();
    }
    /**
     * @see    \yii\base\Component::behaviors()    for more info.
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'NotifyBehavior' => [
                'class' => NotifyBehavior::className(),
                'conditions' => [],
            ]
        ]);
    }

}