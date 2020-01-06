<?php
// -----
// Admin-level observer class used to optimize product images when added in the admin
// Copyright (C) 2020, ZenExpert
//
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true) {
    die('Illegal Access');
}

class zx_optimized_images extends base
{
    public function __construct() 
    {
        if(ZX_OPTIMIZED_IMAGES_ENABLED == 'on') {
            $this->attach(
                $this,
                array(
                    'NOTIFY_ADMIN_PRODUCT_IMAGE_UPLOADED',

                )
            );
        }
    }
  
    public function update(&$class, $eventID, $p1, &$p2, &$p3, &$p4) 
    {
        switch ($eventID) {
            // -----
            // Issued during adding or updating a product
            //
            // $p1 ... $products_image
            // $p2 ... $products_image_name
            //
            case 'NOTIFY_ADMIN_PRODUCT_IMAGE_UPLOADED':
                $full_image = $p1->destination . $p1->filename;
                zx_optimized_images($full_image);
                break;

            default:
                break;
        }
    }
}