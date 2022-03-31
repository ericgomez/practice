<?php

require_once('libs/database.php');

require_once('libs/controller.php');
require_once('libs/model.php');
require_once('libs/view.php');
require_once('libs/app.php');
// session controller required of the views
require_once('classes/session.controller.php');

require_once('config/config.php');

include_once 'models/customer.php';

$app = new App();
