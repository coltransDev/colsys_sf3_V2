<?php


abstract class BaseIdsSucursal extends BaseObject  implements Persistent {


  const PEER = 'IdsSucursalPeer';

	
	protected static $peer;

	
	protected $ca_idsucursal;

	
	protected $ca_id;

	
	protected $ca_principal;

	
	protected $ca_direccion;

	
	protected $ca_oficina;

	
	protected $ca_torre;

	
	protected $ca_bloque;

	
	protected $ca_interior;

	
	protected $ca_localidad;

	
	protected $ca_complemento;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_idciudad;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $aCiudad;

	
	protected $aIds;

	
	protected $collIdsContactos;

	
	private $lastIdsContactoCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getCaIdsucursal()
	{
		return $this->ca_idsucursal;
	}

	
	public function getCaId()
	{
		return $this->ca_id;
	}

	
	public function getCaPrincipal()
	{
		return $this->ca_principal;
	}

	
	public function getCaDireccion()
	{
		return $this->ca_direccion;
	}

	
	public function getCaOficina()
	{
		return $this->ca_oficina;
	}

	
	public function getCaTorre()
	{
		return $this->ca_torre;
	}

	
	public function getCaBloque()
	{
		return $this->ca_bloque;
	}

	
	public function getCaInterior()
	{
		return $this->ca_interior;
	}

	
	public function getCaLocalidad()
	{
		return $this->ca_localidad;
	}

	
	public function getCaComplemento()
	{
		return $this->ca_complemento;
	}

	
	public function getCaTelefonos()
	{
		return $this->ca_telefonos;
	}

	
	public function getCaFax()
	{
		return $this->ca_fax;
	}

	
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
	}

	
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
	}

	
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchactualizado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchactualizado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchactualizado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	
	public function setCaIdsucursal($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idsucursal !== $v) {
			$this->ca_idsucursal = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_IDSUCURSAL;
		}

		return $this;
	} 
	
	public function setCaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_ID;
		}

		if ($this->aIds !== null && $this->aIds->getCaId() !== $v) {
			$this->aIds = null;
		}

		return $this;
	} 
	
	public function setCaPrincipal($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_principal !== $v) {
			$this->ca_principal = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_PRINCIPAL;
		}

		return $this;
	} 
	
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_DIRECCION;
		}

		return $this;
	} 
	
	public function setCaOficina($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_oficina !== $v) {
			$this->ca_oficina = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_OFICINA;
		}

		return $this;
	} 
	
	public function setCaTorre($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_torre !== $v) {
			$this->ca_torre = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_TORRE;
		}

		return $this;
	} 
	
	public function setCaBloque($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_bloque !== $v) {
			$this->ca_bloque = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_BLOQUE;
		}

		return $this;
	} 
	
	public function setCaInterior($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_interior !== $v) {
			$this->ca_interior = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_INTERIOR;
		}

		return $this;
	} 
	
	public function setCaLocalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_localidad !== $v) {
			$this->ca_localidad = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_LOCALIDAD;
		}

		return $this;
	} 
	
	public function setCaComplemento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_complemento !== $v) {
			$this->ca_complemento = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_COMPLEMENTO;
		}

		return $this;
	} 
	
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_TELEFONOS;
		}

		return $this;
	} 
	
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_FAX;
		}

		return $this;
	} 
	
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

		return $this;
	} 
	
	public function setCaFchcreado($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsSucursalPeer::CA_FCHCREADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaFchactualizado($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsSucursalPeer::CA_FCHACTUALIZADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = IdsSucursalPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_idsucursal = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_principal = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->ca_direccion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_oficina = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_torre = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->ca_bloque = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_interior = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_localidad = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_complemento = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_telefonos = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fax = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_idciudad = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchcreado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usucreado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchactualizado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usuactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsSucursal object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIds !== null && $this->ca_id !== $this->aIds->getCaId()) {
			$this->aIds = null;
		}
		if ($this->aCiudad !== null && $this->ca_idciudad !== $this->aCiudad->getCaIdciudad()) {
			$this->aCiudad = null;
		}
	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsSucursalPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCiudad = null;
			$this->aIds = null;
			$this->collIdsContactos = null;
			$this->lastIdsContactoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsSucursal:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsSucursalPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsSucursal:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsSucursal:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsSucursal:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsSucursalPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

												
			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified() || $this->aCiudad->isNew()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
			}

			if ($this->aIds !== null) {
				if ($this->aIds->isModified() || $this->aIds->isNew()) {
					$affectedRows += $this->aIds->save($con);
				}
				$this->setIds($this->aIds);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = IdsSucursalPeer::CA_IDSUCURSAL;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsSucursalPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdsucursal($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += IdsSucursalPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collIdsContactos !== null) {
				foreach ($this->collIdsContactos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


												
			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}

			if ($this->aIds !== null) {
				if (!$this->aIds->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIds->getValidationFailures());
				}
			}


			if (($retval = IdsSucursalPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collIdsContactos !== null) {
					foreach ($this->collIdsContactos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsSucursalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdsucursal();
				break;
			case 1:
				return $this->getCaId();
				break;
			case 2:
				return $this->getCaPrincipal();
				break;
			case 3:
				return $this->getCaDireccion();
				break;
			case 4:
				return $this->getCaOficina();
				break;
			case 5:
				return $this->getCaTorre();
				break;
			case 6:
				return $this->getCaBloque();
				break;
			case 7:
				return $this->getCaInterior();
				break;
			case 8:
				return $this->getCaLocalidad();
				break;
			case 9:
				return $this->getCaComplemento();
				break;
			case 10:
				return $this->getCaTelefonos();
				break;
			case 11:
				return $this->getCaFax();
				break;
			case 12:
				return $this->getCaIdciudad();
				break;
			case 13:
				return $this->getCaFchcreado();
				break;
			case 14:
				return $this->getCaUsucreado();
				break;
			case 15:
				return $this->getCaFchactualizado();
				break;
			case 16:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsSucursalPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdsucursal(),
			$keys[1] => $this->getCaId(),
			$keys[2] => $this->getCaPrincipal(),
			$keys[3] => $this->getCaDireccion(),
			$keys[4] => $this->getCaOficina(),
			$keys[5] => $this->getCaTorre(),
			$keys[6] => $this->getCaBloque(),
			$keys[7] => $this->getCaInterior(),
			$keys[8] => $this->getCaLocalidad(),
			$keys[9] => $this->getCaComplemento(),
			$keys[10] => $this->getCaTelefonos(),
			$keys[11] => $this->getCaFax(),
			$keys[12] => $this->getCaIdciudad(),
			$keys[13] => $this->getCaFchcreado(),
			$keys[14] => $this->getCaUsucreado(),
			$keys[15] => $this->getCaFchactualizado(),
			$keys[16] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsSucursalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdsucursal($value);
				break;
			case 1:
				$this->setCaId($value);
				break;
			case 2:
				$this->setCaPrincipal($value);
				break;
			case 3:
				$this->setCaDireccion($value);
				break;
			case 4:
				$this->setCaOficina($value);
				break;
			case 5:
				$this->setCaTorre($value);
				break;
			case 6:
				$this->setCaBloque($value);
				break;
			case 7:
				$this->setCaInterior($value);
				break;
			case 8:
				$this->setCaLocalidad($value);
				break;
			case 9:
				$this->setCaComplemento($value);
				break;
			case 10:
				$this->setCaTelefonos($value);
				break;
			case 11:
				$this->setCaFax($value);
				break;
			case 12:
				$this->setCaIdciudad($value);
				break;
			case 13:
				$this->setCaFchcreado($value);
				break;
			case 14:
				$this->setCaUsucreado($value);
				break;
			case 15:
				$this->setCaFchactualizado($value);
				break;
			case 16:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsSucursalPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdsucursal($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaPrincipal($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDireccion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaOficina($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTorre($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaBloque($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaInterior($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaLocalidad($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaComplemento($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaTelefonos($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFax($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdciudad($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchcreado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsucreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchactualizado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsuactualizado($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsSucursalPeer::CA_IDSUCURSAL)) $criteria->add(IdsSucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
		if ($this->isColumnModified(IdsSucursalPeer::CA_ID)) $criteria->add(IdsSucursalPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(IdsSucursalPeer::CA_PRINCIPAL)) $criteria->add(IdsSucursalPeer::CA_PRINCIPAL, $this->ca_principal);
		if ($this->isColumnModified(IdsSucursalPeer::CA_DIRECCION)) $criteria->add(IdsSucursalPeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(IdsSucursalPeer::CA_OFICINA)) $criteria->add(IdsSucursalPeer::CA_OFICINA, $this->ca_oficina);
		if ($this->isColumnModified(IdsSucursalPeer::CA_TORRE)) $criteria->add(IdsSucursalPeer::CA_TORRE, $this->ca_torre);
		if ($this->isColumnModified(IdsSucursalPeer::CA_BLOQUE)) $criteria->add(IdsSucursalPeer::CA_BLOQUE, $this->ca_bloque);
		if ($this->isColumnModified(IdsSucursalPeer::CA_INTERIOR)) $criteria->add(IdsSucursalPeer::CA_INTERIOR, $this->ca_interior);
		if ($this->isColumnModified(IdsSucursalPeer::CA_LOCALIDAD)) $criteria->add(IdsSucursalPeer::CA_LOCALIDAD, $this->ca_localidad);
		if ($this->isColumnModified(IdsSucursalPeer::CA_COMPLEMENTO)) $criteria->add(IdsSucursalPeer::CA_COMPLEMENTO, $this->ca_complemento);
		if ($this->isColumnModified(IdsSucursalPeer::CA_TELEFONOS)) $criteria->add(IdsSucursalPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(IdsSucursalPeer::CA_FAX)) $criteria->add(IdsSucursalPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(IdsSucursalPeer::CA_IDCIUDAD)) $criteria->add(IdsSucursalPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(IdsSucursalPeer::CA_FCHCREADO)) $criteria->add(IdsSucursalPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsSucursalPeer::CA_USUCREADO)) $criteria->add(IdsSucursalPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(IdsSucursalPeer::CA_FCHACTUALIZADO)) $criteria->add(IdsSucursalPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(IdsSucursalPeer::CA_USUACTUALIZADO)) $criteria->add(IdsSucursalPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);

		$criteria->add(IdsSucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdsucursal();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdsucursal($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaId($this->ca_id);

		$copyObj->setCaPrincipal($this->ca_principal);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaOficina($this->ca_oficina);

		$copyObj->setCaTorre($this->ca_torre);

		$copyObj->setCaBloque($this->ca_bloque);

		$copyObj->setCaInterior($this->ca_interior);

		$copyObj->setCaLocalidad($this->ca_localidad);

		$copyObj->setCaComplemento($this->ca_complemento);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getIdsContactos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addIdsContacto($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdsucursal(NULL); 
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
			self::$peer = new IdsSucursalPeer();
		}
		return self::$peer;
	}

	
	public function setCiudad(Ciudad $v = null)
	{
		if ($v === null) {
			$this->setCaIdciudad(NULL);
		} else {
			$this->setCaIdciudad($v->getCaIdciudad());
		}

		$this->aCiudad = $v;

						if ($v !== null) {
			$v->addIdsSucursal($this);
		}

		return $this;
	}


	
	public function getCiudad(PropelPDO $con = null)
	{
		if ($this->aCiudad === null && (($this->ca_idciudad !== "" && $this->ca_idciudad !== null))) {
			$c = new Criteria(CiudadPeer::DATABASE_NAME);
			$c->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
			$this->aCiudad = CiudadPeer::doSelectOne($c, $con);
			
		}
		return $this->aCiudad;
	}

	
	public function setIds(Ids $v = null)
	{
		if ($v === null) {
			$this->setCaId(NULL);
		} else {
			$this->setCaId($v->getCaId());
		}

		$this->aIds = $v;

						if ($v !== null) {
			$v->addIdsSucursal($this);
		}

		return $this;
	}


	
	public function getIds(PropelPDO $con = null)
	{
		if ($this->aIds === null && ($this->ca_id !== null)) {
			$c = new Criteria(IdsPeer::DATABASE_NAME);
			$c->add(IdsPeer::CA_ID, $this->ca_id);
			$this->aIds = IdsPeer::doSelectOne($c, $con);
			
		}
		return $this->aIds;
	}

	
	public function clearIdsContactos()
	{
		$this->collIdsContactos = null; 	}

	
	public function initIdsContactos()
	{
		$this->collIdsContactos = array();
	}

	
	public function getIdsContactos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsContactos === null) {
			if ($this->isNew()) {
			   $this->collIdsContactos = array();
			} else {

				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				IdsContactoPeer::addSelectColumns($criteria);
				$this->collIdsContactos = IdsContactoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				IdsContactoPeer::addSelectColumns($criteria);
				if (!isset($this->lastIdsContactoCriteria) || !$this->lastIdsContactoCriteria->equals($criteria)) {
					$this->collIdsContactos = IdsContactoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastIdsContactoCriteria = $criteria;
		return $this->collIdsContactos;
	}

	
	public function countIdsContactos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collIdsContactos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				$count = IdsContactoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				if (!isset($this->lastIdsContactoCriteria) || !$this->lastIdsContactoCriteria->equals($criteria)) {
					$count = IdsContactoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collIdsContactos);
				}
			} else {
				$count = count($this->collIdsContactos);
			}
		}
		return $count;
	}

	
	public function addIdsContacto(IdsContacto $l)
	{
		if ($this->collIdsContactos === null) {
			$this->initIdsContactos();
		}
		if (!in_array($l, $this->collIdsContactos, true)) { 			array_push($this->collIdsContactos, $l);
			$l->setIdsSucursal($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collIdsContactos) {
				foreach ((array) $this->collIdsContactos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collIdsContactos = null;
			$this->aCiudad = null;
			$this->aIds = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsSucursal:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsSucursal::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 