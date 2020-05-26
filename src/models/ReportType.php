<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    amos-report
 * @category   CategoryName
 */


namespace open20\amos\report\models;

use yii\helpers\ArrayHelper;

class ReportType extends \open20\amos\report\models\base\ReportType
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
        ]);
    }
}