<?php



class CotProductoMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotProductoMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(CotProductoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotProductoPeer::TABLE_NAME);
		$tMap->setPhpName('CotProducto');
		$tMap->setClassname('CotProducto');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotproductos_id');

		$tMap->addPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'INTEGER', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER' , 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ESCALA', 'CaEscala', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPRIMIR', 'CaImprimir', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PRODUCTO', 'CaProducto', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FRECUENCIA', 'CaFrecuencia', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TIEMPOTRANSITO', 'CaTiempotransito', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LOCRECARGOS', 'CaLocrecargos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DATOSAG', 'CaDatosag', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'INTEGER', 'vi_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_POSTULARLINEA', 'CaPostularlinea', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDTAREA', 'CaIdtarea', 'INTEGER', 'notificaciones.tb_tareas', 'CA_IDTAREA', false, null);

	} 
} 