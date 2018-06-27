<?php

use Saito\Event\SaitoEventManager;
use Siezi\SaitoNsfwBadge\Lib\NsfwBadgeRenderer;

//= don't activate on CLI-tests
if (php_sapi_name() === 'cli') {
    return;
}

SaitoEventManager::getInstance()->attach(new NsfwBadgeRenderer());
