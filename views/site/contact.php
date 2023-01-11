<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = Yii::$app->name . ' - Зворотній звʼязок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1>Форма зворотнього звʼязоку</h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Дякуємо, що звернулися до нас. Ми відповімо вам якомога швидше.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>Якщо у вас є ділові запити чи інші запитання, будь ласка, заповніть наведену нижче форму, щоб зв’язатися з нами.</p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Ваше імʼя') ?>

                    <?= $form->field($model, 'email')->label('Ел.адреса') ?>

                    <?= $form->field($model, 'subject')->label('Тема') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Текст') ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ])->label('Перевірочний код') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Відправити запит', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
