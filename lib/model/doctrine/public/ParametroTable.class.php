<?php
/**
 */
class ParametroTable extends Doctrine_Table
{
    public static function retrieveByCaso( $casoUso, $valor1=null, $valor2=null, $id=null ){
        
        $c = ParametroTable::retrieveQueryByCaso( $casoUso, $valor1, $valor2, $id );

		return $c->execute();
	}

    public static function retrieveQueryByCaso( $casoUso, $valor1=null, $valor2=null, $id=null ){

        $c=Doctrine::getTable("Parametro")
           ->createQuery("p")
           ->where("p.ca_casouso = ? ", $casoUso );


		if( $valor1 ){
            $c->addWhere("p.ca_valor like ? ", "%".$valor1."%" );
		}

		if( $valor2 ){
            $c->addWhere("p.ca_valor2 like ? ", "%".$valor2."%" );
		}

		if( $id ){
            $c->addWhere("p.ca_identificacion = ? ", $id );

		}
        $c->addOrderBy("p.ca_identificacion ASC");

		return $c;
	}
        
    public static function saveCaso( $casoUso, $valor1 ){
        
        $config = Doctrine::getTable("ColsysConfig")->findOneBy("ca_param", $casoUso );
        if($config)
        {
            $ident=1;
            $record = Doctrine_Query::create()
                ->select('MAX(cc.ca_ident)')
                ->from('ColsysConfigValue cc')
                ->where('cc.ca_idconfig = ?', $config->getCaIdconfig())
                ->fetchArray();
            if (count($record) != 1) {
                 $ident=1;
            } else {
                if (isset($record[0]['MAX'])) {
                   $ident = $record[0]['MAX'];
                }
            }
            
            //exit;
            $value = new ColsysConfigValue();
            $value->setCaIdconfig( $config->getCaIdconfig() );
            $value->setCaIdent( $ident+1 );
            $value->setCaValue( $valor1 );
            $value->save();
        }
    }


}