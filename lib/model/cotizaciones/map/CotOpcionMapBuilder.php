<?php


/**
 * This class adds structure of 'tb_cotopciones' table to 'propel' DatabaseMap object.
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
class CotOpcionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotOpcionMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(CotOpcionPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(CotOpcionPeer::TABLE_NAME);
		$tMap->setPhpName('CotOpcion');
		$tMap->setClassname('CotOpcion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotopciones_id');

		$tMap->addPrimaryKey('CA_IDOPCION', 'CaIdopcion', 'VARCHAR', true, null);

		$tMap->addForeignPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'INTEGER' , 'tb_cotproductos', 'CA_IDCOTIZACION', true, null);

		$tMap->addForeignPrimaryKey('CA_IDPRODUCTO', 'CaIdproducto', 'INTEGER' , 'tb_cotproductos', 'CA_IDPRODUCTO', true, null);

		$tMap->addForeignKey('CA_IDCONCEPTO', 'CaIdconcepto', 'INTEGER', 'tb_conceptos', 'CA_IDCONCEPTO', false, null);

		$tMap->addColumn('CA_VALOR_TAR', 'CaValorTar', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICA_TAR', 'CaAplicaTar', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VALOR_MIN', 'CaValorMin', 'NUMERIC', false, null);

		$tMap->addColumn('CA_APLICA_MIN', 'CaAplicaMin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IDMONEDA', 'CaIdmoneda', 'VARCHAR', false, null);

		$tMap->addColumn('CA_RECARGOS', 'CaRecargos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'INTEGER', false, null);

	} // doBuild()

} // CotOpcionMapBuilder
