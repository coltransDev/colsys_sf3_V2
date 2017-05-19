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
        
        /*if( $key_secret!=sfConfig::get("app_soap_secret") ){
            return "Remote: La clave no concuerda";     
        }*/
        
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
        //Envío Correos Colmas
        /*$sql="  SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
                FROM vi_clientes c
                    INNER JOIN tb_concliente con ON c.ca_idcliente = con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%' and con.ca_propiedades IS NULL
                WHERE (c.ca_colmas_std = 'Activo')
                GROUP BY con.ca_email, c.ca_idcliente
                ORDER BY ca_idcliente, ca_idcontacto";*/
        
        //Envío correos proveedores
        /*$sql="SELECT c.ca_email, c.ca_idcontacto, p.ca_idproveedor as ca_idcliente
                FROM ids.tb_contactos c
                        LEFT JOIN ids.tb_sucursales s ON s.ca_idsucursal = c.ca_idsucursal
                        LEFT JOIN ids.tb_ids i ON i.ca_id = s.ca_id
                        LEFT JOIN ids.tb_proveedores p ON p.ca_idproveedor = i.ca_id
                WHERE p.ca_controladoporsig = 5 and (p.ca_activo_impo = true OR p.ca_activo_expo = true) and c.ca_email like '%@%' and c.ca_activo = true   
                ORDER BY i.ca_nombre OFFSET 223";*/
        //ENVIOO CLIENTES CON OTM 2014
        $sql="SELECT DISTINCT con.ca_email, max(con.ca_idcontacto) as ca_idcontacto, c.ca_idcliente
	from vi_clientes_reduc c
        inner join tb_concliente con on c.ca_idcliente=con.ca_idcliente and ca_fijo=true and con.ca_email like '%@%'
        where /*(c.ca_coltrans_std = 'Activo'  or c.ca_colmas_std = 'Activo' )  and */
            c.ca_idcliente in 
                (  SELECT ca_idcliente
                FROM tb_inoclientes_sea ics			
                WHERE  ca_continuacion = 'OTM' and SUBSTR(ca_referencia, 16,2)='14' )
GROUP BY con.ca_email, c.ca_idcliente
                ORDER BY ca_idcliente, ca_idcontacto";
        $con = Doctrine_Manager::getInstance()->connection();
        $st = $con->execute($sql);
        $clientes = $st->fetchAll();
        
        $data=array();
        foreach ($clientes as $c){
            /**Valida si la dirección de correo está repetida*/
            if(!in_array($c["ca_email"], $data["email"])){
            
                /**Obligatoriamente se deben enviar estos 3 datos para la información de Unsuscribe que tiene el correo*/
                $data["email"][]=$c["ca_email"];
                $data["idcontacto"][]=$c["ca_idcontacto"];
                $data["idcliente"][]=$c["ca_idcliente"];
            }
        }
        
        try{
            return $data;
        }catch(Exception $e){
            $conn->rollback();
            Utils::sendEmail($e->getMessage());
            return "Remote: ".$e->getMessage()." server:".$_SERVER["SERVER_ADDR"];
        }
    }     
}