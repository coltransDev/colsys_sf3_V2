<?php


/**
 * This class adds structure of 'tb_inoclientes_sea' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.sea.map
 */
class InoClientesSeaMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sea.map.InoClientesSeaMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_inoclientes_sea');
		$tMap->setPhpName('InoClientesSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('OID', 'Oid', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'string' , CreoleTypes::VARCHAR, 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addPrimaryKey('CA_HBLS', 'CaHbls', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addForeignKey('CA_IDREPORTE', 'CaIdreporte', 'int', CreoleTypes::INTEGER, 'tb_reportes', 'CA_IDREPORTE', false, null);

		$tMap->addForeignKey('CA_IDPROVEEDOR', 'CaIdproveedor', 'int', CreoleTypes::INTEGER, 'tb_terceros', 'CA_IDTERCERO', false, null);

		$tMap->addColumn('CA_PROVEEDOR', 'CaProveedor', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NUMPIEZAS', 'CaNumpiezas', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_PESO', 'CaPeso', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_VOLUMEN', 'CaVolumen', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_NUMORDEN', 'CaNumorden', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONFIRMAR', 'CaConfirmar', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_LOGIN', 'CaLogin', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHLIBERACION', 'CaFchliberacion', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_NOTALIBERACION', 'CaNotaliberacion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHLIBERADO', 'CaFchliberado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USULIBERADO', 'CaUsuliberado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MENSAJE', 'CaMensaje', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTINUACION', 'CaContinuacion', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTINUACION_DEST', 'CaContinuacionDest', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_IDBODEGA', 'CaIdbodega', 'int', CreoleTypes::INTEGER, false, null);

	} // doBuild()

} // InoClientesSeaMapBuilder
