<?

class InoMaestraFactory{
	public static function crearReferencia( $referencia ){
		if( substr($referencia, 0, 1)=="1" ){
			return InoMaestraAirPeer::retrieveByPk( $referencia );			
		}
		
		
		if( substr($referencia, 0, 1)=="2" ){
			return AduanaMaestraPeer::retrieveByPk( $referencia );				
		}
		
				
		if( substr($referencia, 0, 1)=="4" || substr($referencia, 0, 1)=="5" ){
			return InoMaestraSeaPeer::retrieveByPk( $referencia );	 				
		}
								
	} 
}
?>