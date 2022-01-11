<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_attribute".
 *
 * @property int $id Index
 * @property int $product_id Product ID
 * @property int $attribute_id Attribute ID
 * @property string $attribute_value Attribute Value
 * @property string $created_at Created At
 */
class ProductAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_attribute';
    }
    
    /**
     * {@inheritdoc}
     */
    public function fields() {
        return ['key', 'attribute_value'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_id', 'attribute_value', 'created_at'], 'required'],
            [['product_id', 'attribute_id'], 'integer'],
            [['created_at'], 'safe'],
            [['attribute_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Index',
            'product_id' => 'Product ID',
            'attribute_id' => 'Attribute ID',
            'attribute_value' => 'Attribute Value',
            'created_at' => 'Created At',
        ];
    }
    
    public function product(): \yii\db\ActiveQuery {
        $this->hasOne(Product::class, ["id"=>"product_id"]);
    }
    
    public function getKey() {
        $this->hasOne(Attribute::class, ["attribute_id"=>"id"]);
    }
    
}
