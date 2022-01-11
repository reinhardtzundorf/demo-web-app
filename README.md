# demo-web-app

Stock2Shop Technical Assessment (demo web app).


## Setup

1. Clone the Git repository on your local:

    `git clone git@github.com:/reinhardtzundorf/demo-web-app.git`
    
2. Alternatively, you will need to build the Vuejs app by opening a terminal and changing to the directory where the package.json file lives and executing the following commands:       
    
  a. Execute the following commands from the frontend folder:
      
       `npm install (or yarn install)`
  
  b. Copy the `dist` folder from the project's root directory which was generated in step 3. 

  c. Paste the folder into the web root folder which is being served on your local environment. 

  d. To configure the backend application, you need to run the following command in the root of the api folder:

        `composer install`

  e. Use the ./start.sh bash script to start the PHP CLI web server. It runs on port 8080.
    
  e. Configure the config/db.php file to match the root user's details on your local MySQL Server instance.
  
  f. Change to the db folder in the root of the repo and open your local MySQL CLI:
  
       `mysql -uroot -p'pa$$sword'`
        
  g. Run the following commands from the CLI tool:
      
        `\. db\s2sdb.sql` 

     NB: The script will drop any database matching the name of s2shopdb
  
  h. In a terminal, change to the tests directory and execute the following command:

        `php ../vendor/bin/codecept run api`
    
  i. The tests are configured to run off a specific port and hostname - change this (you will have to if you didn't use the docker-compose.yml option):
  
  j. Edit the codeception.yml file in the tests directory of the api project folder. 
   


# PROJECT SPECIFICATION

## REQUIREMENTS

Build a web app consisting of the following layers:

1. Back-end RESTful API Application.
2. MySQL Database.
3. JavaScript front-end application.
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
Uri: /products
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
- sku must be unique.

## WORK BREAKDOWN STRUCTURE

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
     created_at
7.  Add dummy data. 
8.  Generate product model. 
9.  Generate product controller. 
9.  Override the fields() config in the Product model to include the attributes columnn for each product by default.
10. Remove created_at and ID field from the display columns.
11. Configure controller actionIndex() to output the products at the /products endpoint.
12. Match output as per spec. 
13. Add actionCreate() for POST requests only.
14. Add API tests for both actions and the /products endpoint.
    - Create product with valid values success
    - Create product with invalid values failure
    - List products 
17. Restrict the fields() config in the ProductAttribute and Product model classes to remove the primary key (id) column. 
18. Configure ProductController.
    - override behaviors() and unset the delete and put methods.
    - override behaviors and add the JSON contentNegotiator filter. 
    - add CORS filter to allow cross-origin requests (necessary for the docker dev environment).


### FRONTEND APP

1.  Use the vue-cli command to create a new blank vue project.
2.  yarn add axios bootstrap-vue vue-router 
3.  Edit the App.vue file and add two components:
      a. ListProducts.vue
      b. ViewProduct.vue
      c. AddProduct.vue
4.  Create router.js file and import in main.js and configure in the vue app instance ("vm").
5.  Add three routes to the router.js file and pass them to the VueRouter() constructor. 
6.  Test routes.
7.  The endpoints must be called in the mounted() hook for ListProducts and ViewProduct components:
      a. /products GET
      b. /products/:product_id GET
8.  For the AddProduct component the /products endpoint will receive a POST request 
9.  JSON body containing all fields and attributes for a Product entity as per the backend APIs rules() configured in the Product.php model.
