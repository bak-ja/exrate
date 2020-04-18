<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\httpclient\Client;
use yii\httpclient\ParserInterface;
use yii\httpclient\Response;


class Currency extends ActiveRecord implements ParserInterface
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currencies';
    }

    public function fields()
    {
        return ['name', 'rate', 'date'];
    }

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'rate', 'date'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function loadResource($resource)
    {
        $client = new Client(['baseUrl' => $resource]);

           return $response = $client->createRequest()
                ->setFormat(Client::FORMAT_XML)
                ->send();
    }


    /**
     * Parses given HTTP response instance.
     * @param Response $response HTTP response instance.
     * @return mixed parsed content data.
     */
    public function parse(Response $response)
    {
        $xml = simplexml_load_string($response->content, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        return $array;
    }

    public function store($data){

        foreach ($data["channel"]["item"] as $item){

            $rate = Currency::findOne(['name' => $item['title'], 'date' => date('Y-m-d')]);

            if(!$rate) $rate = new Currency();

            $rate->name = $item['title'];
            $rate->rate = $item['description'];
            $rate->date = date('Y-m-d');
            $rate->save();
        }

    }
}