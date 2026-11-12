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

namespace open20\amos\report\widgets;

use open20\amos\core\helpers\Html;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\module\BaseAmosModule;
use open20\amos\report\AmosReport;
use yii\base\Widget;

/**
 * Class ReportWidget
 * @package open20\amos\report\widgets
 */
class ReportWidget extends Widget
{
    /**
     * @var string $modelClassName the current model processed className
     */
    public $modelClassName = '';

    /**
     * @var null
     */
    public $context_id = null;

    /**
     * @var string
     */
    public $layout = "{reportButton}";
    /**
     * @var array
     */
    public $renderSections = [];

    /**
     * @var
     */
    public $options = [];

    /**
     * @var string
     */
    public $title = '';

    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();

        if (is_null($this->modelClassName)) {
            throw new \Exception(BaseAmosModule::t('amosreport', 'Missing Model'));
        }
        if (is_null($this->context_id)) {
            throw new \Exception(BaseAmosModule::t('amosreport', 'Missing Context Id'));
        }

    }


    /**
     * @return mixed
     */
    public function run()
    {
        $content = preg_replace_callback("/{\\w+}/", function ($matches) {
            $content = $this->renderSection($matches[0]);

            return $content === false ? $matches[0] : $content;
        }, $this->layout);
        $options = $this->options;

        return $this->render('report',[
            'widget' => $this,
            'content' => $content,
            'context_id' => $this->context_id,
            'className' => $this->modelClassName,
            'title' => $this->title
        ]);
    }

      /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{publisher}`, `{publisherAdv}`.
     * @return string|bool the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        if (isset($this->renderSections[$name]) && $this->renderSections[$name] instanceof \Closure) {
            return call_user_func($this->renderSections[$name], $this->model, $this);
        }
        switch ($name) {
            case '{reportButton}':
                return $this->renderReportButton();
            default:
                return false;
        }
    }

    /**
     * @return string
     */
    public function renderReportButton()
    {
        $href = 'javascript: void(0)';
        $button = Html::a(AmosIcons::show("flag", ["class" => "am-2"]), null , [
            'id' => 'load_form-'.$this->context_id,
            'title' => AmosReport::t('amosreport', 'You can report errors or contents that you consider inappropriate and, if necessary, ask for correction')
        ]);
//        $button = '<a href="' . $href . '" id="load_form" title="'. AmosReport::t('amosreport', 'Report').'">' . AmosIcons::show("flag", ["class" => "am-2"]) . '</a>';
        return $button;
    }


}