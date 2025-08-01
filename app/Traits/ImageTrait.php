<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    public function saveImage($requestImage, $for = '_product_', $save_to_db = false, $url = null, $token_id = null)
    {
        $extension = 'png';
        $mime_type = 'image/png';

        if ((! empty($requestImage) && $requestImage != 'null') || $url) {

            if (! $url) {
                $image     = explode('.', $requestImage->getClientOriginalName());
                $extension = strtolower($requestImage->getClientOriginalExtension());
                $name      = $image[0];
                $mime_type = $requestImage->getMimeType();
            }

            $storage           = setting('default_storage') != '' || setting('default_storage') != null ? setting('default_storage') : 'local';
            $response          = false;

            $content_type      = ['visibility' => 'public', 'ContentType' => $extension == 'svg' ? 'image/svg+xml' : $mime_type];
            $encode_percentage = $this->getEncodePercentage();
            if ($for == 'header1_hero_image1') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_240x240     = date('YmdHis').'image_240x240'.$for.rand(1, 500).'.'.$extension;
                $image_240x240_url = $directory.$image_240x240;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(630, 498, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_240x240_url, $encode_percentage);

                Image::make($requestImage)->resize(630, 498, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_240x240'  => $image_240x240_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } elseif ($for == 'unique_feature_image') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_714x300     = date('YmdHis').'image_714x300'.$for.rand(1, 500).'.'.$extension;
                $image_714x300_url = $directory.$image_714x300;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(714, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_714x300_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_714x300'  => $image_714x300_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } elseif ($for == 'header1_hero_image2') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_196x196     = date('YmdHis').'image_196x196'.$for.rand(1, 500).'.'.$extension;
                $image_196x196_url = $directory.$image_196x196;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(196, 196, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_196x196_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_196x196'  => $image_196x196_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } elseif ($for == 'header1_hero_image3') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_284x284     = date('YmdHis').'image_284x284'.$for.rand(1, 500).'.'.$extension;
                $image_284x284_url = $directory.$image_284x284;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(284, 284, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_284x284_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_284x284'  => $image_284x284_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } elseif ($for == 'qr_image') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_284x284     = date('YmdHis').'image_284x284'.$for.rand(1, 500).'.'.$extension;
                $image_284x284_url = $directory.$image_284x284;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(928, 954, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_284x284_url, $encode_percentage);

                Image::make($requestImage)->resize(928, 954, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_284x284'  => $image_284x284_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } elseif ($for == 'header1_hero_image4') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_212x212     = date('YmdHis').'image_212x212'.$for.rand(1, 500).'.'.$extension;
                $image_212x212_url = $directory.$image_212x212;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(212, 212, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_212x212_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_212x212'  => $image_212x212_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } elseif ($for == ' ') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_212x212     = date('YmdHis').'image_212x212'.$for.rand(1, 500).'.'.$extension;
                $image_714x300_url = $directory.$image_212x212;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(714, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_714x300_url, $encode_percentage);

                Image::make($requestImage)->resize(714, 447, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_714x300'  => $image_714x300_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } // Header2 hero image 1

            elseif ($for == 'header2_hero_image1') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_240x240     = date('YmdHis').'image_240x240'.$for.rand(1, 500).'.'.$extension;
                $image_240x240_url = $directory.$image_240x240;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(240, 240, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_240x240_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_240x240'  => $image_240x240_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } // Header2 Hero image 2 and 3

            elseif ($for == 'header2_hero_image2' || $for == 'header2_hero_image3') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_512x512     = date('YmdHis').'image_512x512'.$for.rand(1, 500).'.'.$extension;
                $image_512x512_url = $directory.$image_512x512;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(512, 512, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_512x512_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_512x512'  => $image_512x512_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } // Header2 hero image 4

            elseif ($for == 'header2_hero_image4') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_418x558     = date('YmdHis').'image_418x558'.$for.rand(1, 500).'.'.$extension;
                $image_418x558_url = $directory.$image_418x558;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(418, 558, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_418x558_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_418x558'  => $image_418x558_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } // Header3 hero image

            elseif ($for == 'header3_hero_image') {
                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_596x560     = date('YmdHis').'image_596x560'.$for.rand(1, 500).'.'.$extension;
                $image_596x560_url = $directory.$image_596x560;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(596, 560, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_596x560_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_596x560'  => $image_596x560_url,
                    'image_80x80'    => $image_80x80_url,
                ];
            } elseif ($for == 'cta_image') {

                $directory         = 'images/';
                File::ensureDirectoryExists('public/'.$directory, 0777, true);
                $originalImage     = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $originalImageUrl  = $directory.$originalImage;
                $movable_image     = $requestImage;
                $image_391x541     = date('YmdHis').'image_391x541'.$for.rand(1, 500).'.'.$extension;
                $image_391x541_url = $directory.$image_391x541;
                $image_80x80       = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_80x80_url   = $directory.$image_80x80;

                Image::make($requestImage)->resize(391, 541, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_391x541_url, $encode_percentage);

                Image::make($requestImage)->resize(80, 80, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images            = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_391x541'  => $image_391x541_url,
                    'image_80x80'    => $image_80x80_url,
                ];

            } elseif ($for == 'favicon' || $for == 'admin_favicon') {
                $originalImage        = 'favicon'.'.'.$extension;
                $image_16x16          = 'favicon'.'-16x16-'.'.png';
                $image_32x32          = 'favicon'.'-32x32-'.'.png';
                $image_57x57          = 'favicon'.'-57x57-'.'.png';
                $image_60x60          = 'favicon'.'-60x60-'.'.png';
                $image_72x72          = 'favicon'.'-72x72-'.'.png';
                $image_76x76          = 'favicon'.'-76x76-'.'.png';
                $image_96x96          = 'favicon'.'-96x96-'.'.png';
                $image_114x114        = 'favicon'.'-114x114-'.'.png';
                $image_120x120        = 'favicon'.'-120x120-'.'.png';
                $image_144x144        = 'favicon'.'-144x144-'.'.png';
                $image_152x152        = 'favicon'.'-152x152-'.'.png';
                $image_180x180        = 'favicon'.'-180x180-'.'.png';
                $image_192x192        = 'favicon'.'-192x192-'.'.png';

                //splash screen
                $splash_640x1136      = 'favicon'.'-640x1136-'.'.png';
                $splash_750x1334      = 'favicon'.'-750x1334-'.'.png';
                $splash_1242x2208     = 'favicon'.'-1242x2208-'.'.png';
                $splash_1125x2436     = 'favicon'.'-1125x2436-'.'.png';
                $splash_828x1792      = 'favicon'.'-828x1792-'.'.png';
                $splash_1242x2688     = 'favicon'.'-1242x2688-'.'.png';
                $splash_1536x2048     = 'favicon'.'-1536x2048-'.'.png';
                $splash_1668x2224     = 'favicon'.'-1668x2224-'.'.png';
                $splash_1668x2388     = 'favicon'.'-1668x2388-'.'.png';
                $splash_2048x2732     = 'favicon'.'-2048x2732-'.'.png';

                if ($for == 'admin_favicon') {
                    $directory = 'images/favicon/admin-panel/';
                } else {
                    $directory = 'images/favicon/website/';
                }

                File::ensureDirectoryExists('public/'.$directory, 0777, true);
                // File::ensureDirectoryExists(public_path($directory), 0777, true);

                $originalImageUrl     = $directory.$originalImage;
                $image_16x16_url      = $directory.$image_16x16;
                $image_32x32_url      = $directory.$image_32x32;
                $image_57x57_url      = $directory.$image_57x57;
                $image_60x60_url      = $directory.$image_60x60;
                $image_72x72_url      = $directory.$image_72x72;
                $image_76x76_url      = $directory.$image_76x76;
                $image_96x96_url      = $directory.$image_96x96;
                $image_114x114_url    = $directory.$image_114x114;
                $image_120x120_url    = $directory.$image_120x120;
                $image_144x144_url    = $directory.$image_144x144;
                $image_152x152_url    = $directory.$image_152x152;
                $image_180x180_url    = $directory.$image_180x180;
                $image_192x192_url    = $directory.$image_192x192;

                //splash screen
                $splash_640x1136_url  = $directory.$splash_640x1136;
                $splash_750x1334_url  = $directory.$splash_750x1334;
                $splash_1242x2208_url = $directory.$splash_1242x2208;
                $splash_1125x2436_url = $directory.$splash_1125x2436;
                $splash_828x1792_url  = $directory.$splash_828x1792;
                $splash_1242x2688_url = $directory.$splash_1242x2688;
                $splash_1536x2048_url = $directory.$splash_1536x2048;
                $splash_1668x2224_url = $directory.$splash_1668x2224;
                $splash_1668x2388_url = $directory.$splash_1668x2388;
                $splash_2048x2732_url = $directory.$splash_2048x2732;

                Image::make($requestImage)->save(isLocalhost().$originalImageUrl);

                Image::make($requestImage)->resize(
                    16,
                    16,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_16x16_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    32,
                    32,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_32x32_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    57,
                    57,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_57x57_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    60,
                    60,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_60x60_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    72,
                    72,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_72x72_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    76,
                    76,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_76x76_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    96,
                    96,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_96x96_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    114,
                    114,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_114x114_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    120,
                    120,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_120x120_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    144,
                    144,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_144x144_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    152,
                    152,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_152x152_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    180,
                    180,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_180x180_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    192,
                    192,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_192x192_url, $encode_percentage);

                Image::make($requestImage)->resize(
                    640,
                    1136,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_640x1136_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    750,
                    1334,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_750x1334_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    1242,
                    2208,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_1242x2208_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    1125,
                    2436,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_1125x2436_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    1125,
                    2436,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_1125x2436_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    828,
                    1792,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_828x1792_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    1242,
                    2688,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_1242x2688_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    1536,
                    2048,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_1536x2048_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    1668,
                    2224,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_1668x2224_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    1668,
                    2388,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_1668x2388_url, $encode_percentage);
                Image::make($requestImage)->resize(
                    2048,
                    2732,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$splash_2048x2732_url, $encode_percentage);

                $images               = [
                    'originalImage_url'    => $originalImageUrl,
                    'image_16x16_url'      => $image_16x16_url,
                    'image_32x32_url'      => $image_32x32_url,
                    'image_57x57_url'      => $image_57x57_url,
                    'image_60x60_url'      => $image_60x60_url,
                    'image_72x72_url'      => $image_72x72_url,
                    'image_76x76_url'      => $image_76x76_url,
                    'image_96x96_url'      => $image_96x96_url,
                    'image_114x114_url'    => $image_114x114_url,
                    'image_120x120_url'    => $image_120x120_url,
                    'image_144x144_url'    => $image_144x144_url,
                    'image_152x152_url'    => $image_152x152_url,
                    'image_180x180_url'    => $image_180x180_url,
                    'image_192x192_url'    => $image_192x192_url,
                    'splash_640x1136_url'  => $splash_640x1136_url,
                    'splash_750x1334_url'  => $splash_750x1334_url,
                    'splash_1242x2208_url' => $splash_1242x2208_url,
                    'splash_1125x2436_url' => $splash_1125x2436_url,
                    'splash_828x1792_url'  => $splash_828x1792_url,
                    'splash_1242x2688_url' => $splash_1242x2688_url,
                    'splash_1536x2048_url' => $splash_1536x2048_url,
                    'splash_1668x2224_url' => $splash_1668x2224_url,
                    'splash_1668x2388_url' => $splash_1668x2388_url,
                    'splash_2048x2732_url' => $splash_2048x2732_url,
                ];
            } elseif (
                $for == 'admin_mini_logo' || $for == 'admin_logo' || $for == 'copyright_logo' || $for == 'invoice_logo' || $for == 'light_logo' || $for == 'dark_logo' || $for == 'meta_image' || $for == 'og_image' || $for == 'popup_image' || $for == 'payment_method_banner'
            ) {

                $directory        = 'images/';

                File::ensureDirectoryExists('public/'.$directory, 0777, true);

                if ($for == 'admin_mini_logo' || $for == 'admin_logo') {
                    $image_100x36     = date('YmdHis').'-'.$for.'-100x36'.rand(1, 500).".$extension";
                    $image_100x36_url = $directory.$image_100x36;

                    $image_80x80      = date('YmdHis').'-'.$for.'-80x80'.rand(1, 500).'.'.$extension;
                    $image_80x80_url  = $directory.$image_80x80;

                    Image::make($requestImage)->resize(100, 36, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(isLocalhost().$image_100x36_url, $encode_percentage);

                    Image::make($requestImage)->resize(
                        80,
                        80,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    )->save(isLocalhost().$image_80x80_url);
                } elseif ($for == 'copyright_logo') {
                    $image_89x33     = date('YmdHis').'-'.$for.'-89x33'.rand(1, 500).'.'.$extension;
                    $image_89x33_url = $directory.$image_89x33;

                    Image::make($requestImage)->resize(165, 32, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(isLocalhost().$image_89x33_url, $encode_percentage);
                } elseif ($for == 'popup_image' || $for == 'meta_image' || $for == 'og_image') {
                    $image_80x80        = date('YmdHis').'-'.$for.'-80x80'.rand(1, 500).'.'.$extension;
                    $image_80x80_url    = $directory.$image_80x80;
                    $image_500x500      = date('YmdHis').'-'.$for.'-500x500'.rand(1, 500).'.'.$extension;
                    $image_500x500      = $directory.$image_500x500;
                    $image_1200x630     = date('YmdHis').'-'.$for.'-1200x630'.rand(1, 500).'.'.$extension;
                    $image_1200x630_url = $directory.$image_1200x630;

                    Image::make($requestImage)->resize(80, 80, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(isLocalhost().$image_80x80_url, $encode_percentage);

                    Image::make($requestImage)->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(isLocalhost().$image_500x500, $encode_percentage);

                    Image::make($requestImage)->resize(1200, 630, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(isLocalhost().$image_1200x630_url, $encode_percentage);
                } elseif ($for == 'light_logo' || $for == 'dark_logo') {
                    $image_138x52     = date('YmdHis').'-'.$for.'-138x52'.rand(1, 500).".$extension";
                    $image_138x52_url = $directory.$image_138x52;

                    Image::make($requestImage)->resize(165, 32, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(isLocalhost().$image_138x52_url, $encode_percentage);
                } elseif ($for == 'payment_method_banner') {
                    $image_138x52     = date('YmdHis').'-'.$for.'-138x52'.rand(1, 500).".$extension";
                    $image_138x52_url = $directory.$image_138x52;

                    Image::make($requestImage)->resize(2039, 129, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(isLocalhost().$image_138x52_url, $encode_percentage);
                } elseif ($for == 'invoice_logo') {
                    $image_100x36     = date('YmdHis').'-'.$for.'-100x36'.rand(1, 500).'.'.$extension;
                    $image_100x36_url = $directory.$image_100x36;

                    $image_80x80      = date('YmdHis').'-'.$for.'-80x80'.rand(1, 500).'.'.$extension;
                    $image_80x80_url  = $directory.$image_80x80;

                    Image::make($requestImage)->resize(
                        100,
                        36,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    )->save(isLocalhost().$image_100x36_url);

                    Image::make($requestImage)->resize(
                        80,
                        80,
                        function ($constraint) {
                            $constraint->aspectRatio();
                        }
                    )->save(isLocalhost().$image_80x80_url);
                }
                $originalImage    = date('YmdHis').'-'.$for.rand(1, 500).'.'.$extension;
                $imageSmallTwo    = date('YmdHis').'image_small_two'.$for.rand(1, 500).'.'.$extension;

                $originalImageUrl = $directory.$originalImage;
                $imageSmallTwoUrl = $directory.$imageSmallTwo;

                Image::make($requestImage)->save(isLocalhost().$originalImageUrl, $encode_percentage);

                Image::make($requestImage)->resize(
                    72,
                    72,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$imageSmallTwoUrl, $encode_percentage);

                $images           = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_80x80'    => $image_80x80_url    ?? '',
                    'image_500x500'  => $image_500x500      ?? '',
                    'image_100x36'   => $image_100x36_url   ?? '',
                    'image_1200x630' => $image_1200x630_url ?? '',
                ];
            } elseif ($for == '_staff_') {
                if ($url) {
                    $requestImage = $url;
                }

                $directory        = 'images/';

                File::ensureDirectoryExists(isLocalhost().$directory, 0777, true);

                $originalImage    = date('YmdHis').'-'.$for.rand(1, 500).'.'.$extension;
                $image80X80       = date('YmdHis').'image_80X80'.$for.rand(1, 500).'.'.$extension;
                $image40X40       = date('YmdHis').'image_40X40'.$for.rand(1, 500).'.'.$extension;
                $image1000X100    = date('YmdHis').'image_100X100'.$for.rand(1, 500).'.'.$extension;
                $image210X210     = date('YmdHis').'image_210X210'.$for.rand(1, 500).'.'.$extension;

                $originalImageUrl = $directory.$originalImage;
                $image80X80Url    = $directory.$image80X80;
                $image40X40Url    = $directory.$image40X40;
                $image100X100Url  = $directory.$image1000X100;
                $image210X210Url  = $directory.$image210X210;

                Image::make($requestImage)->save(isLocalhost().$originalImageUrl, $encode_percentage);
                Image::make($requestImage)->fit(40, 40)->save(isLocalhost().$image40X40Url, $encode_percentage);
                Image::make($requestImage)->fit(80, 80)->save(isLocalhost().$image80X80Url, $encode_percentage);
                Image::make($requestImage)->fit(100, 100)->save(isLocalhost().$image100X100Url, $encode_percentage);
                Image::make($requestImage)->fit(210, 210)->save(isLocalhost().$image210X210Url, $encode_percentage);

                $images           = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                    'image_40x40'    => $image40X40Url,
                    'image_80x80'    => $image80X80Url,
                    'image_100x100'  => $image100X100Url,
                    'image_210x210'  => $image210X210Url,
                ];
            } elseif ($for == 'single_file') {

                $directory        = 'images/';

                File::ensureDirectoryExists(isLocalhost().$directory, 0777, true);

                $originalImage    = date('YmdHis').'-'.$for.rand(1, 500).'.'.$extension;

                $originalImageUrl = $directory.$originalImage;

                Image::make($requestImage)->save(isLocalhost().$originalImageUrl, $encode_percentage, 'png');

                $images           = [
                    'storage'        => $storage,
                    'original_image' => $originalImageUrl,
                ];
            } else {
                $directory           = 'images/';

                File::ensureDirectoryExists(isLocalhost().$directory, 0777, true);

                $originalImage       = date('YmdHis').'_original_'.$for.rand(1, 500).'.'.$extension;
                $image_40x40         = date('YmdHis').'image_40x40'.$for.rand(1, 500).'.'.$extension;
                $image_68x48         = date('YmdHis').'image_68x48'.$for.rand(1, 500).'.'.$extension;
                $image_80x80         = date('YmdHis').'image_80x80'.$for.rand(1, 500).'.'.$extension;
                $image_190x230       = date('YmdHis').'image_190x230'.$for.rand(1, 500).'.'.$extension;
                $image_163x116       = date('YmdHis').'image_163x116'.$for.rand(1, 500).'.'.$extension;
                $image_295x248       = date('YmdHis').'image_295x248'.$for.rand(1, 500).'.'.$extension;
                $image_417x384       = date('YmdHis').'image_417x384'.$for.rand(1, 500).'.'.$extension;
                $image_thumbnail     = date('YmdHis').'image_thumbnail'.$for.rand(1, 500).'.'.$extension;

                $originalImageUrl    = $directory.$originalImage;
                $image_40x40_Url     = $directory.$image_40x40;
                $image_80x80_Url     = $directory.$image_80x80;
                $image_68x48_Url     = $directory.$image_68x48;
                $image_190x230_Url   = $directory.$image_190x230;
                $image_163x116_Url   = $directory.$image_163x116;
                $image_295x248_Url   = $directory.$image_295x248;
                $image_417x384_Url   = $directory.$image_417x384;
                $image_thumbnail_Url = $directory.$image_thumbnail;

                $movable_image       = $requestImage;

                Image::make($requestImage)->resize(
                    40,
                    40,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_40x40_Url, $encode_percentage);

                Image::make($requestImage)->resize(
                    80,
                    80,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_80x80_Url, $encode_percentage);

                Image::make($requestImage)->resize(
                    68,
                    48,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_68x48_Url, $encode_percentage);

                Image::make($requestImage)->resize(
                    190,
                    230,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_190x230_Url, $encode_percentage);

                Image::make($requestImage)->resize(
                    163,
                    116,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_163x116_Url, $encode_percentage);

                Image::make($requestImage)->resize(
                    297,
                    250,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_295x248_Url, $encode_percentage);

                Image::make($requestImage)->resize(
                    417,
                    384,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save(isLocalhost().$image_417x384_Url, $encode_percentage);

                $movable_image->move(isLocalhost().'images/', $originalImage);

                $images              = [
                    'storage'         => $storage,
                    'original_image'  => $originalImageUrl,
                    'image_40x40'     => $image_40x40_Url,
                    'image_80x80'     => $image_80x80_Url,
                    'image_68x48'     => $image_68x48_Url,
                    'image_190x230'   => $image_190x230_Url,
                    'image_163x116'   => $image_163x116_Url,
                    'image_295x248'   => $image_295x248_Url,
                    'image_417x384'   => $image_417x384_Url,
                    'image_thumbnail' => $image_thumbnail_Url,
                ];
            }
            $error             = false;
            $size              = File::size(public_path($originalImageUrl));
            if ($storage == 'aws_s3' && array_key_exists('storage', $images)) {
                $response = $this->uploadToS3($images, $content_type);
                if ($response === true) {
                    $this->deleteImage($images);
                } else {
                    $this->deleteImage($images);
                    $error = 's3_error';
                }
            }
            if ($storage == 'do' && array_key_exists('storage', $images)) {
                $response = $this->uploadToDO($images, $content_type);
                if ($response === true) {
                    $this->deleteImage($images);
                } else {
                    $this->deleteImage($images);
                    $error = 'do_error';
                }
            }
            if ($storage == 'wasabi' && array_key_exists('storage', $images)) {
                $response = $this->uploadToWasabi($images, $content_type);
                if ($response === true) {
                    $this->deleteImage($images);
                } else {
                    $this->deleteImage($images);
                    $error = 'wasabi_error';
                }
            }
            if ($error === 's3_error') {
                return $error;
            }

            $data['images']    = $images;
            $data['id']        = isset($media) ? $media->id : null;

            return $data;
        } else {
            return false;
        }
    }

    public function deleteImage($files, $storage = 'local')
    {
        try {
            foreach (array_slice($files, 1) as $file) {
                if ($storage == 'aws_s3') {
                    Storage::disk('s3')->delete($file);
                } elseif ($storage == 'wasabi') {
                    Storage::disk('wasabi')->delete($file);
                } else {
                    File::delete('public/'.$file);
                }
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function saveFile($requested_file, $type, $save_to_db = true)
    {
        if (! empty($requested_file) && $requested_file != 'null') {
            $image           = explode('.', $requested_file->getClientOriginalName());
            $extension       = $requested_file->getClientOriginalExtension();
            $name            = $image[0];
            $size            = @$requested_file->getSize();
            $storage         = setting('default_storage') != '' || setting('default_storage') != null ? setting('default_storage') : 'local';
            $response        = false;
            $mime_type       = $requested_file->getMimeType();
            // dd($mime_type);
            $content_type    = ['visibility' => 'public', 'ContentType' => $extension == 'svg' ? 'image/svg+xml' : $mime_type];
            $originalFile    = date('YmdHis').'_original_'.rand(1, 500).'.'.$extension;
            $directory       = 'files/';

            File::ensureDirectoryExists('public/'.$directory, 0777, true);

            $originalFileUrl = $directory.$originalFile;

            $requested_file->move('public/'.$directory, 'public/'.$originalFileUrl);

            if ($storage == 'aws_s3') {
                $response = $this->uploadFileToS3($originalFileUrl, $content_type);

                if ($response == true) {
                    $this->deleteFile('public/'.$originalFileUrl);
                } else {
                    $this->deleteFile('public/'.$originalFileUrl);

                    return 's3_error';
                }
            } elseif ($storage == 'do') {
                $response = $this->uploadFileToDO($originalFileUrl, $content_type);

                if ($response == true) {
                    $this->deleteFile('public/'.$originalFileUrl);
                } else {
                    $this->deleteFile('public/'.$originalFileUrl);

                    return 'do_error';
                }
            } elseif ($storage == 'wasabi') {
                $response = $this->uploadFileToWasabi($originalFileUrl, $content_type);

                if ($response == true) {
                    $this->deleteFile('public/'.$originalFileUrl);
                } else {
                    $this->deleteFile('public/'.$originalFileUrl);

                    return 'wasabi_error';
                }
            }

            if ($type == 'pos_file') {
                return ['storage' => $storage, 'image' => $originalFileUrl];
            }

            return $originalFileUrl;
        } else {
            return false;
        }
    }

    public function deleteFile($file, $storage = 'local')
    {
        try {
            if ($storage == 'aws_s3') {
                Storage::disk('s3')->delete($file);
            } elseif ($storage == 'wasabi') {
                Storage::disk('wasabi')->delete($file);
            } else {
                File::delete('public/'.$file);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getImage($id)
    {
        $image = MediaLibrary::find($id);
        if (! blank($image)) {
            $data = $image->image_variants;

            return $data;
        } else {
            return false;
        }
    }

    // protected function uploadToS3($files, $contentType)
    // {
    //     foreach (array_slice($files, 1) as $file) {
    //         // dd($file != '' && file_exists('public/'.$file));
    //         if ($file != '') {
    //             Storage::disk('s3')->put($file, file_get_contents('public/'.$file), $contentType);
    //             dd(Storage::disk('s3')->put($file, file_get_contents('public/'.$file), $contentType));
    //         }
    //     }
    //     return true;
    // }

    protected function uploadToS3($files, $contentType)
    {
        foreach (array_slice($files, 1) as $file) {
            if ($file != '') {
                $filePath = $file;

                if (file_exists($filePath)) {
                    $uploadSuccess = Storage::disk('s3')->put($file, file_get_contents($filePath), $contentType);

                    if ($uploadSuccess) {
                        // Optional: Log success or perform additional actions
                        dd('File uploaded successfully to S3: '.$file);
                    } else {
                        dd('Failed to upload file to S3: '.$file);
                    }
                } else {
                    dd('File does not exist: '.$filePath);
                }
            }
        }

        return true;
    }

    protected function uploadToDO($files, $contentType)
    {
        $directory = setting('do_directory') ? setting('do_directory').'/' : '';
        foreach (array_slice($files, 1) as $file) {
            if ($file != '' && file_exists(public_path('/').$file)) {
                $file_content = file_get_contents(public_path('/').$file);
                Storage::disk('do')->put($directory.$file, $file_content, $contentType);
            }
        }

        return true;
    }

    protected function uploadFileToDO($file, $contentType)
    {
        if ($file != '' && file_exists(public_path('/').$file)) {
            Storage::disk('do')->put($file, file_get_contents(public_path('/').$file), $contentType);

            return true;
        }

        return false;
    }

    protected function uploadFileToS3($file, $contentType)
    {
        if ($file != '' && file_exists('public/'.$file)) {
            Storage::disk('s3')->put($file, file_get_contents('public/'.$file), $contentType);

            return true;
        }

        return false;
    }

    protected function uploadToWasabi($files, $contentType)
    {

        // try {
        //     $files = Storage::disk('wasabi')->files();
        //     echo "Successfully connected to Wasabi! Files in bucket:\n";
        //     print_r($files);
        // } catch (\Exception $e) {
        //     echo "Failed to connect to Wasabi: " . $e->getMessage();
        // }
        // Check if the $files is an array
        if (! is_array($files)) {
            throw new \InvalidArgumentException('The $files parameter must be an array.');
        }

        // Loop through each file
        foreach (array_slice($files, 1) as $file) {
            // Ensure the file path is not empty
            if ($file != '' && file_exists(public_path($file))) {
                try {
                    // Read the file contents
                    $fileContents = file_get_contents(public_path($file));

                    // Upload the file to Wasabi
                    $result       = Storage::disk('wasabi')->put($file, $fileContents, ['ContentType' => $contentType]);

                    // Log the result for debugging
                    if (! $result) {
                        dd("Failed to upload file: $file");
                        \Log::warning("Failed to upload file: $file");
                    }
                } catch (\Exception $e) {
                    dd($e->getMessage());
                    \Log::error("Error uploading file to Wasabi: {$e->getMessage()}");
                }
            } else {
                dd("File does not exist: $file");
                \Log::warning("File does not exist: $file");
            }
        }

        return true;
    }

    // protected function uploadToWasabi($files, $contentType)
    // {
    //     foreach (array_slice($files, 1) as $file) {
    //         if ($file != '' && file_exists('public/'.$file)) {
    //             Storage::disk('wasabi')->put($file, file_get_contents('public/'.$file), $contentType);
    //         }
    //     }
    //     return true;
    // }

    protected function uploadFileToWasabi($file, $contentType)
    {
        if ($file != '' && file_exists('public/'.$file)) {
            Storage::disk('wasabi')->put($file, file_get_contents('public/'.$file), $contentType);

            return true;
        }

        return false;
    }

    public function getImageWithRecommendedSize($width, $height, $image)
    {

        $extension        = strtolower($image->getClientOriginalExtension());
        $directory        = 'images/';

        $originalImage    = date('YmdHis').'-user-'.rand(1, 500).'.'.$extension;
        $image20X20       = date('YmdHis').'image_20X20-user-'.rand(1, 500).'.'.$extension;

        $originalImageUrl = $directory.$originalImage;
        $image20X20Url    = $directory.$image20X20;

        Image::make($image)->save(isLocalhost().$originalImageUrl);

        Image::make($image)->resize(
            $width,
            $height,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        )->save(isLocalhost().$image20X20Url);

        $images           = [
            'original_image' => $originalImageUrl,
            'image_20x20'    => $image20X20Url,
        ];

        $data['images']   = $images;
        $data['id']       = null;

        return $data;
    }

    public function getImageArrayRecommendedSize($id, $widths = [], $heights = [])
    {
        foreach ($widths as $key => $width) {
            $height = $heights[$key];
            $this->getImageWithRecommendedSize($id, $width, $height);
        }

    }

    protected function getEncodePercentage(): int
    {
        if (setting('image_optimization') && setting('image_optimization') == 0) {
            $encode_percentage = setting('image_optimization_percentage') ?: 90;
        } else {
            $encode_percentage = 90;
        }

        return $encode_percentage;
    }

    public function saveMultipleImage($images, $product): array
    {
        $storage            = setting('default_storage') != '' || setting('default_storage') != null ? setting('default_storage') : 'local';

        $description_images = [];
        if ($images && count($images) > 0) {
            if ($product && $product->description_images && count($product->description_images)) {
                foreach ($product->description_images as $description_image) {
                    $this->deleteFile($description_image['image'], $storage);
                }
            }
            foreach ($images as $description_image) {
                $image_name           = Str::uuid().'.'.$description_image->getClientOriginalExtension();
                $path                 = "images/description_images/$image_name";
                $description_image->move('public/images/description_images', $image_name);
                $description_images[] = [
                    'image'   => $path,
                    'storage' => $storage,
                ];
            }
        }

        if (count($description_images) == 0 && $product && $product->description_images) {
            $description_images = $product->description_images;
        }

        return $description_images;
    }

    public function saveFont($requested_file)
    {
        if (! empty($requested_file) && $requested_file != 'null') {
            $image           = explode('.', $requested_file->getClientOriginalName());
            $extension       = $requested_file->getClientOriginalExtension();
            $name            = $image[0];
            $size            = @$requested_file->getSize();
            $storage         = setting('default_storage') != '' || setting('default_storage') != null ? setting('default_storage') : 'local';
            $response        = false;
            $mime_type       = $requested_file->getMimeType();
            $content_type    = ['visibility' => 'public', 'ContentType' => $extension == 'svg' ? 'image/svg+xml' : $mime_type];
            $originalFile    = date('YmdHis').'_original_'.rand(1, 500).'.'.$extension;
            $directory       = 'fonts/';

            File::ensureDirectoryExists('resources/'.$directory, 0777, true);

            $originalFileUrl = $originalFile;

            $requested_file->move('resources/'.$directory, 'resources/'.$originalFileUrl);

            if ($storage == 'aws_s3') {
                $response = $this->uploadFileToS3($originalFileUrl, $content_type);

                if ($response == true) {
                    $this->deleteFile('resources/'.$originalFileUrl);
                } else {
                    $this->deleteFile('resources/'.$originalFileUrl);

                    return 's3_error';
                }
            } elseif ($storage == 'do') {
                $response = $this->uploadFileToDO($originalFileUrl, $content_type);

                if ($response) {
                    $this->deleteFile('resources/'.$originalFileUrl);
                } else {
                    $this->deleteFile('resources/'.$originalFileUrl);

                    return 's3_error';
                }
            } elseif ($storage == 'wasabi') {
                $response = $this->uploadFileToWasabi($originalFileUrl, $content_type);

                if ($response == true) {
                    $this->deleteFile('resources/'.$originalFileUrl);
                } else {
                    $this->deleteFile('resources/'.$originalFileUrl);

                    return 'wasabi_error';
                }
            }

            return ['storage' => $storage, 'file' => $originalFileUrl];
        } else {
            return false;
        }
    }
}
