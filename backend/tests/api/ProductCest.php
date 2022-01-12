<?php

use app\models\Product;

/**
 * Product Cest
 * 
 * This is an API test which basically sends a bunch of GET and POST requests
 * to the configured endpoint and asserts on the responses received.
 * The purpose is to check that all the endpoints in the ProductController are
 * working as expected.
 * 
 * For this to work the codeception/module-rest must be included in the project.
 */
class ProductCest
{
    
    /**
     * Before Hook
     * 
     * The code in this hook will be executed each time a test case is run.
     * 
     * @param ApiTester $I
     */
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
    }

    /**
     * Test Product Index 
     * 
     * Sends a GET request to the /product endpoint, expecting a JSON array of
     * product objects. 
     * 
     * @param ApiTester $I
     */
    public function testProductIndex(ApiTester $I)
    {
        
        $I->sendGet('/product');
       
        /**
         * Assert on the response code, content type and the message.
         */
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
//        $I->seeResponseContains();
        
    }
    
    /**
     * Test Product Create Valid
     * 
     * Sends a POST request to the endpoint to create a new product with
     * valid parameters.
     * 
     * @param ApiTester $I
     */
    public function testProductCreateValid(ApiTester $I)
    {
//        $expected = "";
        // we're expecting an integer value in the response, which is the 
        // ID of the newly created product record. 
               
        $data = [
            "sku" => "abc" . uniqid(),
            "attributes" => [
                "att1" => "1",
                "att2" => "2",
                "att3" => "3"
            ]
        ];
        
        $I->sendPost('/product/create', json_encode($data));
       
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $response = $I->grabDataFromResponseByJsonPath("[*]");
                
       
        /**
         * Check if valid record in table.
         */
        $id = $response[0];
        $I->comment("Checking DB `product` table for record with ID=" . $id);
        if(is_integer($id)) {
            $I->comment("Successfully created product with ID=" . $id);
        }
        
    }
    
    /**
     * Test Product Create Invalid Empty Request
     * 
     * Sends a POST request to the endpoint to create a product, expecting
     * an error message in the response.
     * 
     * @param ApiTester $I
     */
    public function testProductCreateInvalidEmptyRequest(ApiTester $I)
    {
        
        $expected = "Request body may not be empty.";
        
        $I->sendPost('/product/create');
       
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains($expected);
        
    }
    
    /**
     * Test Product Create Invalid Empty Request
     * 
     * Sends a POST request to the endpoint to create a product, expecting
     * an error message in the response.
     * 
     * @param ApiTester $I
     */
    public function testProductCreateInvalidSkuAlreadyTaken(ApiTester $I)
    {
        
        $expected = "Request body may not be empty.";
        
        $data = [
            "sku" => "abc",
            "attributes" => [
                "att1" => "1",
                "att2" => "2",
                "att3" => "3"
            ]
        ];
        
        $I->sendPost('/product/create', json_encode($data));
       
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains('');
        
    }
    
}
