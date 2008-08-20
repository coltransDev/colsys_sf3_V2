<?php


abstract class BaseUsuarios extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ca_login;


	
	protected $ca_nombre;


	
	protected $ca_cargo;


	
	protected $ca_departamento;


	
	protected $ca_sucursal;


	
	protected $ca_email;


	
	protected $ca_rutinas;


	
	protected $ca_extension;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCaLogin()
	{

		return $this->ca_login;
	}

	
	public function getCaNombre()
	{

		return $this->ca_nombre;
	}

	
	public function getCaCargo()
	{

		return $this->ca_cargo;
	}

	
	public function getCaDepartamento()
	{

		return $this->ca_departamento;
	}

	
	public function getCaSucursal()
	{

		return $this->ca_sucursal;
	}

	
	public function getCaEmail()
	{

		return $this->ca_email;
	}

	
	public function getCaRutinas()
	{

		return $this->ca_rutinas;
	}

	
	public function getCaExtension()
	{

		return $this->ca_extension;
	}

	
	public function setCaLogin($v)
	{

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = UsuariosPeer::CA_LOGIN;
		}

	} 
	
	public function setCaNombre($v)
	{

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = UsuariosPeer::CA_NOMBRE;
		}

	} 
	
	public function setCaCargo($v)
	{

		if ($this->ca_cargo !== $v) {
			$this->ca_cargo = $v;
			$this->modifiedColumns[] = UsuariosPeer::CA_CARGO;
		}

	} 
	
	public function setCaDepartamento($v)
	{

		if ($this->ca_departamento !== $v) {
			$this->ca_departamento = $v;
			$this->modifiedColumns[] = UsuariosPeer::CA_DEPARTAMENTO;
		}

	} 
	
	public function setCaSucursal($v)
	{

		if ($this->ca_sucursal !== $v) {
			$this->ca_sucursal = $v;
			$this->modifiedColumns[] = UsuariosPeer::CA_SUCURSAL;
		}

	} 
	
	public function setCaEmail($v)
	{

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = UsuariosPeer::CA_EMAIL;
		}

	} 
	
	public function setCaRutinas($v)
	{

		if ($this->ca_rutinas !== $v) {
			$this->ca_rutinas = $v;
			$this->modifiedColumns[] = UsuariosPeer::CA_RUTINAS;
		}

	} 
	
	public function setCaExtension($v)
	{

		if ($this->ca_extension !== $v) {
			$this->ca_extension = $v;
			$this->modifiedColumns[] = UsuariosPeer::CA_EXTENSION;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ca_login = $rs->getString($startcol + 0);

			$this->ca_nombre = $rs->getString($startcol + 1);

			$this->ca_cargo = $rs->getString($startcol + 2);

			$this->ca_departamento = $rs->getString($startcol + 3);

			$this->ca_sucursal = $rs->getString($startcol + 4);

			$this->ca_email = $rs->getString($startcol + 5);

			$this->ca_rutinas = $rs->getString($startcol + 6);

			$this->ca_extension = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Usuarios object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuariosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UsuariosPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuariosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuariosPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaLogin($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UsuariosPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = UsuariosPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuariosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaLogin();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaCargo();
				break;
			case 3:
				return $this->getCaDepartamento();
				break;
			case 4:
				return $this->getCaSucursal();
				break;
			case 5:
				return $this->getCaEmail();
				break;
			case 6:
				return $this->getCaRutinas();
				break;
			case 7:
				return $this->getCaExtension();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuariosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaLogin(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaCargo(),
			$keys[3] => $this->getCaDepartamento(),
			$keys[4] => $this->getCaSucursal(),
			$keys[5] => $this->getCaEmail(),
			$keys[6] => $this->getCaRutinas(),
			$keys[7] => $this->getCaExtension(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuariosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaLogin($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaCargo($value);
				break;
			case 3:
				$this->setCaDepartamento($value);
				break;
			case 4:
				$this->setCaSucursal($value);
				break;
			case 5:
				$this->setCaEmail($value);
				break;
			case 6:
				$this->setCaRutinas($value);
				break;
			case 7:
				$this->setCaExtension($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuariosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaLogin($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaCargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDepartamento($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSucursal($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaEmail($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaRutinas($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaExtension($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuariosPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuariosPeer::CA_LOGIN)) $criteria->add(UsuariosPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(UsuariosPeer::CA_NOMBRE)) $criteria->add(UsuariosPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(UsuariosPeer::CA_CARGO)) $criteria->add(UsuariosPeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(UsuariosPeer::CA_DEPARTAMENTO)) $criteria->add(UsuariosPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(UsuariosPeer::CA_SUCURSAL)) $criteria->add(UsuariosPeer::CA_SUCURSAL, $this->ca_sucursal);
		if ($this->isColumnModified(UsuariosPeer::CA_EMAIL)) $criteria->add(UsuariosPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(UsuariosPeer::CA_RUTINAS)) $criteria->add(UsuariosPeer::CA_RUTINAS, $this->ca_rutinas);
		if ($this->isColumnModified(UsuariosPeer::CA_EXTENSION)) $criteria->add(UsuariosPeer::CA_EXTENSION, $this->ca_extension);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsuariosPeer::DATABASE_NAME);

		$criteria->add(UsuariosPeer::CA_LOGIN, $this->ca_login);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaLogin();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaLogin($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaSucursal($this->ca_sucursal);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaRutinas($this->ca_rutinas);

		$copyObj->setCaExtension($this->ca_extension);


		$copyObj->setNew(true);

		$copyObj->setCaLogin(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UsuariosPeer();
		}
		return self::$peer;
	}

} 