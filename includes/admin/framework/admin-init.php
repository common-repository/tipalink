<?php
// Load the embedded Redux Framework
if (file_exists(dirname(__FILE__).'/redux-framework/ReduxCore/framework.php')) {
    require_once( dirname(__FILE__).'/redux-framework/ReduxCore/framework.php' );
}
// Load the theme/plugin options
if (file_exists(dirname(__FILE__).'/tipalink-config.php')) {
    require_once( dirname(__FILE__).'/tipalink-config.php' );
}
