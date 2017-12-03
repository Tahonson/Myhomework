<?php
namespace App;
require '../vendor/autoload.php';
use Intervention\Image\ImageManagerStatic as Image;

$image = Image::make('bez.png')
    ->resize(200, null, function ($image) {
        $image->aspectRatio();
    })
    ->rotate(45)
    ->text('CENSOR', 80,180, function ($font) {
        $font->size(48);
        $font->color('#FF0000');
        $font->align('center');
        $font->angle(45);
    })
    ->save('newImages/image_1.png');
echo "<img src ='newImages/image_1.png'>";
echo "<a href=\" / \">Вернуться обратно</a>";

// configure with favored image driver (gd by default)


// and you are ready to go ...
