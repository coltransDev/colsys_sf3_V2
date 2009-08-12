<?php



class CotizacionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotizacionMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(CotizacionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotizacionPeer::TABLE_NAME);
		$tMap->setPhpName('Cotizacion');
		$tMap->setClassname('Cotizacion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotizaciones_id');

		$tMap->addPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_IDCONTACTO', 'CaIdcontacto', 'INTEGER', 'tb_concliente', 'CA_IDCONTACTO', true, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ASUNTO', 'CaAsunto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ENTRADA', 'CaEntrada', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESPEDIDA', 'CaDespedida', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_USUARIO', 'CaUsuario', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', false, null);

		$tMap->addColumn('CA_ANEXOS', 'CaAnexos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHSOLICITUD', 'CaFchsolicitud', 'DATE', false, null);

		$tMap->addColumn('CA_HORASOLICITUD', 'CaHorasolicitud', 'TIME', false, null);

		$tMap->addColumn('CA_FCHPRESENTACION', 'CaFchpresentacion', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_FCHANULADO', 'CaFchanulado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUANULADO', 'CaUsuanulado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMPRESA', 'CaEmpresa', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DATOSAG', 'CaDatosag', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FUENTE', 'CaFuente', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDG_ENVIO_OPORTUNO', 'CaIdgEnvioOportuno', 'INTEGER', 'notificaciones.tb_tareas', 'CA_IDTAREA', false, null);

	} 
} 