<?php


/**
 * This class adds structure of 'tb_cotizaciones' table to 'propel' DatabaseMap object.
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
class CotizacionMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.cotizaciones.map.CotizacionMapBuilder';

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

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'DATE', false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'DATE', false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHSOLICITUD', 'CaFchsolicitud', 'DATE', false, null);

		$tMap->addColumn('CA_HORASOLICITUD', 'CaHorasolicitud', 'TIME', false, null);

		$tMap->addColumn('CA_FCHANULADO', 'CaFchanulado', 'DATE', false, null);

		$tMap->addColumn('CA_USUANULADO', 'CaUsuanulado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_EMPRESA', 'CaEmpresa', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DATOSAG', 'CaDatosag', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ESTADO', 'CaEstado', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MOTIVONOAPROBADO', 'CaMotivonoaprobado', 'VARCHAR', false, null);

	} // doBuild()

} // CotizacionMapBuilder
