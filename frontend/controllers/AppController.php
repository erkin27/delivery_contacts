<?php
/**
 * Created by PhpStorm.
 * User: erkin
 * Date: 17.02.18
 * Time: 14:13
 */

namespace frontend\controllers;


use frontend\models\Address;
use frontend\models\Client;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AppController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['clients', 'create-client', 'view', 'update-client', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionClients()
    {
        $clients = Client::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $clients
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreateClient()
    {
        $client = new Client();

        $address = new Address();

        $request = \Yii::$app->request;

        if ($request->post()) {
            if ($client->load($request->post()) && $address->load($request->post())) {
                if ($client->validate() && $address->validate()) {
                    try {
                        if ($client->save()) $address->client_id = $client->id;
                        $address->save();
                        return $this->redirect(['view', 'id' => $client->id]);
                    } catch (\Exception $e) {
                        \Yii::$app->getSession()->setFlash('error', 'Error.' . $e->getMessage());
                    }
                }
            }
        }

        return $this->render('create', [
            'client' => $client,
            'address' => $address
        ]);
    }

    public function actionView($id)
    {
        $client = Client::findOne($id);

        $addresses = $client->getAddresses()->all();

        return $this->render('view', ['client' => $client, 'addresses' => $addresses]);
    }

    public function actionUpdateClient($id)
    {
        $client = Client::findOne($id);

        if ($client->load(\Yii::$app->request->post()) && $client->validate()) {
            $client->save();
        }

        return $this->render('update', ['model' => $client]);
    }

    public function actionDelete($id)
    {
        $client = Client::findOne($id);

        $client->delete();

        return $this->redirect('clients');
    }
}