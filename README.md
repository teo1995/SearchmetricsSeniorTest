# SearchmetricsSeniorTest

# Requirements
PHP >= 7.1 and Composer in whichever flavor (installed locally, mounted into a VM, via Docker, ...)

# Tasks
  - Tasks marked with [x] are expected to be completed

  - Tasks marked with [o] are optional, but appreciated if completed

  - Tasks marked with [.] are bonuses
# What is a URL ID?
A URL ID is a bigint value calculated from an URL string, using the following statement in SQL:

> SELECT CAST(CONV(SUBSTRING(SHA1("http://google.de/hh"), 1, 16), 16, 10) AS SIGNED);
/* => 10996426193249918095 */

  - **[x]** Implement the missing code to make the tests run successfully
  - **[x]** Provide and implement at least one (1) other implementation of the UrlIdGenerator interface able to generate the same IDs, also including tests
  - **[o]** Provide a runnable environment of some kind (VM, Docker) in which the tests are still running successfully
  - **[o]** Extend the environment to be able to run an integration test with your implementation against it and write that integration test
  - **[.]** Extend the environment further with a small HTTP service allowing consumers to look up the URL IDs for a list URLs they provide
  - **[.]** That service should probably not always re-calculate those IDs on the fly, so implement a caching layer of some fashion

# Readme
Steps:
- Install Docker environment
- Open IDE and clone repository (PHPStorm used)

Run this commands with console:
1. docker-compose build
2. docker-compose up -d
3. docker exec -it symfony-php-fpm sh -c "composer install" -d
4. docker exec -it symfony-php-fpm sh -c "bin/console doctrine:migration:migrate" -d
5. docker exec -it symfony-php-fpm sh -c "./vendor/bin/phpunit" -d

- Use Postman for testing REST api or you can use following commands in console:

POST example
 - **Add url and generate id:** 
 curl --data "url=http://http://www.spiegel.de?int=1" http://localhost:8082/api/url
 
GET example
 - **Fetch all url-s and id-s:** 
 curl -X GET http://localhost:8082/api/url
 
 - **Fetch list of url-s and id-s:** 
 curl -X GET http://localhost:8082/api/urls?id=1,2
 
PUT example
 - **Update url and create and set id:** 
 curl -X PUT -d "url=http://www.persona.de/fuer-bewerber/" http://localhost:8082/api/url/1
 
DELETE example
 - **Delete url from database:** 
 curl -X DELETE http://localhost:8082/api/url/1
 
