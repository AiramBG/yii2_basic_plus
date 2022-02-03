<?php

namespace app\src\web\controllers;

use app\src\common\components\users\entities\User;
use app\src\web\forms\AccountRecoveryForm;
use app\src\web\forms\PasswordResetForm;
use app\src\web\forms\SignupForm;
use app\src\web\forms\LoginForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;


class AccountsController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post())) {
            if ($form->login()) {
                return $this->redirect(['dashboard/index']);
            } else {
                Yii::$app->session->setFlash('error', Yii::l('login_fail', ['loginField' => Yii::l(User::LOGIN_FIELD), 'password' => Yii::l('password')]));
                return $this->refresh();
            }

        }

        $form->password = '';
        return $this->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->signup()) {
            return $this->render('informer', [
                'title' => Yii::l('signup'),
                'h1' => Yii::l('account_creation_success'),
                'message' => Yii::l('account_validation_email_sent'),
            ]);
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $v     Validation token sended by email
     * @return Response|string
     */
    public function actionActivation($v)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $success = false;
        $user = User::findByValidationTokenCode($v);
        if ($user) {
            $user->status = User::STATUS_ACTIVE;
            $success = $user->save(false);
        }

        return $this->render('activation', ['success' => $success]);
    }

    /**
     * Account recovery page
     *
     * @return Response|string
     */
    public function actionRecovery()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new AccountRecoveryForm();
        if ($form->load(Yii::$app->request->post())) {
            $sended = $form->sendEmail();
            return $this->render('informer', [
                'title' => Yii::l('account_recovery'),
                'h1' => Yii::l('account_recovery'),
                'message' => $sended ? Yii::l('account_recovery_sended') : Yii::l('account_recovery_fail'),
            ]);
        }

        return $this->render('recovery', [
            'model' => $form,
        ]);
    }

    /**
     * Password change page
     *
     * @param string $t     token sended by email
     * @return Response|string
     */
    public function actionPasswordReset($t)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new PasswordResetForm();
        $form->token = $t;
        if ($form->load(Yii::$app->request->post())) {
            if ($form->reset()) {
                return $this->render('informer', [
                    'title' => Yii::l('password_reset'),
                    'h1' => Yii::l('password_change_success'),
                    'message' => Yii::l('you_can_login_now'),
                ]);
            } else {
                Yii::$app->session->setFlash('error', Yii::l('password_change_fail'));
                return $this->refresh();
            }
        }

        return $this->render('passwordReset', [
            'model' => $form,
        ]);

    }

    /**
     * User account configuration
     *
     * @param string $t     token sended by email
     * @return Response|string
     */
    public function actionProfile()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new PasswordResetForm();
        $form->token = $t;
        if ($form->load(Yii::$app->request->post())) {
            if ($form->reset()) {
                return $this->render('informer', [
                    'title' => Yii::l('password_reset'),
                    'h1' => Yii::l('password_change_success'),
                    'message' => Yii::l('you_can_login_now'),
                ]);
            } else {
                Yii::$app->session->setFlash('error', Yii::l('password_change_fail'));
                return $this->refresh();
            }
        }

        return $this->render('passwordReset', [
            'model' => $form,
        ]);

    }
}
