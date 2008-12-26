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
class InoClientesSeaMapBuilder implements MapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap(InoClientesSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoClientesSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoClientesSea');
		$tMap->setClassname('InoClientesSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('OID', 'Oid', 'INTEGER', false, null);

		$tMap->addForeignPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR' , 'tb_inomaestra_sea', 'CA_REFERENCIA', true, null);

		$tMap->addPrimaryKey('CA_IDCLIENTE', 'CaIdcliente', 'INTEGER', true, null);

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

	} // doBuild()

} // InoClientesSeaMapBuilder
