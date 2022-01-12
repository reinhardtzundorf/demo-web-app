# demo-web-app

## SETUP

1. Clone the Git repository on your local:

    `git clone git@github.com:/reinhardtzundorf/demo-web-app.git`

3. Setup the DB with the database .sql/SQL script provided in the `db` folder.

   - Open your GUI DB management tool for MySQL or use the CLI:
      mysql -u'user' -p'pass'

   - If you are in the context of the demo-web-app folder, then you may simply issue this command:
      \. db/s2shopdb.sql
     
     NB: please note that if you have a DB named `s2shop`, then you will not have one anymore after running the script. 

3. Setup the backend and start the backend and frontend apps. 
    
   - Run the command: 
   
    ./start.sh 
    
   - from the demo-web-app folder

     This should install all required PHP dependencies (the Yii framework) as well as start the built-in CLI web server 
     and do the same for the Vuejs app.

4. IF STEP 3 DID NOT WORK:

   - Change to the backend directory (cd backend)
   - Run composer install
   - Change to the web root/web directory of the project
   - Run php -S localhost:8080 &

   - Change to the frontend directory (cd ../frontend/)
   - Run npm install (or yarn install, depending on which package manager you have installed)
   - Run npm run dev (or yarn serve, "" "")
   - Open the URL in your browser.

5. You may run the tests for the API by changing to the backend directory (cd backend)
   - Run composer install
   - Setup the DB as per step 2.
   - Run ./vendor/bin/codecept run api tests/api

6. OR, just run 
   - ./tests.sh 
   - from the demo-web-app folder.
