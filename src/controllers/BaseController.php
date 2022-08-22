<?php
namespace verbb\kint\controllers;

use verbb\kint\Kint;

use craft\web\Controller;

use yii\web\Response;

class BaseController extends Controller
{
    // Public Methods
    // =========================================================================

    public function actionSettings(): Response
    {
        $settings = Kint::$plugin->getSettings();

        return $this->renderTemplate('kint/settings', [
            'settings' => $settings,
        ]);
    }

}