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
 * Class Report
 *
 * This is the base-model class for table "report".
 *
 * @property    integer $id
 * @property    string $classname
 * @property    integer $context_id
 * @property    integer $type
 * @property    string $content
 * @property    integer $status
 * @property    integer $creator_id
 * @property    integer $validator_id
 * @property    string $read_t
 * @property    integer $read_by
 * @property    string $created_at
 * @property    string $updated_at
 * @property    string $deleted_at
 * @property    integer $created_by
 * @property    integer $updated_by
 * @property    integer $deleted_by
 *
 * @property \open20\amos\report\models\ReportType $reportType
 * @property \open20\amos\core\user\User $user
 *
 * @package open20\amos\report\models\base
 */
class Report extends \open20\amos\core\record\Record
{
    /**
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['content', 'type', 'context_id'], 'required'],
            [
                [
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'status',
                    'content',
                    'context_id',
                    'creator_id',
                    'validator_id',
                    'type',
                    'classname'
                ],
                'safe'
            ],
        ];
    }

    /**
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),
            [
                'id' => AmosReport::t('amosreport', 'Id'),
                'context_id' => AmosReport::t('amosreport', 'Context ID'),
                'type' => AmosReport::t('amosreport', 'Report Type'),
                'content' => AmosReport::t('amosreport', 'Description'),
                'status' => AmosReport::t('amosreport', 'report status'),
                'creator_id' => AmosReport::t('amosreport', 'Content creator ID'),
                'validtor_id' => AmosReport::t('amosreport', 'Content validator ID'),
                'read_at' => AmosReport::t('amosreport', 'Report read at'),
                'read_by' => AmosReport::t('amosreport', 'Report read by user'),
                'created_at' => AmosReport::t('amosreport', 'Created at'),
                'updated_at' => AmosReport::t('amosreport', 'Modified at'),
                'deleted_at' => AmosReport::t('amosreport', 'Deleted at'),
                'created_by' => AmosReport::t('amosreport', 'Created by'),
                'updated_by' => AmosReport::t('amosreport', 'Modified by'),
                'deleted_by' => AmosReport::t('amosreport', 'Deleted by')
            ]
        );
    }

    /**
     * This is the relation between the report and report type
     * Return an ActiveQuery related to ReportType model.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReportType()
    {
        return $this->hasOne(\open20\amos\report\models\ReportType::className(), ['id' => 'type']);
    }

    public function getUser()
    {
        return $this->hasOne(\open20\amos\core\user\User::className(), ['id' => 'created_by']);
    }

}