<?php

namespace app\src\web\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class DashboardController extends Controller
{
    public $layout = 'dashboard';

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays the dashboard main page.
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('index');
    }

    /**
     * Test roles and permissions.
     *
     * @return string|Response
     */
    public function actionRbac_test()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (Yii::$app->user->can('ExampleAccess')) {
            return $this->render('rbac_success');
        } else {
            return $this->render('rbac_failed');
        }
    }


    /**
     * Assign role ExampleRole.
     *
     * @return string|Response
     */
    public function actionRbac_add()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (!Yii::$app->user->can('ExampleAccess')) {
            $auth = Yii::$app->authManager;
            $auth->assign($auth->getRole('ExampleRole'), Yii::$app->user->getId());
        }

        return $this->redirect(['index']);
    }

    /**
     * Remove role ExampleRole.
     *
     * @return string|Response
     */
    public function actionRbac_reset()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (Yii::$app->user->can('ExampleAccess')) {
            $auth = Yii::$app->authManager;
            $auth->revoke($auth->getRole('ExampleRole'), Yii::$app->user->getId());
        }

        return $this->redirect(['index']);
    }

}
