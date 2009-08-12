<?php



class InoClientesSeaMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.sea.map.InoClientesSeaMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(InoClientesSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoClientesSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoClientesSea');
		$tMap->setClassname('InoClientesSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('OID', 'Oid', 'INTEGER', false, null);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR' , 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER' , 'tb_clientes', 'CA_IDCLIENTE', true, null);

		$tMap->addPrimaryKey('CA_HBLS', 'CaHbls', 'VARCHAR', true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'INTEGER', 'tb_reportes', 'CA_IDREPORTE', false, null);

		$tMap->addForeignKey('CA_IDPROVEEDOR', 'CaIdproveedor', 'INTEGER', 'tb_terceros', 'CA_IDTERCERO', false, null);

		$tMap->addColumn('CA_PROVEEDOR', 'CaProveedor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NUMPIEZAS', 'CaNumpiezas', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'NUMERIC', false, null);

		$tMap->addColumn('CA_VOLUMEN', 'CaVolumen', 'NUMERIC', false, null);

		$tMap->addColumn('CA_NUMORDEN', 'CaNumorden', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONFIRMAR', 'CaConfirmar', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LOGIN', 'CaLogin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLIBERACION', 'CaFchliberacion', 'DATE', false, null);

		$tMap->addColumn('CA_NOTALIBERACION', 'CaNotaliberacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLIBERADO', 'CaFchliberado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USULIBERADO', 'CaUsuliberado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MENSAJE', 'CaMensaje', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTINUACION', 'CaContinuacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTINUACION_DEST', 'CaContinuacionDest', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDBODEGA', 'CaIdbodega', 'INTEGER', false, null);

	} 
} 