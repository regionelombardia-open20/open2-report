<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\report
 * @category   CategoryName
 */

namespace lispa\amos\report\utilities;

use lispa\amos\report\AmosReport;
use lispa\amos\report\models\Report;

/**
 * Class ReportUtil
 * @package lispa\amos\report\utilities
 */
class ReportUtil
{

    public static function translateArrayValues($arrayValues)
    {
        $translatedArrayValues = [];
        foreach ($arrayValues as $key => $title) {
            $translatedArrayValues[$key] = $title;
        }
        return $translatedArrayValues;
    }

    /**
     * @param string $className
     * @param integer $context_id
     * @return \yii\db\ActiveRecord
     */
    public static function retrieveReportsQuery($className, $context_id){
        return Report::find()
                ->andWhere([
                    'classname' => $className,
                    'context_id' => $context_id
                ]);
    }

    /**
     * @param string $className
     * @param integer $context_id
     * @return array
     */
    public static function retrieveReports($className, $context_id){
        return self::retrieveReportsQuery($className, $context_id)
            ->asArray()
            ->all();
    }

    /**
     * @param string $className
     * @param integer $context_id
     * @return array
     */
    public static function retrieveUnreadReports($className, $context_id){
        return self::retrieveReportsQuery($className, $context_id)
            ->andWhere([
                'read_at' => null,
                'read_by' => 0
            ])
            ->asArray()
            ->all();
    }

}
