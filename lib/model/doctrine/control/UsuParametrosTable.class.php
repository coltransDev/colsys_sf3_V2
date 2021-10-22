<?php

class UsuParametrosTable extends Doctrine_Table
{
    
    public static function getUserxParams( $reporte) {

        $impoexpo   = $reporte->getCaImpoexpo();
        $transporte = $reporte->getCaTransporte();
        $modalidad  = $reporte->getCaModalidad();
        $trafico    = $reporte->getOrigen()->getCaIdtrafico();
        $ciudad     = $reporte->getCaOrigen();
        $idcliente  = $reporte->getCliente()->getCaIdcliente();

        $usuario = Doctrine::getTable("Usuario")->find($reporte->getCaUsucreado());
        $q=Doctrine::getTable("UsuParametros")                    
                    ->createQuery("r")
                    ->innerJoin("r.Usuario u")
                    ->innerJoin("u.Sucursal s")
                    ->where("r.ca_impoexpo = ?   ", array( $impoexpo ) )
                    ->addWhere("r.ca_idcliente = ? ", array( $idcliente ) )
                    ->addWhere("s.ca_nombre = ?", $usuario->getSucursal()->getCaNombre())
                    ->fetchArray();
        if(count($q)>0)
            return $q[0];
        
        $q=Doctrine::getTable("UsuParametros")
                    ->createQuery("r")
                    ->innerJoin("r.Usuario u")
                    ->innerJoin("u.Sucursal s")
                    ->where("r.ca_impoexpo = ? and r.ca_transporte = ?   ", array( $impoexpo , $transporte ) )
                    ->addWhere("r.ca_trafico = ? or ca_ciudad = ? and r.ca_idcliente is null", array( $trafico , $ciudad  ) )
                    ->addOrderBy("r.ca_ciudad DESC,r.ca_trafico ")                
                    ->addWhere("s.ca_nombre = ?", $usuario->getSucursal()->getCaNombre())
                    ->fetchArray();
        //$q->addWhere("s.ca_nombre = ?", $usuario->getSucursal()->getCaNombre());
        //echo "<pre>";print_r($q);echo "</pre>";
        //echo "<br>".$impoexpo."<br>".$transporte."<br>".$modalidad."<br>".$trafico."<br>".$ciudad."<br>".$idcliente;
        
        if(count($q)>0)
        {
            foreach($q as $key=>$d)
            {
                if($d["ca_ciudad"]==$ciudad && $d["ca_modalidad"]==$modalidad)
                {
                    return $d;
                }
                else if($d["ca_ciudad"]!="" && $d["ca_modalidad"]!="")
                {
                    unset($q[$key]);
                }
            }
            //echo "<pre>";print_r($q);echo "</pre>";

            foreach($q as $d)
            {
                if($d["ca_ciudad"]==$ciudad )
                {
                    return $d;
                }
                else if($d["ca_ciudad"]!="")
                {
                    //unset($q[$key]);
                }
            }
        
            foreach($q as $key=>$d)
            {
                if($d["ca_modalidad"]==$modalidad)
                {
                    //echo "65";
                    return $d;
                }
                else if($d["ca_modalidad"]!="")
                {
                    //unset($q[$key]);
                }
            }
            //echo "<pre>";print_r($q);echo "</pre>";
        //echo "<br>".$impoexpo."<br>".$transporte."<br>".$modalidad."<br>".$trafico."<br>".$ciudad."<br>".$idcliente;
            
            foreach($q as $d)
            {
                //echo "77";
                return $d;
            }
        }
        
        $q=Doctrine::getTable("UsuParametros")
                    ->createQuery("r")
                    ->innerJoin("r.Usuario u")
                    ->innerJoin("u.Sucursal s")
                    ->where("r.ca_impoexpo = ? and r.ca_transporte = ?  and r.ca_idcliente is null  ", array( $impoexpo , $transporte ) )                    
                    ->addWhere("s.ca_nombre = ?", $usuario->getSucursal()->getCaNombre())
                    ->addOrderBy("r.ca_ciudad ,r.ca_trafico ")
                    ->fetchArray();
        if(count($q)>0)
        {
            $pos=-1;
            if(count($q)==1)
                return $q[0];     
            else
            {
                foreach($q as $d)
                {
                    if($d["ca_modalidad"]==$modalidad)
                    {
                        return $d;
                    }
                }
            }
            return $q[0];
        }
/*        $q=Doctrine::getTable("UsuParametros")
                    ->createQuery("r")
                    ->where("r.ca_impoexpo = ?   ", array( $impoexpo ) )
                    ->addWhere("r.ca_transporte = ? and r.ca_modalidad = ?  or r.ca_trafico = ? or ca_ciudad = ? or r.ca_idcliente = ? ", array( $transporte, $modalidad , $trafico , $ciudad , $idcliente ) )
                    ->addOrderBy("r.ca_idcliente ,r.ca_ciudad ,r.ca_trafico ");
                    $params=$q->fetchArray();
                    //echo $q->getSqlQuery();
                    //echo "<br>".$impoexpo."<br>".$transporte."<br>".$modalidad."<br>".
                    //        $trafico."<br>".$ciudad."<br>".$idcliente;
        
                    
        if(count($params)>1)
        {
            foreach($params as $p)
            {
                if()
            }
        }
        return $params;
 */       
	}
}
