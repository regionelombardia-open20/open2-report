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

use yii\db\Migration;

/**
 * Class m220321_101400_add_field_to_middleware2
 */
class m220505_153700_update_testi_report_type extends Migration
{

    public function safeUp()
    {
        $this->update('report_type',['name' => 'contenuti inappropriati','description' => 'contenuti inappropriati'], ['id' => '1']);
        $this->update('report_type',['name' => 'Errori','description' => 'Errori'], ['id' => '2']);
    }

    public function safeDown()
    {
        $this->update('report_type',['name' => 'Inappropriate contents','description' => 'Inappropriate contents'], ['id' => '1']);
        $this->update('report_type',['name' => 'Errors','description' => 'Errors'], ['id' => '2']);

    }
}