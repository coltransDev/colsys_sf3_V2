<?php


/**
 * This class adds structure of 'tb_inomaestra_sea' table to 'propel' DatabaseMap object.
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
class InoMaestraSeaMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.sea.map.InoMaestraSeaMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(InoMaestraSeaPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(InoMaestraSeaPeer::TABLE_NAME);
		$tMap->setPhpName('InoMaestraSea');
		$tMap->setClassname('InoMaestraSea');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CA_FCHREFERENCIA', 'CaFchreferencia', 'DATE', true, null);

		$tMap->addPrimaryKey('CA_REFERENCIA', 'CaReferencia', 'VARCHAR', true, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORIGEN', 'CaOrigen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESTINO', 'CaDestino', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHEMBARQUE', 'CaFchembarque', 'DATE', false, null);

		$tMap->addColumn('CA_FCHARRIBO', 'CaFcharribo', 'DATE', false, null);

		$tMap->addColumn('CA_MODALIDAD', 'CaModalidad', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDLINEA', 'CaIdlinea', 'INTEGER', 'tb_transporlineas', 'CA_IDLINEA', false, null);

		$tMap->addColumn('CA_MOTONAVE', 'CaMotonave', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CICLO', 'CaCiclo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MBLS', 'CaMbls', 'VARCHAR', false, null);

		$tMap->addColumn('CA_OBSERVACIONES', 'CaObservaciones', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCONFIRMACION', 'CaFchconfirmacion', 'DATE', false, null);

		$tMap->addColumn('CA_HORACONFIRMACION', 'CaHoraconfirmacion', 'TIME', false, null);

		$tMap->addColumn('CA_REGISTROADU', 'CaRegistroadu', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REGISTROCAP', 'CaRegistrocap', 'VARCHAR', false, null);

		$tMap->addColumn('CA_BANDERA', 'CaBandera', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLIBERACION', 'CaFchliberacion', 'DATE', false, null);

		$tMap->addColumn('CA_NROLIBERACION', 'CaNroliberacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ANULADO', 'CaAnulado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLIQUIDADO', 'CaFchliquidado', 'DATE', false, null);

		$tMap->addColumn('CA_USULIQUIDADO', 'CaUsuliquidado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCERRADO', 'CaFchcerrado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCERRADO', 'CaUsucerrado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MENSAJE', 'CaMensaje', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHDESCONSOLIDACION', 'CaFchdesconsolidacion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MNLLEGADA', 'CaMnllegada', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHREGISTROADU', 'CaFchregistroadu', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCONFIRMADO', 'CaFchconfirmado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCONFIRMADO', 'CaUsuconfirmado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ASUNTO_OTM', 'CaAsuntoOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MENSAJE_OTM', 'CaMensajeOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHLLEGADA_OTM', 'CaFchllegadaOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CIUDAD_OTM', 'CaCiudadOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHCONFIRMA_OTM', 'CaFchconfirmaOtm', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUCONFIRMA_OTM', 'CaUsuconfirmaOtm', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PROVISIONAL', 'CaProvisional', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_SITIODEVOLUCION', 'CaSitiodevolucion', 'VARCHAR', false, null);

	} // doBuild()

} // InoMaestraSeaMapBuilder
