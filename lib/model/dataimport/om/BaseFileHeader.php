<?php


abstract class BaseFileHeader extends BaseObject  implements Persistent {


  const PEER = 'FileHeaderPeer';

	
	protected static $peer;

	
	protected $ca_idfileheader;

	
	protected $ca_descripcion;

	
	protected $ca_tipoarchivo;

	
	protected $ca_separador;

	
	protected $ca_separadordec;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $collFileImporteds;

	
	private $lastFileImportedCriteria = null;

	
	protected $collFileColumns;

	
	private $lastFileColumnCriteria = null;

	
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

	
	public function getCaIdfileheader()
	{
		return $this->ca_idfileheader;
	}

	
	public function getCaDescripcion()
	{
		return $this->ca_descripcion;
	}

	
	public function getCaTipoarchivo()
	{
		return $this->ca_tipoarchivo;
	}

	
	public function getCaSeparador()
	{
		return $this->ca_separador;
	}

	
	public function getCaSeparadordec()
	{
		return $this->ca_separadordec;
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

	
	public function setCaIdfileheader($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idfileheader !== $v) {
			$this->ca_idfileheader = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_IDFILEHEADER;
		}

		return $this;
	} 
	
	public function setCaDescripcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_descripcion !== $v) {
			$this->ca_descripcion = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_DESCRIPCION;
		}

		return $this;
	} 
	
	public function setCaTipoarchivo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipoarchivo !== $v) {
			$this->ca_tipoarchivo = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_TIPOARCHIVO;
		}

		return $this;
	} 
	
	public function setCaSeparador($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_separador !== $v) {
			$this->ca_separador = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_SEPARADOR;
		}

		return $this;
	} 
	
	public function setCaSeparadordec($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_separadordec !== $v) {
			$this->ca_separadordec = $v;
			$this->modifiedColumns[] = FileHeaderPeer::CA_SEPARADORDEC;
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
				$this->modifiedColumns[] = FileHeaderPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = FileHeaderPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = FileHeaderPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = FileHeaderPeer::CA_USUACTUALIZADO;
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

			$this->ca_idfileheader = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_descripcion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_tipoarchivo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_separador = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_separadordec = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchcreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_usucreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchactualizado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usuactualizado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FileHeader object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = FileHeaderPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collFileImporteds = null;
			$this->lastFileImportedCriteria = null;

			$this->collFileColumns = null;
			$this->lastFileColumnCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileHeader:delete:pre') as $callable)
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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FileHeaderPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFileHeader:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileHeader:save:pre') as $callable)
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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFileHeader:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			FileHeaderPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = FileHeaderPeer::CA_IDFILEHEADER;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FileHeaderPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdfileheader($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FileHeaderPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collFileImporteds !== null) {
				foreach ($this->collFileImporteds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFileColumns !== null) {
				foreach ($this->collFileColumns as $referrerFK) {
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


			if (($retval = FileHeaderPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFileImporteds !== null) {
					foreach ($this->collFileImporteds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFileColumns !== null) {
					foreach ($this->collFileColumns as $referrerFK) {
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
		$pos = FileHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdfileheader();
				break;
			case 1:
				return $this->getCaDescripcion();
				break;
			case 2:
				return $this->getCaTipoarchivo();
				break;
			case 3:
				return $this->getCaSeparador();
				break;
			case 4:
				return $this->getCaSeparadordec();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			case 7:
				return $this->getCaFchactualizado();
				break;
			case 8:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FileHeaderPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdfileheader(),
			$keys[1] => $this->getCaDescripcion(),
			$keys[2] => $this->getCaTipoarchivo(),
			$keys[3] => $this->getCaSeparador(),
			$keys[4] => $this->getCaSeparadordec(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
			$keys[7] => $this->getCaFchactualizado(),
			$keys[8] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FileHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdfileheader($value);
				break;
			case 1:
				$this->setCaDescripcion($value);
				break;
			case 2:
				$this->setCaTipoarchivo($value);
				break;
			case 3:
				$this->setCaSeparador($value);
				break;
			case 4:
				$this->setCaSeparadordec($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
			case 7:
				$this->setCaFchactualizado($value);
				break;
			case 8:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FileHeaderPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdfileheader($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDescripcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipoarchivo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaSeparador($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSeparadordec($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchactualizado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsuactualizado($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);

		if ($this->isColumnModified(FileHeaderPeer::CA_IDFILEHEADER)) $criteria->add(FileHeaderPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
		if ($this->isColumnModified(FileHeaderPeer::CA_DESCRIPCION)) $criteria->add(FileHeaderPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(FileHeaderPeer::CA_TIPOARCHIVO)) $criteria->add(FileHeaderPeer::CA_TIPOARCHIVO, $this->ca_tipoarchivo);
		if ($this->isColumnModified(FileHeaderPeer::CA_SEPARADOR)) $criteria->add(FileHeaderPeer::CA_SEPARADOR, $this->ca_separador);
		if ($this->isColumnModified(FileHeaderPeer::CA_SEPARADORDEC)) $criteria->add(FileHeaderPeer::CA_SEPARADORDEC, $this->ca_separadordec);
		if ($this->isColumnModified(FileHeaderPeer::CA_FCHCREADO)) $criteria->add(FileHeaderPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(FileHeaderPeer::CA_USUCREADO)) $criteria->add(FileHeaderPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(FileHeaderPeer::CA_FCHACTUALIZADO)) $criteria->add(FileHeaderPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(FileHeaderPeer::CA_USUACTUALIZADO)) $criteria->add(FileHeaderPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);

		$criteria->add(FileHeaderPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdfileheader();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdfileheader($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaTipoarchivo($this->ca_tipoarchivo);

		$copyObj->setCaSeparador($this->ca_separador);

		$copyObj->setCaSeparadordec($this->ca_separadordec);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getFileImporteds() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addFileImported($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFileColumns() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addFileColumn($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdfileheader(NULL); 
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
			self::$peer = new FileHeaderPeer();
		}
		return self::$peer;
	}

	
	public function clearFileImporteds()
	{
		$this->collFileImporteds = null; 	}

	
	public function initFileImporteds()
	{
		$this->collFileImporteds = array();
	}

	
	public function getFileImporteds($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileImporteds === null) {
			if ($this->isNew()) {
			   $this->collFileImporteds = array();
			} else {

				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				FileImportedPeer::addSelectColumns($criteria);
				$this->collFileImporteds = FileImportedPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				FileImportedPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileImportedCriteria) || !$this->lastFileImportedCriteria->equals($criteria)) {
					$this->collFileImporteds = FileImportedPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileImportedCriteria = $criteria;
		return $this->collFileImporteds;
	}

	
	public function countFileImporteds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFileImporteds === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				$count = FileImportedPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				if (!isset($this->lastFileImportedCriteria) || !$this->lastFileImportedCriteria->equals($criteria)) {
					$count = FileImportedPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFileImporteds);
				}
			} else {
				$count = count($this->collFileImporteds);
			}
		}
		return $count;
	}

	
	public function addFileImported(FileImported $l)
	{
		if ($this->collFileImporteds === null) {
			$this->initFileImporteds();
		}
		if (!in_array($l, $this->collFileImporteds, true)) { 			array_push($this->collFileImporteds, $l);
			$l->setFileHeader($this);
		}
	}

	
	public function clearFileColumns()
	{
		$this->collFileColumns = null; 	}

	
	public function initFileColumns()
	{
		$this->collFileColumns = array();
	}

	
	public function getFileColumns($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileColumns === null) {
			if ($this->isNew()) {
			   $this->collFileColumns = array();
			} else {

				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				FileColumnPeer::addSelectColumns($criteria);
				$this->collFileColumns = FileColumnPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				FileColumnPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileColumnCriteria) || !$this->lastFileColumnCriteria->equals($criteria)) {
					$this->collFileColumns = FileColumnPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileColumnCriteria = $criteria;
		return $this->collFileColumns;
	}

	
	public function countFileColumns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFileColumns === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				$count = FileColumnPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);

				if (!isset($this->lastFileColumnCriteria) || !$this->lastFileColumnCriteria->equals($criteria)) {
					$count = FileColumnPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFileColumns);
				}
			} else {
				$count = count($this->collFileColumns);
			}
		}
		return $count;
	}

	
	public function addFileColumn(FileColumn $l)
	{
		if ($this->collFileColumns === null) {
			$this->initFileColumns();
		}
		if (!in_array($l, $this->collFileColumns, true)) { 			array_push($this->collFileColumns, $l);
			$l->setFileHeader($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collFileImporteds) {
				foreach ((array) $this->collFileImporteds as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFileColumns) {
				foreach ((array) $this->collFileColumns as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collFileImporteds = null;
		$this->collFileColumns = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFileHeader:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFileHeader::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 