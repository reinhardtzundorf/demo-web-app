<?php

namespace app\controllers;

use app\models\Product;

use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\rest\Controller;


/**
 * Product Controller
 * 
 * This class handles incoming requests routed from the entry-point script.
 * The configured endpoints are /product and /product/create. This model 
 * implemented in this controller is the Product model. 
 */
class ProductController extends Controller
{
    
    public $enableCsrfValidation = false;
    public $modelClass = "app\models\Product";
    
    
    /**
     * Before Action
     * 
     * This event hook is used to disable CSRF validation - which is not used
     * in this API because it is "stateless". Cross Site Request Forgery 
     * (or CSRF) is an attack which forces the user to perform unwanted actions
     * on a website in which they are currently authenticated/logged in. 
     * 
     * Since this application does not require authentication or persist the
     * user's state; this has been disabled.
     * 
     * @param type $action
     * @return type
     */
//    public function beforeAction($action)
//    {
//        $this->enableCsrfValidation = false;
//        return parent::beforeAction($action);
//    }
    
    /**
     * Allowed Domains
     * 
     * This method returns the domains allowed in the CORS header.
     * 
     * @return array
     */
    public static function allowedDomains()
    {
        return [
             "http://localhost:8081"
        ];
    }
    
    /**
     * {@inheritdoc}
     */
//    public function beforeAction($action)
//    {
//        if ($this->isPreFligt(Yii::$app->request)) {
//            return true;
//        }
//
//        return parent::beforeAction($action);
//    }
//    
//    protected function isPreFligt($request)
//    {
//        return $request->isOptions;
//    }

    /**
     * Behaviors
     * 
     * This method configures the behaviors for this controller. The Content
     * Negotiator behavior has been set to transform all responses returned
     * from action*() methods to application/json format and the default 
     * behavior for the REST verbs has been overriden to disable the 'delete'
     * and 'view' actions. 
     * 
     * @return void
     */
    public function behaviors()
    {
        $behaviors = [];

        $behaviors["contentNegotiator"] = [
            "class" => ContentNegotiator::class,
            "formats" => [
                "application/json" => Response::FORMAT_JSON
            ]
        ];

        $behaviors["verbFilter"] = [
            "class" => VerbFilter::className()
        ];
        
        $behaviors["corsFilter"] = [
            "class" => Cors::className()
        ];

        return $behaviors;
    }
    
    /**
     * Action Index
     * 
     * This action defines the workflow for selecting the products from the 
     * `products` table in the database with the Product model. Since sorting,
     * filtering or searching of data is not a requirement; this method simply 
     * calls the find method and selects all of the records from the table. 
     * 
     * @return void
     */
    public function actionIndex()
    {
        return Product::find()->all();
    }
    
    /**
     * Action Name
     * 
     * This action defines the workflow for searching for a product by name.
     * This is used in the AddProduct.vue component on the front-end to confirm
     * whether a given sku has been taken or is available during validation.
     * 
     * @param string $name
     * @return void
     */
    public function actionName()
    {
        $name = \Yii::$app->request->getQueryParam("name");
        
        if(!isset($name) || $name === "") {
            $this->response->statusCode = 400;
            return "Missing name parameter from query string.";
        }
        
        $product = Product::find()
                          ->where(["sku"=>$name])
                          ->one();
        
        if($product == null) {
            $this->response->statusCode = 204;
        } else {
            $this->response->statusCode = 400;
        }
        
        return $product;
        
    }

    /**
     * Action Create
     * 
     * This method defines the workflow for adding a new product record to the
     * `product` table in the database. Appropriate responses are generated and
     * returned for evaluating the request method, body of the request and
     * validation of the required fields for processing the data.
     * 
     * @return void
     */
    public function actionCreate()
    {

        /**
         * Check request type is POST.
         */
        if(!$this->request->isPost) {
            $this->response->statusCode = 400;
            return "Invalid request method.";
        }
        
        /**
         * Hydrate model with data.
         */
        $rawRequest = \Yii::$app->request->rawBody;
        if(empty($rawRequest) || !$rawRequest) {
            $this->response->statusCode = 400;
            return "Request body may not be empty.";
        }
        
        $post = json_decode($rawRequest);
        
        /**
         * Perform validation.
         */
        $model = new Product();
        
        $model->sku = $post->sku;
        $model->attributes = $post->attributes;
        
        /**
         * Set validation errors to response.
         */
        if(!$model->validate()) {
            $this->response->statusCode = 200;
            return $model->errors;
        }
        
        /**
         * Attempt to save.
         */
        if(!$model->save()) {
            $this->response->statusCode = 500;
            return "Failed to create product.";
        }
        
        $this->response->statusCode = 201;
        return $model->id;
        
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(($model = Product::findOne(["id" => $id])) !== null)
        {
            return $model;
        }

        throw new NotFoundHttpException("The requested page does not exist.");
    }

    public function response($message = "Successfully completed request.", bool $status = true, $data = null, $code = 200)
    {

        $resp = [
            "status"  => $status,
            "message" => $message
        ];

        if($data)
        {
            $thirdParamName = ($status ? "data" : "error");
            if(is_array($data))
            {
                $resp[ $thirdParamName ] = $data;
            }
            else
            {
                $resp[ $thirdParamName ] = $data;
            }
        }

        return $this->asJson($resp);
    }

}
