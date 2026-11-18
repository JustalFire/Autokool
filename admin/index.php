<?php
session_start();
require_once('../inc/Database.php');

include_once("modelAdmin/modelAdmin.php");
include_once("modelAdmin/modelAdminCourse.php");
include_once("modelAdmin/modelAdminCategory.php");

include_once("controllerAdmin/controllerAdmin.php");
include_once("controllerAdmin/controllerAdminCourse.php");

include_once("routeAdmin/routingAdmin.php");

echo $response ?? '';
?>
