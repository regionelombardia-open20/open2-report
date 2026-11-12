<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\report
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

namespace open20\amos\report\utilities;

use open20\amos\report\AmosReport;
use open20\amos\report\models\Report;

/**
 * Class ReportUtil
 * @package open20\amos\report\utilities
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

    /**
     * @param string $className
     * @param integer $context_id
     * @return integer
     */
    public static function retrieveReportsCount($className, $context_id){
        return self::retrieveReportsQuery($className, $context_id)
            ->count();
    }

}
