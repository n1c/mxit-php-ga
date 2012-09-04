# A simple PHP wrapper for server side Mxit Google Analytics

I've stripped down Google's server side PHP example code to be a lot simpler & asynchronous. The Google code makes you jump through a lot of hoops, creating a fake gif, relying on a cookie etc.

This code just skips all that and does a curl.

## Notes:
* The code requires that your server can run curl from the command line.
* Make sure that the $account_id you pass to the function is the mobile version, starting with "MO-".

## Usage example:

````PHP
require_once("./Ga.php");
Ga::hit("MO-XXXXXX");
````
