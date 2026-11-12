<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-report
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

namespace open20\amos\report\models\base;

use open20\amos\report\AmosReport;
use yii\helpers\ArrayHelper;

/**
 * Class reportType
 *
 * This is the base-model class for table "report_type".
 *
 * @property    integer $id
 * @property    string $name
 * @property    string $description
 * @property    string $created_at
 * @property    string $updated_at
 * @property    string $deleted_at
 * @property    integer $created_by
 * @property    integer $updated_by
 * @property    integer $deleted_by
 *
 *
 * @package open20\amos\report\models\base
 */
class ReportType  extends \open20\amos\core\record\Record
{
    /**
     */
    public static function tableName()
    {
        return 'report_type';
    }

    /**
     */
    public function rules()
    {
        return [
            [['name','description'], 'string'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'required']
        ];
    }

    /**
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),
            [
                'id' => AmosReport::t('amosreport', 'Id'),
                'name' => AmosReport::t('amosreport', 'Report Type name'),
                'description' => AmosReport::t('amosreport', 'Report Type description'),
                'created_at' => AmosReport::t('amosreport', 'Created at'),
                'updated_at' => AmosReport::t('amosreport', 'Modified at'),
                'deleted_at' => AmosReport::t('amosreport', 'Deleted at'),
                'created_by' => AmosReport::t('amosreport', 'Created by'),
                'updated_by' => AmosReport::t('amosreport', 'Modified by'),
                'deleted_by' => AmosReport::t('amosreport', 'Deleted by')
            ]
        );
    }
}