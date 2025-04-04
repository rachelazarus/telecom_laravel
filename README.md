Prerequisites
Before installing Laravel, ensure you have the following installed:

Composer  https://getcomposer.org/download/

Git (optional but recommended)  https://git-scm.com/downloads

PHP with SQLite extension enabled. https://www.php.net/manual/en/install.php


Step 1: Install Laravel via Composer
  run "composer global require laravel/installer
      "echo %PATH%"

Step 2: Create new project.
  run "laravel new projectname"
      "cd projectname"

Step 3: Update .env database settings to suite sqlite(used fro this project)
  <--Uncomment sqlite configaration-->

Step 4: Run migration
  run "php artisan migrate"

Step 5: Run project.
  run "php artisan serve"



