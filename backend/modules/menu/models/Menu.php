<?php

namespace backend\modules\menu\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProductMenu[] $productMenus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[ProductMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductMenus()
    {
        return $this->hasMany(ProductMenu::className(), ['menu_id' => 'id']);
    }
}
