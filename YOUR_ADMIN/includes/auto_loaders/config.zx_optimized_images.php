<?php
// -----
// Admin-level auto-loader for ZX Optimized Images
//
if (!defined ('IS_ADMIN_FLAG')) {
    die ('Illegal Access');
}

$autoLoadConfig[200][] = array (
    'autoType'  => 'class',
    'loadFile'  => 'observers/zx_optimized_images.php',
    'classPath' => DIR_WS_CLASSES
);
$autoLoadConfig[200][] = array (
    'autoType'   => 'classInstantiate',
    'className'  => 'zx_optimized_images',
    'objectName' => 'zx_optimized_images'
);

$autoLoadConfig[200][] = array (
    'autoType' => 'init_script',
    'loadFile' => 'init_zx_optimized_images_install.php'
);