<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $sku
 * @property string $created_at
 */
class Product extends \yii\db\ActiveRecord
{

    /**
     * Table Name
     * 
     * Returns the string table name for this ActiveRecord model.
     * 
     * @return string
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * Fields
     * 
     * This method returns an array of strings which define the fields
     * returned from the table.
     * 
     * @return array
     */
    public function fields() {
        return ["sku", "attributes"];
    }
    
    /**
     * Rules
     * 
     * Validation rules for the model are defined here. 
     * 
     * @return array
     */
    public function rules()
    {
        return [
            [['sku', 'attributes'], 'required'],
            [['created_at'], 'safe'],
            [['attributes'], 'validateAttributes'],
            [['sku'], 'string', 'max' => 50],
            [['sku'], 'unique'],
        ];
    }

    /**
     * Validate Attributes
     * 
     * This method validates the attributes property of this class.
     * 
     * @param type $attribute
     * @param type $params
     * @param type $validator
     * @return boolean
     */
    public function validateAttributes($attribute, $params, $validator) {
        
        \Yii::info($attribute);
        \Yii::info($params);
        \Yii::info($validator);
                
        return false;
        
    }
    
    /**
     * Init
     * 
     * This method overrides the base class' init() method and 
     * adds events which must be triggered using Yii events.
     * 
     * @return void
     */
    public function init()
    {
        $this->on(self::EVENT_BEFORE_INSERT, [$this, "setBeforeInsert"]);
        parent::init();
    }

    /**
     * Set Before Insert
     * 
     * This method sets default parameter values before inserting the
     * record in the database.
     * 
     * @return void
     */
    public function setBeforeInsert()
    {
        $this->setAttribute("created_at", date("Y-m-d H:i:s"));
    }
    
}
