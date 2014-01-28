Pre-conditions:
******************

a) >= PHP 5.3.x  
b) curl must be enabled for CLI.


How to run the script in CLI?
*******************************

a) Download all the file in your local machine.

b)Run this script like mention below.

For Github
***************

$ php create_issue.php -u :username -p :password https://api.github.com/repos/:username/:repository "Issue Title" "Issue Description"

For Bitbucket
***************

$ php create_issue.php -u :username -p :password https://bitbucket.org/api/1.0/repositories/:username/:repository "Issue Title" "Issue Description"


Replace the following place holder:

:username=> Give original username of github/bitbucket.
:password=> Give original password of github/bitbucket.
:repository=> Give original repository name of github/bitbucket.
