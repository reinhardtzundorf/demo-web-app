# demo-web-app

Stock2Shop Technical Assessment (demo web app).


## Setup

1. Clone the Git repository on your local:

    `mkdir ~/tests && cd ~/tests
    git clone git@github.com:/reinhardtzundorf/demo-web-app.git`
    

2. Use docker-compose to automatically build and run the necessary containers (make sure you have docker running locally): 
   
   a. Run docker-compose up d
   b. Open your browser and navigate to 
   
      `http://frontend:8080/`
      
   c. You can access the back-end application at:
      
     `http://backend:8080/`
      
   d. A MySQL DB server (version 5.7) runs on port 3306 
  
   e. The containers are all on the same docker network
   
   f. Only the frontend and backend containers are exposed to the host machine.
   

3. Alternatively, you will need to build the Vuejs app by opening a terminal and changing to the directory where the package.json file lives and executing the following commands:       
    
  a. Execute the following commands from the frontend folder:
      
       `npm install (or yarn install)`
  
  b. Copy the `dist` folder from the project's root directory which was generated in step 3. 

  c. Paste the folder into the web root folder which is being served on your local environment. 

  d. To configure the backend application, you need to run the following command in the root of the api folder:

        `composer install`
    
  e. Configure the config/db.php file to match the root or administrator user's details on your local MySQL Server instance.
  
  f. Change to the db folder in the root of the repo and open your local MySQL CLI:
  
       `mysql -uroot -p'pa$$sword'`
        
  g. Run the following commands from the CLI tool:
      
        `CREATE DATABASE s2shop;
        USE s2shop;
        \. db.sql` 

  h. In a terminal, change to the tests directory and execute the following command:

        `php ../vendor/bin/codecept run api`
    
  i. The tests are configured to run off a specific port and hostname - change this (you will have to if you didn't use the docker-compose.yml option):
  
  h. Edit the codeception.yml file in the tests directory of the api project folder. 
   


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
2.  Change docker-compose.yml to add the frontend for later.
3.  Change docker-compose.yml to include a MySQL Server container.
4.  Add entry-point.sh bash script which will run after the MySQL container is up. 
5.  Change docker-compose.yml to include the three containers on the same network. 
6.  Configure the db.php file in config/.
7.  Make sure the default app page is showing and that the DB connection works. 
8.  Create the MySQL database tables and save them to the db foler in the db.sql file. 
9.  Create three tables:
    - `product`                 // the products table 
    - `attribute`               // the attribute types table
    - `product_attribute`       // junction table for attributes assigned to a product
10. Add product and product_attribute tables link on id -> product_id. [hasOne]
11. Each table will by default have a auto incrementing primnary key column which holds an integer (11) value.
12. Each product_attribute record will also have a product_id column which has a foreign key constraint. 
13. Run SQL script and debug.
14. Add dummy data. 
15. Use gii to generate the three models.
      Product
      Attribute
      ProductAttribute
16. Override the fields() config in the Product model to include the ProductAttribute relationship for each product by default.
17. Restrict the fields() config in the ProductAttribute and Product model classes to remove the primary key (id) column. 
18. Create ProductController class.
    - findModel().
    - override behaviors() and unset the delete and put methods.
    - override behaviors and add the JSON contentNegotiator filter. 
    - add CORS filter to allow cross-origin requests (necessary for the docker dev environment).
20. Implement actionIndex
21. Implement actionView
22. Implement actionCreate
23. Add codeception api tests.
24. Run tests and debug.

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
