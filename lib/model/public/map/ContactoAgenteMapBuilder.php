<?php


/**
 * This class adds structure of 'tb_contactos' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.public.map
 */
class ContactoAgenteMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.public.map.ContactoAgenteMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ContactoAgentePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ContactoAgentePeer::TABLE_NAME);
		$tMap->setPhpName('ContactoAgente');
		$tMap->setClassname('ContactoAgente');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDCONTACTO', 'CaIdcontacto', 'VARCHAR', true, null);

		$tMap->addForeignKey('CA_IDAGENTE', 'CaIdagente', 'INTEGER', 'tb_agentes', 'CA_IDAGENTE', false, null);

		$tMap->addColumn('CA_NOMBRE', 'CaNombre', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DIRECCION', 'CaDireccion', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TELEFONOS', 'CaTelefonos', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FAX', 'CaFax', 'VARCHAR', false, null);

		$tMap->addForeignKey('CA_IDCIUDAD', 'CaIdciudad', 'VARCHAR', 'tb_ciudades', 'CA_IDCIUDAD', false, null);

		$tMap->addColumn('CA_EMAIL', 'CaEmail', 'VARCHAR', false, null);

		$tMap->addColumn('CA_IMPOEXPO', 'CaImpoexpo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANSPORTE', 'CaTransporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CARGO', 'CaCargo', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DETALLE', 'CaDetalle', 'VARCHAR', false, null);

		$tMap->addColumn('CA_SUGERIDO', 'CaSugerido', 'BOOLEAN', false, null);

	} // doBuild()

} // ContactoAgenteMapBuilder
