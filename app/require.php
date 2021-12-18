<?php

require_once 'libraries/Core.php';
require_once 'libraries/Controller.php';
require_once 'libraries/Database.php';

require_once 'models/User.php';

require_once 'modules/sendMail.php';
require_once "modules/pdfMaker/vendor/tecnickcom/tcpdf/tcpdf.php";
require "modules/pdfMaker/vendor/autoload.php";
require "models/customPdfGenerator.php";



require_once 'helpers/session_helper.php';
require_once 'helpers/ValidateOperator.php';
require_once 'helpers/IValidator.php';
require_once 'helpers/UserValidator.php';
require_once 'helpers/LoginValidator.php';
require_once 'helpers/SignupValidator.php';
require_once 'helpers/changePswValidator.php';
require_once 'helpers/EditProfileValidator.php';

require_once 'config/config.php';

$init = new Core();

?>