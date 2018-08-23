<?php

namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;

class ConsoleGreatingsController extends Controller
{
	/**
	 * This command echoes what you have entered as the message.
	 * @param string $message the message to be echoed.
	 * @return int Exit code
	 */
	public function actionIndex($message = 'hello world')
	{
		echo $message . "\n";

		return ExitCode::OK;
	}
}