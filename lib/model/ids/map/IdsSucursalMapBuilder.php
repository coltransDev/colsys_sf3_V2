<?php


/**
 * This class adds structure of 'ids.tb_sucursales' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.ids.map
 */
class IdsSucursalMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.ids.map.IdsSucursalMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(IdsSucursalPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(IdsSucursalPeer::TABLE_NAME);
		$tMap->setPhpName('IdsSucursal');
		$tMap->setClassname('IdsSucursal');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('ids.tb_sucursales_ca_idsucursal_seq');

		$tMap->addPrimaryKey('CA_IDSUCURSAL', 'CaIdsucursal', 'INTEGER', true, null);

		$tMap->addForeignKey('CA_ID', 'CaId', 'INTEGER', 'ids.tb_ids', 'CA_ID', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OFICINA', 'CaOficina', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TORRE', 'CaTorre', 'INTEGER', false, null);

		$tMap->addColumn('CA_BLOQUE', 'CaBloque', 'VARCHAR', false, null);

		$tMap->addColumn('CA_INTERIOR', 'CaInterior', 'VARCHAR', false, null);

		$tMap->addColumn('CA_LOCALIDAD', 'CaLocalidad', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COMPLEMENTO', 'CaComplemento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

	} // doBuild()

} // IdsSucursalMapBuilder
