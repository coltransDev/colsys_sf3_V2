<?php


/**
 * This class adds structure of 'tb_cotseguimientos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.cotizaciones.map
 */
class CotSeguimientoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotSeguimientoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(CotSeguimientoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotSeguimientoPeer::TABLE_NAME);
		$tMap->setPhpName('CotSeguimiento');
		$tMap->setClassname('CotSeguimiento');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER' , 'tb_cotizaciones', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER' , 'tb_cotproductos', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'INTEGER' , 'tb_cotproductos', 'CA_IDPRODUCTO', true, null);

		$tMap->addPrimaryKey('CA_FCHSEGUIMIENTO', 'CaFchseguimiento', 'TIMESTAMP', true, null);

		$tMap->addForeignKey('CA_LOGIN', 'CaLogin', 'VARCHAR', 'control.tb_usuarios', 'CA_LOGIN', true, null);

		$tMap->addColumn('CA_SEGUIMIENTO', 'CaSeguimiento', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ETAPA', 'CaEtapa', 'VARCHAR', false, null);

	} // doBuild()

} // CotSeguimientoMapBuilder
