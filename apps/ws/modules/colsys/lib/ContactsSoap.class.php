<?php

/*
 * (c) Coltrans S.A. - Colmas Ltda.
 * 
 */

/**
 * Description of ContactsSoap
 *
 * @author maquinche
 */
class ContactsSoap {
    /**
     * GetContacts method
     *
     * @param string $key_secret     
     * @return array string
     */
    public function getContacts( $key_secret ) {
        
        if( $key_secret!=sfConfig::get("app_soap_secret") ){
            return "Remote: La clave no concuerda";     
        }
        
        /*$sql="select distinct con.ca_email, c.ca_coltrans_std  , c.ca_colmas_std
	from vi_clientes c
        inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
        where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' )  /*and 
            c.ca_idcliente in 
                (  SELECT ics.ca_idcliente
                FROM tb_inoclientes_sea ics
			JOIN tb_inomaestra_sea im on ics.ca_referencia = im.ca_referencia
			JOIN tb_ciudades c ON c.ca_idciudad = im.ca_origen
			JOIN tb_traficos t ON t.ca_idtrafico = c.ca_idtrafico
                WHERE t.ca_idtrafico = 'DE-049' and im.ca_destino = 'CTG-0005' ) offset 264";*/
            //order by 2,3 limit $nreg offset $inicio";
            //        echo $sql;
        $sql="select distinct con.ca_email, c.ca_coltrans_std  , c.ca_colmas_std
	from vi_clientes c
        inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
        where (c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' ) offset 1493";
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        
        $data=array();
        foreach ($clientes as $c)
        {
            /*if($c["ca_coltrans_std"]!="Activo")
                continue;*/
            $data[]=$c["ca_email"];
        }
        
            try{                 
                //return implode(",", $clientes);
                return $data;
            }catch(Exception $e){
                $conn->rollback();
                Utils::sendEmail($e->getMessage());
                return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"];
            }
    }
     
}