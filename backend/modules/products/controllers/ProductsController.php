<?php

namespace backend\modules\products\controllers;

use backend\modules\colors\models\Colors;
use backend\modules\images\models\Images;
use backend\modules\menu\models\Menu;
use backend\modules\productColor\models\ProductColor;
use backend\modules\productMenu\models\ProductMenu;
use backend\modules\productSizes\models\ProductSizes;
use backend\modules\sizes\models\Sizes;
use common\models\Deal;
use common\models\Model;
use common\models\ProductsImage;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Imagine\Image\Box;
use Yii;
use backend\modules\products\models\Products;
use backend\modules\products\models\ProductControl;
use yii\base\Exception;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    private $_ffmpegBinaries = '/usr/bin/ffmpeg';
    private $_ffprobeBinaries = '/usr/bin/ffprobe';
    private $_timeout = 3600;
    private $_ffmpegThreads = 12;
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
        $modelImage = new Images();
        $modelSizes = new Sizes();
        $modelMenu = new Menu();
        $modelColors = new Colors();

        $menu_items = Menu::find()->asArray()->all();
        $size_items = Sizes::find()->asArray()->all();
        $color_items = Colors::find()->asArray()->all();

        if (!empty(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $productsModel = ['Products' => $post['Products']];
            $modelsProductsImage = Model::createMultiple(Images::className());
            Model::loadMultiple($modelsProductsImage, Yii::$app->request->post());

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

                    $modelImage->imageFileMulty = UploadedFile::getInstances($modelImage, "imageFileMulty");

                    if(!empty($modelImage->imageFileMulty)){

                        foreach ($modelImage->imageFileMulty as $i => $mImage){

                            $modelImage = new Images();
                            $modelImage->product_id = $model->id;

                            $check_main_image = Images::findOne(['product_id' => $model->id, 'main_image' => '0']);

                            if(empty($check_main_image)){
                                $modelImage->main_image = 0;
                            }

                            $name = Yii::$app->security->generateRandomString();

                            if(preg_match('#^video\/.+$#', $mImage->type)){

                                $mImage->saveAs(Yii::$app->params['productVideo'] . $name . '.' . $mImage->extension);

                                $ffmpeg = FFMpeg::create([
                                    'ffmpeg.binaries'  => $this->_ffmpegBinaries, // the path to the FFMpeg binary
                                    'ffprobe.binaries' => $this->_ffprobeBinaries, // the path to the FFProbe binary
                                    'timeout'          => $this->_timeout, // the timeout for the underlying process
                                    'ffmpeg.threads'   => $this->_ffmpegThreads,   // the number of threads that FFMpeg should use
                                ]);

                                $video = $ffmpeg->open(Yii::$app->params['productVideo'] . $name . '.' . $mImage->extension);
                                $frame = $video->frame(TimeCode::fromSeconds(1));
                                $frame->save(Yii::$app->params['productImage'] . $name . '.jpg', true);
                                Image::thumbnail(Yii::$app->params['productImage'] . $name . '.jpg', 329, 280,\Imagine\Image\ImageInterface::THUMBNAIL_INSET)->save(Yii::$app->params['productImage'] . $name . '.jpg');
                                Image::watermark(Yii::$app->params['productImage'] . $name . '.jpg',Yii::getAlias('@frontend').'/web/images/play.png',[89.5, 65])->save(Yii::$app->params['productImage'] . $name . '.jpg');

                                $modelImage->image =  $name . '.jpg';
                                $modelImage->type =  'video';

                            }else{

                                $modelImage->type =  'image';
                                $mImage->saveAs(Yii::getAlias('@frontend') . '/web/images/products/large/' . $name . '.' . $mImage->extension);
                                $modelImage->image = $name . '.' . $mImage->extension;

                                Image::thumbnail(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelImage->image, 329, 280,\Imagine\Image\ImageInterface::THUMBNAIL_INSET)
                                    ->save(Yii::getAlias('@frontend') . '/web/images/products/' . $modelImage->image, ['quality' => 100]);

                                $img = Image::getImagine()->open(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelImage->image);

                                $width = ($img->getSize()->getWidth()) + 400;
                                $height = ($img->getSize()->getHeight()) + 400;

                                $img->resize(new Box($width,$height))->save(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelImage->image , ['quality' => 100]);

                            }
                            $modelImage->size_id=$productSizes->id;
                            $modelImage->color_id=$productColor->id;
                            $modelImage->save(false);

                        }

                    }else{

                        foreach ($modelsProductsImage as $i => $modelProductsImage) {

                            $modelProductsImage->product_id = $model->id;

                            if($i == 0){

                                $modelProductsImage->main_image = 0;

                            }else{

                                $modelProductsImage->main_image = 1;

                            }

                            $name = Yii::$app->security->generateRandomString();
                            $modelProductsImage->imageFile = UploadedFile::getInstance($modelProductsImage, "[$i]imageFile");

                            if($modelProductsImage->imageFile != null){

                                $modelProductsImage->imageFile->saveAs(Yii::getAlias('@frontend') . '/web/images/products/large/' . $name . '.' . $modelProductsImage->imageFile->extension);
                                $modelProductsImage->image = $name . '.' . $modelProductsImage->imageFile->extension;
                                $modelProductsImage->product_id = $model->id;

                                Image::thumbnail(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelProductsImage->image, 329, 280,\Imagine\Image\ImageInterface::THUMBNAIL_INSET)
                                    ->save(Yii::getAlias('@frontend') . '/web/images/products/' . $modelProductsImage->image, ['quality' => 100]);

                                $img = Image::getImagine()->open(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelProductsImage->image);

                                $width = ($img->getSize()->getWidth()) + 400;
                                $height = ($img->getSize()->getHeight()) + 400;

                                $img->resize(new Box($width,$height))->save(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelProductsImage->image , ['quality' => 100]);

                            }else{
                                continue;
                            }
                            $modelImage->size_id=$modelSizes->id;
                            $modelImage->color_id=$modelColors->id;
                            $modelProductsImage->save(false);
                        }

                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelImages' => $modelImage,
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
        $modelsProductsImage = $model->images;
        $modelsColor = $model->productColors;
        $modelImage = new Images();
        $modelSizes = new Sizes();
        $modelMenu = new Menu();
        $modelColors = new Colors();
        $modelCol = new ProductColor();
        $menu_items = Menu::find()->asArray()->all();
        $size_items = Sizes::find()->asArray()->all();
        $color_items = Colors::find()->asArray()->all();
        $color_name = Colors::find()->where(['img_name' => null])->all();
        $img_name = Colors::find()->where(['color_name' => '(не задано)'])->all();

        if(Yii::$app->request->isAjax){

            if(Yii::$app->request->post('id')){

                $modelCol::deleteAll(['id' => Yii::$app->request->post('id')]);

            }elseif(Yii::$app->request->post('img_del_id')){

                $image_file_to_delete = Images::find()->where(['id' => Yii::$app->request->post('img_del_id')])->one();
                $product_id  = $image_file_to_delete->product_id;
                $image_file_to_delete = $image_file_to_delete->image;

                if(file_exists(Yii::$app->params['productImage'] . $image_file_to_delete)){
                    unlink(Yii::$app->params['productImage'] . $image_file_to_delete);
                }

                if(file_exists(Yii::$app->params['productImageLarge'] . $image_file_to_delete)){
                    unlink(Yii::$app->params['productImageLarge'] . $image_file_to_delete);
                }

                Images::deleteAll(['id' => Yii::$app->request->post('img_del_id')]);

                $product_image = Images::find()->where(['product_id' => $product_id])->all();
                $main_image = true;

                foreach($product_image as $key => $image){
                    if($image->main_image == 0){
                        $main_image = true;
                        break;
                    }else{
                        $main_image = false;
                    }
                }

                if($main_image == false){
                    $product_image[0]->main_image = 0;
                    $product_image[0]->save(false);
                }

            }

        }

        if ($model->load(Yii::$app->request->post())) {

            $modelsProductsImage = Model::createMultiple(Images::className(), $modelsProductsImage);
            Model::loadMultiple($modelsProductsImage, Yii::$app->request->post());

            $modelsColor = Model::createMultiple(ProductColor::className(), $modelsColor);
            Model::loadMultiple($modelsColor, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProductsImage) && $valid;
            $valid = Model::validateMultiple($modelsColor) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

//                      Update ProductsImage data

                        if ($flag) {

                            $modelImage->imageFileMulty = UploadedFile::getInstances($modelImage, "imageFileMulty");

                            if(!empty($modelImage->imageFileMulty)){

                                foreach ($modelImage->imageFileMulty as $i => $mImage){

                                    $modelImage = new Images();
                                    $modelImage->product_id = $model->id;

                                    $check_main_image = Images::findOne(['product_id' => $model->id, 'main_image' => '0']);

                                    if(empty($check_main_image)){
                                        $modelImage->main_image = 0;
                                    }

                                    $name = Yii::$app->security->generateRandomString();

                                    if(preg_match('#^video\/.+$#', $mImage->type)){

                                        $mImage->saveAs(Yii::$app->params['productVideo'] . $name . '.' . $mImage->extension);

                                        $ffmpeg = FFMpeg::create([
                                            'ffmpeg.binaries'  => $this->_ffmpegBinaries, // the path to the FFMpeg binary
                                            'ffprobe.binaries' => $this->_ffprobeBinaries, // the path to the FFProbe binary
                                            'timeout'          => $this->_timeout, // the timeout for the underlying process
                                            'ffmpeg.threads'   => $this->_ffmpegThreads,   // the number of threads that FFMpeg should use
                                        ]);

                                        $video = $ffmpeg->open(Yii::$app->params['productVideo'] . $name . '.' . $mImage->extension);
                                        $frame = $video->frame(TimeCode::fromSeconds(1));
                                        $frame->save(Yii::$app->params['productImage'] . $name . '.jpg', true);
                                        Image::thumbnail(Yii::$app->params['productImage'] . $name . '.jpg', 329, 280,\Imagine\Image\ImageInterface::THUMBNAIL_INSET)->save(Yii::$app->params['productImage'] . $name . '.jpg');
                                        Image::watermark(Yii::$app->params['productImage'] . $name . '.jpg',Yii::getAlias('@frontend').'/web/images/play.png',[89.5, 65])->save(Yii::$app->params['productImage'] . $name . '.jpg');

                                        $modelImage->image =  $name . '.jpg';
                                        $modelImage->type =  'video';

                                    }else{

                                        $modelImage->type =  'image';
                                        $mImage->saveAs(Yii::getAlias('@frontend') . '/web/images/products/large/' . $name . '.' . $mImage->extension);
                                        $modelImage->image = $name . '.' . $mImage->extension;

                                        Image::thumbnail(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelImage->image, 329, 280,\Imagine\Image\ImageInterface::THUMBNAIL_INSET)
                                            ->save(Yii::getAlias('@frontend') . '/web/images/products/' . $modelImage->image, ['quality' => 100]);

                                        $img = Image::getImagine()->open(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelImage->image);

                                        $width = ($img->getSize()->getWidth()) + 400;
                                        $height = ($img->getSize()->getHeight()) + 400;

                                        $img->resize(new Box($width,$height))->save(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelImage->image , ['quality' => 100]);

                                    }

                                    if (!($flag = $modelImage->save(false))) {
                                        $transaction->rollBack();
                                    }

                                }

                            }else{

                                foreach ($modelsProductsImage as $i => $modelProductsImage) {
                                    $name = Yii::$app->security->generateRandomString();
                                    $modelProductsImage->imageFile = UploadedFile::getInstance($modelProductsImage, "[$i]imageFile");

                                    if($modelProductsImage->imageFile != null){

                                        $modelProductsImage->product_id = $model->id;

                                        if($modelProductsImage->image != null){
                                            if(file_exists(Yii::$app->params['productImage'] . $modelProductsImage->image)){
                                                unlink(Yii::$app->params['productImage'] . $modelProductsImage->image);
                                            }
                                            if(file_exists(Yii::$app->params['productImageLarge'] . $modelProductsImage->image)){
                                                unlink(Yii::$app->params['productImageLarge'] . $modelProductsImage->image);
                                            }
                                        }

                                        $modelProductsImage->imageFile->saveAs(Yii::getAlias('@frontend') . '/web/images/products/large/' . $name . '.' . $modelProductsImage->imageFile->extension);
                                        $modelProductsImage->image = $name . '.' . $modelProductsImage->imageFile->extension;

                                        Image::thumbnail(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelProductsImage->image, 329, 280,\Imagine\Image\ImageInterface::THUMBNAIL_INSET)
                                            ->save(Yii::getAlias('@frontend') . '/web/images/products/' . $modelProductsImage->image, ['quality' => 100]);

                                        $img = Image::getImagine()->open(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelProductsImage->image);

                                        $width = ($img->getSize()->getWidth()) + 400;
                                        $height = ($img->getSize()->getHeight()) + 400;

                                        $img->resize(new Box($width,$height))->save(Yii::getAlias('@frontend') . '/web/images/products/large/' . $modelProductsImage->image , ['quality' => 100]);

                                    }else{
                                        continue;
                                    }

                                    if (!($flag = $modelProductsImage->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }

                                }

                            }
                        }

//                      Update ProductsColor data

                        foreach ($modelsColor as $i => $modelColor) {

                            if(!empty($modelColor->custom_color)){

                                $colorModel = new Colors();

                                $colorModel->alt = $modelColor->custom_color;

                                $colorModel->save(false);

                                $modelColor->color_id = $colorModel->id;

                            }

                            $modelColor->product_id = $model->id;

                            if (!($flag = $modelColor->save(false))) {
                                $transaction->rollBack();
                            }

                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect('index');
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelImages' => $modelImage,
            'modelSizes' => $modelSizes,
            'modelColors' => $modelColors,
            'modelMenu' => $modelMenu,
            'menu_items' => $menu_items,
            'size_items' => $size_items,
            'color_items' => $color_items
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
