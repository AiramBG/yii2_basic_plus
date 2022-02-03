<?php

namespace app\src\web\controllers;

use app\src\web\forms\ContactForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;


class LandingController extends Controller
{
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $form,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Displays privacy policy page.
     *
     * @return string
     */
    public function actionPrivacy() {
        return $this->render('privacy');
    }

    /**
     * Displays Terms of use page.
     *
     * @return string
     */
    public function actionTerms() {
        return $this->render('terms');
    }
}
