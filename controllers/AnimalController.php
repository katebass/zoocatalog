<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Animal;
use app\models\AnimalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AnimalController implements the CRUD actions for Animal model.
 */
class AnimalController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Animal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Animal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Animal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category_id = null)
    {
        $model = new Animal();

        //проверка типа запроса isGet isPost isPut is Ajax 
        //var_dump(Yii::$app->request->isGet); die;
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->save();
            $imageName = $model->id;

            if($model->file){
                $filePath = 'uploads/'.$imageName.'.'.$model->file->extension;
                $model->file->saveAs($filePath);
            } else{
                $filePath = 'uploads/default.png';
            }
            $model->photo = $filePath;

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'category_id' => $category_id,
        ]);
    }

    /**
     * Updates an existing Animal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $photo = $model->photo;

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if($model->file && $photo != $model->file){
                unlink($photo);

                $filename = 'uploads/'.$model->id.'.'.$model->file->extension;
                $model->file->saveAs($filename);
                $model->photo = $filename;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Animal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $photo = $this->findModel($id)->photo;

        if($photo && $photo != "uploads/default.png"){
            unlink($photo);
        }
        //die;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Animal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Animal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Animal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGallery($id){

        $pictures = $this->findModel($id)->pictures;

        return $this->render('gallery', [
            'model' => $this->findModel($id),
            'pictures' => $pictures,
        ]);
    }

    public function actionInsertThreeRows(){

        $animals = array(
            ['1', 'first_name', 'first_breed', '15', 'uploads/31.jpeg'],
            ['2', 'second_name', 'second_breed', '15', 'uploads/31.jpeg'],
            ['3', 'third_name', 'third_breed', '15', 'uploads/31.jpeg']
        );

        // echo "<pre>";
        // print_r($animals);
        // die;

        Yii::$app->db->createCommand()->batchInsert('animal',
                    ['category_id', 'name', 'breed', 'age', 'photo'],

                      $animals 
                    )
                    ->execute();

        return $this->redirect(['index']);
    }

    public function actionMassInsert(){
        
        $filename = "2018-07-10.csv";
        define('CSV_PATH','uploads/');
        $csv_file = CSV_PATH . $filename;
        
        $records = array_map('str_getcsv', file($csv_file));
        array_shift($records);

        // echo "<pre>";
        // echo mb_convert_encoding($records[24244][3], "ASCII"); 
        // echo str_replace("?", ":)", mb_convert_encoding($records[24244][3], "ASCII"));
        // die;

        Yii::$app->db->createCommand()->batchInsert(
            'call',
            ['company_phone_number', 'created_date', 'violation_date', 'consumer_city', 'consumer_state', 'subject', 'recorded_message_or_robocall'],
            $records
            )
            ->execute();


        // return $this->redirect(['index']);
    }



}
