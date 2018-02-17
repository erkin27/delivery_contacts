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
                        'actions' => ['clients', 'create-client', 'view', 'update-client', 'delete', 'create-address', 'delete-address'],
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

    /**
     * @return string
     */
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

    /**
     * @return string|\yii\web\Response
     */
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

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $client = Client::findOne($id);

        $addresses = $client->getAddresses();
        $dataProvider = new ActiveDataProvider(['query' => $addresses]);
        $dataProvider->pagination->pageSize = 5;

        return $this->render('view', ['client' => $client, 'dataProvider' => $dataProvider]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdateClient($id)
    {
        $client = Client::findOne($id);

        if ($client->load(\Yii::$app->request->post()) && $client->validate()) {
            $client->save();
            return $this->redirect(['view', 'id' => $client->id]);
        }

        return $this->render('update', ['model' => $client]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionDelete()
    {
        if (\Yii::$app->request->isPost) {
            $client = Client::findOne(\Yii::$app->request->post('id'));
            $client->delete();
        }

        return $this->redirect('clients');
    }

    /**
     * @param $id
     * @param null $addrId
     * @return string|\yii\web\Response
     */
    public function actionCreateAddress($id, $addrId = null)
    {
        $address = !empty($addrId) ? Address::findOne($addrId) : new Address();
        if(\Yii::$app->request->isPost) {
            if ($address->load(\Yii::$app->request->post()) && $address->validate()) {
                $address->client_id = $id;
                if ($address->save()) {
                    return $this->redirect(['update-client', 'id' => $id]);
                }
            }
        }

        return $this->renderAjax('create_address', ['model' => $address]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionDeleteAddress()
    {
        if (\Yii::$app->request->isPost) {
            $id = \Yii::$app->request->post('id');
            $addrId = \Yii::$app->request->post('addrId');
            $address = Address::findOne($addrId);
            $address->delete();
            return $this->redirect(['update-client', 'id' => $id]);
        }
    }
}