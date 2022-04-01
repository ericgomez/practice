<?
error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE); // Ignore repeated errors, always use TRUE

ini_set('display_errors', FALSE); // Error/Exception display, use FALSE only in production environment

ini_set('log_errors', TRUE); // Error/Exception file logging.

error_log('Hello, world!'); // Logging to file

require_once('libs/database.php');

require_once('libs/controller.php');
require_once('libs/model.php');
require_once('libs/view.php');
require_once('libs/app.php');
// session controller required of the views
require_once('classes/session.controller.php');

require_once('config/config.php');

include_once 'models/user.model.php';
include_once 'models/customer.model.php';

$app = new App();
