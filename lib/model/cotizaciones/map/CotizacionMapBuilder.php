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
class CotizacionMapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_cotizaciones');
		$tMap->setPhpName('Cotizacion');

		$tMap->setUseIdGenerator(true);

		$tMap->setPrimaryKeyMethodInfo('tb_cotizaciones_SEQ');

		$tMap->addPrimaryKey('CA_IDCOTIZACION', 'CaIdcotizacion', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('CA_IDCONTACTO', 'CaIdcontacto', 'int', CreoleTypes::INTEGER, 'tb_concliente', 'CA_IDCONTACTO', true, null);

		$tMap->addColumn('CA_CONSECUTIVO', 'CaConsecutivo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ASUNTO', 'CaAsunto', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_SALUDO', 'CaSaludo', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ENTRADA', 'CaEntrada', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESPEDIDA', 'CaDespedida', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addForeignKey('CA_USUARIO', 'CaUsuario', 'string', CreoleTypes::VARCHAR, 'control.tb_usuarios', 'CA_LOGIN', false, null);

		$tMap->addColumn('CA_ANEXOS', 'CaAnexos', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHCREADO', 'CaFchcreado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUCREADO', 'CaUsucreado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHACTUALIZADO', 'CaFchactualizado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUACTUALIZADO', 'CaUsuactualizado', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHSOLICITUD', 'CaFchsolicitud', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_HORASOLICITUD', 'CaHorasolicitud', 'int', CreoleTypes::TIME, false, null);

		$tMap->addColumn('CA_FCHANULADO', 'CaFchanulado', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_USUANULADO', 'CaUsuanulado', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // CotizacionMapBuilder
