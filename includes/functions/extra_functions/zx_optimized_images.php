<?php
// BOF ZenExpert optimized images
?>
<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// TO DO - move max image width and height to admin
if(!defined('ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_WIDTH')) define('ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_WIDTH', '1000');
if(!defined('ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_HEIGHT')) define('ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_HEIGHT', '1000');

function zx_optimized_images($src, $width, $height) {
    global $db;

    $resize = false;
    $fileinfo = pathinfo($src);
    $name = $fileinfo['filename'];
    $ext = $fileinfo['extension'];

    // create directory with first letter
    if (!file_exists(DIR_IMAGES_OPTIMIZED . $name[0])) {
        mkdir(DIR_IMAGES_OPTIMIZED . $name[0], 0755, true);
    }

    $size = getimagesize($src);
    $w = $size[0];
    $h = $size[1];

    // TO DO - add admin switch to check if images should be optimized
    $requested_image = DIR_IMAGES_OPTIMIZED. $name[0].'/'.$name .'-'.$width.'x'.$height.'.'.$ext;
    if(!file_exists($requested_image)) {
        $resize = true;
    }

    // set target file name (first part)
    $target_base = DIR_IMAGES_OPTIMIZED . $name[0].'/'.$name.'-';

    if($resize && (zen_not_null($width) || zen_not_null($height))) {
       require_once(DIR_WS_CLASSES.'vendors/imageMagician/php_image_magician.php');
        $magicianObj = new imageLib($src);
        // largest image
        if ($w >= ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_WIDTH || $h >= ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_HEIGHT) {
            $dest = $target_base . ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_WIDTH . 'x' . ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_WIDTH, ZX_OPTIMIZED_IMAGES_LARGE_IMAGE_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // small image
        if ($w >= SMALL_IMAGE_WIDTH || $h >= SMALL_IMAGE_HEIGHT) {
            $dest = $target_base . SMALL_IMAGE_WIDTH . 'x' . SMALL_IMAGE_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // subcategory image
        if ($w >= SUBCATEGORY_IMAGE_WIDTH || $h >= SUBCATEGORY_IMAGE_HEIGHT) {
            $dest = $target_base . SUBCATEGORY_IMAGE_WIDTH . 'x' . SUBCATEGORY_IMAGE_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // shopping cart image
        if ($w >= IMAGE_SHOPPING_CART_WIDTH || $h >= IMAGE_SHOPPING_CART_HEIGHT) {
            $dest = $target_base . IMAGE_SHOPPING_CART_WIDTH . 'x' . IMAGE_SHOPPING_CART_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // category icon
        if ($w >= CATEGORY_ICON_IMAGE_WIDTH || $h >= CATEGORY_ICON_IMAGE_HEIGHT) {
            $dest = $target_base . CATEGORY_ICON_IMAGE_WIDTH . 'x' . CATEGORY_ICON_IMAGE_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(CATEGORY_ICON_IMAGE_WIDTH, CATEGORY_ICON_IMAGE_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // subcategory top image
        if ($w >= SUBCATEGORY_IMAGE_TOP_WIDTH || $h >= SUBCATEGORY_IMAGE_TOP_HEIGHT) {
            $dest = $target_base . SUBCATEGORY_IMAGE_TOP_WIDTH . 'x' . SUBCATEGORY_IMAGE_TOP_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(SUBCATEGORY_IMAGE_TOP_WIDTH, SUBCATEGORY_IMAGE_TOP_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // medium image
        if ($w >= MEDIUM_IMAGE_WIDTH || $h >= MEDIUM_IMAGE_HEIGHT) {
            $dest = $target_base . MEDIUM_IMAGE_WIDTH . 'x' . MEDIUM_IMAGE_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // product listing
        if ($w >= IMAGE_PRODUCT_LISTING_WIDTH || $h >= IMAGE_PRODUCT_LISTING_HEIGHT) {
            $dest = $target_base . IMAGE_PRODUCT_LISTING_WIDTH . 'x' . IMAGE_PRODUCT_LISTING_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // listing new
        if ($w >= IMAGE_PRODUCT_NEW_LISTING_WIDTH || $h >= IMAGE_PRODUCT_NEW_LISTING_HEIGHT) {
            $dest = $target_base . IMAGE_PRODUCT_NEW_LISTING_WIDTH . 'x' . IMAGE_PRODUCT_NEW_LISTING_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(IMAGE_PRODUCT_NEW_LISTING_WIDTH, IMAGE_PRODUCT_NEW_LISTING_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // products new
        if ($w >= IMAGE_PRODUCT_NEW_WIDTH || $h >= IMAGE_PRODUCT_NEW_HEIGHT) {
            $dest = $target_base . IMAGE_PRODUCT_NEW_WIDTH . 'x' . IMAGE_PRODUCT_NEW_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(IMAGE_PRODUCT_NEW_WIDTH, IMAGE_PRODUCT_NEW_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // listing featured
        if ($w >= IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH || $h >= IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT) {
            $dest = $target_base . IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH . 'x' . IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH, IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // listing all
        if ($w >= IMAGE_PRODUCT_ALL_LISTING_WIDTH || $h >= IMAGE_PRODUCT_ALL_LISTING_HEIGHT) {
            $dest = $target_base . IMAGE_PRODUCT_ALL_LISTING_WIDTH . 'x' . IMAGE_PRODUCT_ALL_LISTING_HEIGHT . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage(IMAGE_PRODUCT_ALL_LISTING_WIDTH, IMAGE_PRODUCT_ALL_LISTING_HEIGHT, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // requested size
        if ($w >= $width || $h >= $height) {
            $dest = $target_base . $width . 'x' . $height . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage($width, $height, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }

        // if requested size larger than actual image dimensions (extra small original image)
        if ($w <= $width || $h <= $height) {
            $dest = $target_base . $width . 'x' . $height . '.' . $ext;
            if(!file_exists($dest)) {
                $magicianObj->resizeImage($width, $height, 'auto');
                $magicianObj->saveImage($dest);
                resmushit($dest);
            }
        }
    }

   return $requested_image;
}

function resmushit($file) {
    // reSmush.it API
    $file = DIR_FS_CATALOG.$file;
    $mime = mime_content_type($file);
    $info = pathinfo($file);
    $name = $info['basename'];
    $output = new CURLFile($file, $mime, $name);
    $data = array(
        "files" => $output,
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://api.resmush.it/?qlty=80');
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        $result = curl_error($ch);
    }
    curl_close ($ch);

    $result_array = json_decode($result, true);

    unlink($file);

    file_put_contents($file, file_get_contents($result_array['dest']));

    return;
}

?>
<?php
// EOF ZenExpert optimized images
?>
