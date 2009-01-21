<?php


/**
 * This class adds structure of 'tb_cotrecargos' table to 'propel' DatabaseMap object.
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
class CotRecargoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotRecargoMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(CotRecargoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotRecargoPeer::TABLE_NAME);
		$tMap->setPhpName('CotRecargo');
		$tMap->setClassname('CotRecargo');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER', true, null);

		$tMap->addPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'INTEGER', true, null);

		$tMap->addForeignPrimaryKey('CA_IDOPCION', 'CaIdopcion', 'INTEGER' , 'tb_cotopciones', 'CA_IDOPCION', true, null);

		$tMap->addPrimaryKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', true, null);

		$tMap->addForeignPrimaryKey('CA_IDRECARGO', 'CaIdrecargo', 'INTEGER' , 'tb_tiporecargo', 'CA_IDRECARGO', true, null);

		$tMap->addColumn('CA_TIPO', 'CaTipo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALOR_TAR', 'CaValorTar', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICA_TAR', 'CaAplicaTar', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALOR_MIN', 'CaValorMin', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICA_MIN', 'CaAplicaMin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addPrimaryKey('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', true, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', false, null);

	} // doBuild()

} // CotRecargoMapBuilder
