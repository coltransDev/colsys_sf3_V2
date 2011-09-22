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


}