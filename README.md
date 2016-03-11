IMS-API
=======
 - PHP >=5.5.9
 - Symfony 2.7 LTS (Supported until May 2019)
     - Major Bundles:
        - friendsofsymfony/rest-bundle
        - jms/serializer-bundle
        - nelmio/api-doc-bundle
 - Doctrine 2.4
 - MySQL  


**Dependencies are managed by Composer**  
If Composer is not installed, read the installation instructions available at:  

- **Unix/OSX:** <https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx>  
- **Windows:** <https://getcomposer.org/doc/00-intro.md#installation-windows>

It is recommended that you install Composer globally. If you prefer not to, you can download the composer.phar file and run that in place of the global `$ composer` command.

Installation
============
1. Clone this repository from Bitbucket to your desired installation path.
    - `git clone git@bitbucket.org:nspyke/ims-api.git`

2. All the following commands will assume you are in the root project folder.
    - eg: `cd /var/www/ims-api`

3. Install the project dependencies
    - `composer install`

4. Copy, rename and edit the parameters.yml.dist file to match the environment
    - `cp app/config/parameters.yml.dist app/config/parameters.yml`
    - Edit the file using your favourite editor
        - Vim: `vim app/config/parameters.yml`
        - NANO: `nano app/config/parameters.yml`
    - Change the parameters to match the environment config, including creating a random string for the secret.

5. Create the database by running
    - `php app/console doctrine:database:create`

6. Create the database schema by running
    - `php app/console doctrine:schema:create`

7. **DEVELOPMENT ENVIRONMENTS ONLY**  
   Generate some test fixtures by running  
   `php app/console doctrine:fixtures:load`



Automated Testing
=======
Performed using Behat.  
Run the tests by executing
```
$ bin/behat
```
on the console.

API Documentation
=================
Automatically generated using the Symfony bundle NelmioApiDocs.
View the docs in your browser by going to:
```
http://<the-project-domain>/api/doc
```

Swagger.io documentation has also been enabled. CORS has *not* been enabled.
Use the following URL:
```
http://<the-project-domain>/api/doc/swagger
```

Using the API
=============
 - [RTFM](http://en.wikipedia.org/wiki/RTFM) the API documentation described above.
 - JSON is the primary and preferred format for communication.
 - **ALL JSON** requests must use the header `Content-Type: application/json`.
 - When performing POST, PUT and PATCH:
    - Form data must be sent as valid JSON in the request body
    - The JSON must contain the form name as the top level property  
      For example:  
      
```
{
    "vehicle" : {
        "vin": "vin1234",
        "odometer": 10000,
        "manufacturer": 2,
        "model": 4,
    }
}
```

 - Translatable content is available through the `Accept-Language` request header.
 To translate some content, send a PATCH request with the header and the new content.







