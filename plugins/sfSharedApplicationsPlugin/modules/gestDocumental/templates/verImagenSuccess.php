<?
    $image = imagecreatefromjpeg($archivo);
            $w = imagesx($image);
            $h = imagesy($image);
            if($w>$tam_max || $h>$tam_max)
            {
                $control=($h>=$w);
                if($control)
                {
                    $porcen=$tam_max/$h;
                }
                else {
                    $porcen=$tam_max/$w;
                }
                $new_w= $w * $porcen;
                $new_h= $h * $porcen;
                $im2 = ImageCreateTrueColor($new_w, $new_h);
                imagecopyResampled ($im2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
                $w = imagesx($im2);
                $h = imagesy($im2);
                imagejpeg($img2,NULL,80);
            }
            else
            {
                imagejpeg($image,NULL,80);
            }
header ('Content-type: image/jpeg');
@imagejpeg($im, NULL, 80);
exit();
?>