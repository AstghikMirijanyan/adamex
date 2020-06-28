<?php

namespace backend\modules\products\controllers;

use backend\modules\colors\models\Colors;
use backend\modules\images\models\Images;
use backend\modules\menu\models\Menu;
use backend\modules\productColor\models\ProductColor;
use backend\modules\productMenu\models\ProductMenu;
use backend\modules\productSizes\models\ProductSizes;
use backend\modules\sizes\models\Sizes;
use Yii;
use backend\modules\products\models\Products;
use backend\modules\products\models\ProductControl;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        $modelImages = new Images();
        $modelSizes = new Sizes();
        $modelMenu = new Menu();
        $modelColors = new Colors();

        $menu_items = Menu::find()->asArray()->all();
        $size_items = Sizes::find()->asArray()->all();
        $color_items = Colors::find()->asArray()->all();

        if (!empty(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $productsModel = ['Products' => $post['Products']];

            $model->load($productsModel);
            if ($model->save(false)) {
                if (!empty($model->id)) {
                    if (!empty($post['Menu'])) {
                            foreach ($post['Menu']['name'] as $value) {
                                $productMenu = new ProductMenu();
                                $productMenu->menu_id = $value;
                                $productMenu->product_id = $model->id;
                                $productMenu->save();
                            }
                    }
                    if (!empty($post['Color'])) {
                        foreach ($post['Color']['color_name'] as $color) {
                            $productColor = new ProductColor();
                            $productColor->color_id = $color;
                            $productColor->product_id = $model->id;
                            $productColor->save();
                        }
                    }
                    if (!empty($post['Sizes'])){
                        foreach ($post['Sizes']['name'] as $size){
                            $productSizes = new ProductSizes();
                            $productSizes->product_id =$model->id;
                            $productSizes->size_id = $size;
                            $productSizes->save();
                        }
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelImages' => $modelImages,
            'modelSizes' => $modelSizes,
            'modelColors' => $modelColors,
            'modelMenu' => $modelMenu,
            'menu_items' => $menu_items,
            'size_items' => $size_items,
            'color_items' => $color_items
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
