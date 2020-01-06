<?php
// -----
// observer class used to optimize product images when requested by the website
// Copyright (C) 2020, ZenExpert
//
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

class zx_optimized_images extends base {

    private $_img = '';

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

    /*
     * $p1 = $template_dir
     * $p2 = $src
     * $p3 = $alt
     * $p4 = $width
     * $p5 = $height
     * $p6 = $parameters
     */
    public function update(&$class, $eventID, &$p1, &$p2, &$p3, &$p4, &$p5, &$p6) {
        switch ($eventID) {
            /*
             * $p1 = $template_dir
             * $p2 = $src
             * $p3 = $alt
             * $p4 = $width
             * $p5 = $height
             * $p6 = $parameters
             */
            case 'NOTIFY_OPTIMIZE_IMAGE':
                $this->notifyZXOptimizedImages($class, $eventID, $p2, $p4, $p5);
                break;

            default:
                break;
        }
    }

    function notifyZXOptimizedImages(&$class, $eventID, &$src, &$width, &$height){
        $src = zx_optimized_images($src, $width, $height);
    }
}