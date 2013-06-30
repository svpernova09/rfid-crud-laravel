<?php
function __autoload($class_name) {
    require_once(dirname(__FILE__) . '/../classes/' . $class_name . '.php');
}
?>