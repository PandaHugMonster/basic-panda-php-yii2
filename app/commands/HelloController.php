<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\layers\CommandControllerLayer;
use spaf\simputils\attributes\Property;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 * @property string $my_addition
 */
class HelloController extends CommandControllerLayer {

	// NOTE Just an example how properties of SimpUtils can be used
	#[Property]
	protected string $_my_addition = "hello panda";

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world') {
        echo "{$message}, {$this->_my_addition}\n";

        return ExitCode::OK;
    }
}
