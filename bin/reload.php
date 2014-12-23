<?php

require __DIR__ . '/base.php';

cmdRun("Drop database", "app/console doctrine:database:drop --force");
cmdRun("Create database", "app/console doctrine:database:create");
cmdRun("Create scheme", "app/console doctrine:schema:create");
cmdRun("Install assets", "app/console assets:install");
// Adding fixtures: php app/console doctrine:fixtures:load
