<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\report\migrations
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

use open20\amos\report\models\Report;
use yii\db\Migration;

/**
 * Class m170720_124351_alter_table_report_add_validator_id
 */
class m170720_124351_alter_table_report_add_validator_id extends Migration
{
    public function safeUp()
    {
        $this->addColumn(Report::tableName(), 'validator_id', $this->integer()->null()->defaultValue(null)->after('creator_id'));

        $reports = Report::find()->all();
        foreach ($reports as $report){
            $className = $report->classname;
            $contentModel = $className::findOne($report->context_id);
            if(!empty($contentModel)) {
                $report->creator_id = $contentModel->created_by;
                if (!is_null($contentModel->getBehavior('workflowLog')) && $contentModel->hasMethod('getValidatedStatus')) {
                    $validatorId = $contentModel->getStatusLastUpdateUser($contentModel->getValidatedStatus());
                    $report->validator_id = $validatorId;
                }
                $report->save();
            }
        }
        return true;

    }

    public function safeDown()
    {

        $reports = Report::find()->all();
        foreach ($reports as $report){
            $report->creator_id = $report->created_by;
            $report->save();
        }
        $this->dropColumn(Report::tableName(), 'validator_id');

        return true;
    }

}
