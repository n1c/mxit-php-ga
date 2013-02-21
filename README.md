# A simple PHP wrapper for server side Mxit Google Analytics


# Original (n1c)
I've stripped down Google's server side PHP example code to be a lot simpler & asynchronous. The Google code makes you jump through a lot of hoops, creating a fake gif, relying on a cookie etc.

This code just skips all that and does a curl.

# Forked (darrynten)
Removed the exec() and used php curl instead

## Notes:
* The code requires that your server can run curl from the command line.
* Make sure that the $account_id you pass to the function is the mobile version, starting with "MO-".
* FORKED: I have found that I lose geodata with MO- but seem to get some geodata using UA-
* FORKED: This method will most likely lose geodata, as the call comes from your server and not the user
* Mxit does not support gifs, which is why the usual way (image) doesn't work

## Usage example:

````PHP
require_once("./Ga.php");
Ga::hit("MO-XXXXXX");
````
