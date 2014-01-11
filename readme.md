/*Created by: Ajit Singh
Date: 12/01/2014 */

Pre-conditions:
a) > PHP 5.3.x  
b) curl must be enabled for CLI.

How to run the script in CLI?

$ php create_issue.php -u :username -p :password https://api.github.com/repos/:username/:repository "Issue Title" "Issue Description"

Here change the following:

:username=> Give original username of github.
:password=> Give original password of github.
:repository=> Give original repository of github.