<?php
// -----
// observer class used to optimize product images when requested by the website
// Copyright (C) 2020, ZenExpert
// improvements by DrByte 01/2020
//
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

class zcObserverZxOptimizedImages extends base {

    public function __construct() 
    {
        if(ZX_OPTIMIZED_IMAGES_ENABLED == 'on') {
            $this->attach(
                $this,
                array(
                    'NOTIFY_OPTIMIZE_IMAGE',
                )
            );
        }
    }

    function updateNotifyOptimizeImage(&$class, $eventID, $template_dir, &$src, &$alt, &$width, &$height, &$parameters) {
        $src = zx_optimized_images($src, $width, $height);
    }
}
