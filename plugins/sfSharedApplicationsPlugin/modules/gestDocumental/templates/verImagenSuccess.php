<?
//error_reporting(E_ALL);
    $image = imagecreatefromjpeg($archivo);

            $w = imagesx($image);
            $h = imagesy($image);
            //$tam_max=200;
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
                //echo $porcen;
                $new_w= $w * $porcen;
                $new_h= $h * $porcen;
                //echo $new_w."-".$new_h;

                $im2 = ImageCreateTrueColor($new_w, $new_h);
                imagecopyResampled ($im2, $image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);
                $w = imagesx($im2);
                $h = imagesy($im2);
                //echo "<br>".$w."-".$h;
                //
                //imagejpeg($im2,$directory.$fileNameMin.".jpg",80);
                imagejpeg($img2,NULL,80);
                //$this->im=$im2;
            }
            else
            {
                imagejpeg($image,NULL,80);
                //$this->im=$image;
            }
//imagejpeg($im,NULL,80);
header ('Content-type: image/jpeg');
@imagejpeg($im, NULL, 80);
exit();
?>