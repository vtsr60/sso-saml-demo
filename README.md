# SSO SAML DEMO project

A project to demo SSO use of SimpleSAMLphp application. 

## Features

- Demo the SAML SSO login using the SimpleSAMLphp in composer context.
- Quick start guide to setup SimpleSAMLphp for remote IDP.

## Requirements

* PHP 7.2+
* simpleSAMLphp 1.19+
* Apache with mod_rewrite

## Quick start

Quick way to get this project up and running:

- Clone the repo: `git clone https://github.com/vtsr60/sso-saml-demo.git`
- Install required PHP package: `composer install`
- Copy the config and metadata from the template.
````
cp -r vendor/simplesamlphp/simplesamlphp/config-templates/ config
cp -r vendor/simplesamlphp/simplesamlphp/metadata-templates/ metadata
````
- Create certificate and key for the IPD setup.
````
openssl req -newkey rsa:3072 -new -x509 -days 3652 -nodes -out cert/idp.crt -keyout cert/idp.pem
````
- Configure the SimpleSAMLphp.
  * Setup the 'baseurlpath' in config/config.php. This should be something like https://[domain/alias]/simplesaml.
  * Generate hashed password for SimpleSAMLphp administrator account `php bin/pwgen.php` and update 'auth.adminpassword' in config/config.php.
  * Generated a random string to be used as secret salt `tr -c -d '0123456789abcdefghijklmnopqrstuvwxyz' </dev/urandom | dd bs=32 count=1 2>/dev/null;echo` and update 'secretsalt' in config/config.php.
  * Setup the 'technicalcontact_name' and 'technicalcontact_email' in config/config.php.
  * Setup the 'timezone' in config/config.php.
  * Change the 'certdir' in config/config.php to '../../../cert/'.
- Copy the config and metadata changes to the SimpleSAMLphp under vendor: `composer install`
- Go to https://[domain/alias]/simplesaml and Login as administrator.
  ![Login as administrator](docs/screenshots/Login%20as%20administrator.png)
- Parse Federation IDP metadata XML file to generate IDP settings by going to Federation > click on 'XML to SimpleSAMLphp metadata converter'.
  ![Go to XML Parser](docs/screenshots/Go%20To%20XML%20parser.png)
  ![Copy or upload Federation IDP metadata XML](docs/screenshots/Copy%20or%20upload%20xml.png)
  ![Parse Federation IDP metadata XML](docs/screenshots/Parser%20the%20IPD%20xml.png)
- Copy the 'saml20-idp-remote' metedata setting to bottom of metadata/saml20-idp-remote.php. 
- Add the Auth source in /config/authsources.php just above the 'default-sp'.
````
	'[service provider nane]-sp' => array(
		'saml:SP',
		'entityID' => null,
		'idp' => '<Entity ID of the IDP from metadata/saml20-idp-remote.php>',
		'discoURL' => null,
		'sign.logout' => TRUE,
		'SignLogoutRequest' => TRUE,
		'SignLogoutResponse' => TRUE,
		'redirect.sign' => TRUE,
		'assertion.encryption' => TRUE,
		'privatekey' => 'idp.pem',
		'certificate' => 'idp.crt',
		'signature.algorithm' => 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256'
	),

````
- Copy the config and metadata changes to the SimpleSAMLphp under vendor: `composer install`
- Download the new service provided metadata XML by going to url https://[domain/alias]/simplesaml/module.php/saml/sp/metadata.php/[service provider nane]-sp.
  ![Download SP metadata XML](docs/screenshots/Download%20sp%20metadata%20xml.png)
- Send the service provided metadata XML to the IDP vendor to upload to IDP.
- Test the authentication with service provided config by going to Authentication > click on link 'Test configured authentication sources'. Pick the [service provider nane]-sp.
  ![Test authentication](docs/screenshots/Test%20configuration%20Authentication.png)
  ![Pick the correct SP](docs/screenshots/Click%20on%20service%20provider.png)
- On successful login, claims from the IPD are shown
  ![Success Login](docs/screenshots/Success%20Login.png)

## Useful resources
- https://samltest.id/ - Service can be used as test IDP provider.
- https://addons.mozilla.org/en-US/firefox/addon/saml-tracer/ - Firefox extension to trace SAML flow

## License

The MIT License (MIT).