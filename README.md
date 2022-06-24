# SSO SAML DEMO project

A project to demo SSO use of simpleSAMLphp application. 

## Features

- Demo the SAML SSO login.
- Use the https://samltest.id/ test ID.
- Reviewer can write reviews on any restaurants in the list and give rating along with the review.
- Owners can create restaurants and only see restaurants which they have created.
- Owners can see the user reviews and relpay to them.
- Admin User can edit/delete all users, restaurants, comments, and reviews

## Requirements

* PHP 7.2+
* simpleSAMLphp 1.19+
* Apache with mod_rewrite

## Quick start

Quick way to get this project up and running:

- Clone the repo: `git clone https://git.toptal.com/screening/Thanga-Senthil-Rajan-Vivakaran.git`
- Install required PHP package: `composer install`
- Copy the config and metadata from the template
````
cp -r vendor/simplesamlphp/simplesamlphp/config-templates/ config
cp -r vendor/simplesamlphp/simplesamlphp/metadata-templates/ metadata
````
- Update the config depending on your environment - /config/config.php.
- Update/Add the Auth source depending on your environment - /config/authsources.php.
- Update the certificates used for IDP communication - /cert/idp.crt & /cert/idp.pem.

## License

The MIT License (MIT).