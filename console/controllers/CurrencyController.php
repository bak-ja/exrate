<?php

namespace console\controllers;

use frontend\models\Currency;

class CurrencyController  extends \yii\console\Controller
{

    public function actionDownload()
    {
        $currency = new Currency();

        $data = $currency->loadResource('https://nationalbank.kz/rss/rates_all.xml?switch=russian');

        if($data)
            $currency->store($currency->parse($data));
    }

}