<?php

namespace frontend\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use frontend\models\Currency;


class CurrencyController extends ActiveController
{
    public $modelClass = 'console\models\Currency';

    private $token = 'qwerty';

    private $requestToken;

    /**
     * @return array
     */

    public function actions()
    {
        $actions =  parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create'], $actions['update']);

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }


    public function checkAccess($action, $model = null, $params = [])
    {
        $header = \Yii::$app->request->getHeaders()->get('Authorization');

        if($header)
            $this->requestToken = str_replace('Bearer ', '', $header);

        if(!$this->requestToken)
            throw new \yii\web\UnauthorizedHttpException('Токен не предоставлен', 401);

        if($this->requestToken != $this->token)
            throw new \yii\web\ForbiddenHttpException('Предоставлен некорректный токен;', 403);

    }

    /**
     * @return ActiveDataProvider
     * @throws \yii\web\NotFoundHttpException
     */
    public function prepareDataProvider()
    {
        $date = \Yii::$app->request->get('date');
        $name = \Yii::$app->request->get('name');

        $query = Currency::find()->andWhere(['date' => $date ? $date : date('Y-m-d')]);

        if($name)
            $query->andWhere(['name' => $name]);

        if(!$query->all())
            throw new \yii\web\NotFoundHttpException('Данные не найдены', 404);


        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}