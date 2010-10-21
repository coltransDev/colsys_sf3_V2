<?
    if($user->getSucursal()=='ABO' || $user->getSucursal()=='ACL' || $user->getSucursal()=='ABU' || $user->getSucursal()=='ACT' || $user->getSucursal()=='ABA' || $user->getSucursal()=='AMD'){
		echo image_tag('colmas_logo.jpg',array('border'=>'none'));
    }elseif($user->getSucursal()=='CCT' || $user->getSucursal()=='CBU' || $user->getSucursal()=='CBO' || $user->getSucursal()=='CMD'){
        echo image_tag('consolcargo2.png',array('border'=>'none'));
    }elseif($user->getSucursal()=='MIA'){
        echo image_tag('coltrans_usa1.png',array('border'=>'none'));
    }else{
        echo image_tag('coltrans_logo.jpg',array('border'=>'none'));
    }

?>