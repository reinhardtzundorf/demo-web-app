# WORK BREAKDOWN STRUCTURE 

## REQUIREMENTS

Build a web app consisting of the following layers:

1. Back-end RESTful API Application.
2. MySQL Database.
3. JavaScript front-end application. (Vue)
4. The API app has one endpoint (in keeping the style and conventions) which allows client users to list, read and create products over HTTP. 
5. The following operations are to be implemented:

_List Products_

Method: GET
Uri: /products
Response: 
`
   [
       {
          "sku": "abc", 
          "attributes": {
            "size: "small",
            "grams": "100",
            "foo": "bar"
          }
       }
   ]
  `
  
_Add Product_

Method: POST
Uri: /products/create
Request: 
`
   [
       {
          "sku": "abc", 
          "attributes": {
            "size: "small",
            "grams": "100",
            "foo": "bar"
          }
       }
   ]
  ` 

## CONSTRAINTS

- All responses and requests will be in application/json format.
- No authentication or security has been requested so this will not be added.
- Attributes may be of variable items.
- Sku must be unique.
- Return appropriate responses for above API constraints.
- Configure CORS to allow the Vuejs app to send GET and POST requests to the ProductController.
- Disable the other actions.

### BACKEND / MYSQL DB

1.  Clone Yii2 Basic App Template.
2.  Configure the db.php file in config/.
3.  Make sure the default app page is showing and that the DB connection works. 
4.  Create the MySQL database table and save the CREATE TABLE statement.
5.  Create tables:
     - `product`                 // the products table 
6.  The columns:
     id int(11) NOT NULL PK A/I
     sku varchar(50) NOT NULL UNIQUE
     attributes JSON NOT NULL
     created_at TIMESTAMP NOT NULL
7.  Add dummy data. 
8.  Use gii to generate the classes:
    - Generate product model Product.php. 
    - Generate product controller/ProductController.php. 
9.  Override the fields() config in the Product model to include the attributes columnn for each product by default.
10. Remove created_at and ID field from the display columns.
11. Add a custom event to the model to generate the current timestamp value for the `created_at` column BEFORE inserting a new record.
11. Configure controller actionIndex() to output the products at the /products endpoint.
12. Match output as per spec. 
13. Add actionCreate() for POST requests only.
14. Add API tests for both actions and the /products endpoint.
    - Create product with valid values success
    - Create product with invalid values failure
    - Create product with sku already taken
    - List products 
15. Restrict the fields() config in the ProductAttribute and Product model classes to remove the primary key (id) column. 
16. Configure ProductController.
    - override behaviors() and unset the delete and put methods.
    - override behaviors and add the JSON contentNegotiator filter.
    - add CORS filter to allow cross-origin requests for http://localhost:8081, http://localhost:8082.


### FRONTEND APP

1.  Use the vue-cli command to create a new blank vue project.
2.  yarn add axios bootstrap-vue vue-router.
3.  Edit the App.vue file and add components:
      a. ProductList.vue
      b. ProductAdd.vue
4.  Add ProductControls.vue to serve as a sidebar nav menu. (instead of setting up VueRouter, due to the scope of the project.)
5.  The following axios services must be setup in products.service.js in services directory:
      a. getProducts()
         /products 
         GET
      b. createProduct()
         /products/create 
         POST 
         values from the form
6.  JSON body containing all fields and attributes for a Product entity as per the backend APIs rules() configured in the Product.php model.
7.  Add client side validation for the createProduct() request. Validate the form's data before the data is sent to the service layer.  
