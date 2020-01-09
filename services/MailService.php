<?php

namespace app\services;

use Yii;

class MailService
{
    public function sendMail($from = null, $to, $subject, $template, $templateParams)
    {
        $from = $from ? $from : Yii::$app->params['senderEmail'];

        $message = Yii::$app->mailer->compose($template, $templateParams)
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
        ;

        return $message->send();
    }
}