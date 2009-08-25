<?php


abstract class BaseFileColumn extends BaseObject  implements Persistent {


  const PEER = 'FileColumnPeer';

	
	protected static $peer;

	
	protected $ca_idfileheader;

	
	protected $ca_idcolumna;

	
	protected $ca_columna;

	
	protected $ca_label;

	
	protected $ca_mascara;

	
	protected $ca_tipo;

	
	protected $ca_longitud;

	
	protected $ca_precision;

	
	protected $ca_idregistro;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $aFileHeader;

	
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

	
	public function getCaIdcolumna()
	{
		return $this->ca_idcolumna;
	}

	
	public function getCaColumna()
	{
		return $this->ca_columna;
	}

	
	public function getCaLabel()
	{
		return $this->ca_label;
	}

	
	public function getCaMascara()
	{
		return $this->ca_mascara;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaLongitud()
	{
		return $this->ca_longitud;
	}

	
	public function getCaPrecision()
	{
		return $this->ca_precision;
	}

	
	public function getCaIdregistro()
	{
		return $this->ca_idregistro;
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
			$this->modifiedColumns[] = FileColumnPeer::CA_IDFILEHEADER;
		}

		if ($this->aFileHeader !== null && $this->aFileHeader->getCaIdfileheader() !== $v) {
			$this->aFileHeader = null;
		}

		return $this;
	} 
	
	public function setCaIdcolumna($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcolumna !== $v) {
			$this->ca_idcolumna = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_IDCOLUMNA;
		}

		return $this;
	} 
	
	public function setCaColumna($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_columna !== $v) {
			$this->ca_columna = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_COLUMNA;
		}

		return $this;
	} 
	
	public function setCaLabel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_label !== $v) {
			$this->ca_label = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_LABEL;
		}

		return $this;
	} 
	
	public function setCaMascara($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mascara !== $v) {
			$this->ca_mascara = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_MASCARA;
		}

		return $this;
	} 
	
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaLongitud($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_longitud !== $v) {
			$this->ca_longitud = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_LONGITUD;
		}

		return $this;
	} 
	
	public function setCaPrecision($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_precision !== $v) {
			$this->ca_precision = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_PRECISION;
		}

		return $this;
	} 
	
	public function setCaIdregistro($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idregistro !== $v) {
			$this->ca_idregistro = $v;
			$this->modifiedColumns[] = FileColumnPeer::CA_IDREGISTRO;
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
				$this->modifiedColumns[] = FileColumnPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = FileColumnPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = FileColumnPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = FileColumnPeer::CA_USUACTUALIZADO;
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
			$this->ca_idcolumna = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_columna = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_label = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_mascara = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_tipo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_longitud = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ca_precision = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->ca_idregistro = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_fchcreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_usucreado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchactualizado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usuactualizado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FileColumn object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aFileHeader !== null && $this->ca_idfileheader !== $this->aFileHeader->getCaIdfileheader()) {
			$this->aFileHeader = null;
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
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = FileColumnPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aFileHeader = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileColumn:delete:pre') as $callable)
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
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FileColumnPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFileColumn:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileColumn:save:pre') as $callable)
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
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFileColumn:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			FileColumnPeer::addInstanceToPool($this);
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

												
			if ($this->aFileHeader !== null) {
				if ($this->aFileHeader->isModified() || $this->aFileHeader->isNew()) {
					$affectedRows += $this->aFileHeader->save($con);
				}
				$this->setFileHeader($this->aFileHeader);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = FileColumnPeer::CA_IDCOLUMNA;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FileColumnPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdcolumna($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FileColumnPeer::doUpdate($this, $con);
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


												
			if ($this->aFileHeader !== null) {
				if (!$this->aFileHeader->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFileHeader->getValidationFailures());
				}
			}


			if (($retval = FileColumnPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FileColumnPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcolumna();
				break;
			case 2:
				return $this->getCaColumna();
				break;
			case 3:
				return $this->getCaLabel();
				break;
			case 4:
				return $this->getCaMascara();
				break;
			case 5:
				return $this->getCaTipo();
				break;
			case 6:
				return $this->getCaLongitud();
				break;
			case 7:
				return $this->getCaPrecision();
				break;
			case 8:
				return $this->getCaIdregistro();
				break;
			case 9:
				return $this->getCaFchcreado();
				break;
			case 10:
				return $this->getCaUsucreado();
				break;
			case 11:
				return $this->getCaFchactualizado();
				break;
			case 12:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FileColumnPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdfileheader(),
			$keys[1] => $this->getCaIdcolumna(),
			$keys[2] => $this->getCaColumna(),
			$keys[3] => $this->getCaLabel(),
			$keys[4] => $this->getCaMascara(),
			$keys[5] => $this->getCaTipo(),
			$keys[6] => $this->getCaLongitud(),
			$keys[7] => $this->getCaPrecision(),
			$keys[8] => $this->getCaIdregistro(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaUsucreado(),
			$keys[11] => $this->getCaFchactualizado(),
			$keys[12] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FileColumnPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdfileheader($value);
				break;
			case 1:
				$this->setCaIdcolumna($value);
				break;
			case 2:
				$this->setCaColumna($value);
				break;
			case 3:
				$this->setCaLabel($value);
				break;
			case 4:
				$this->setCaMascara($value);
				break;
			case 5:
				$this->setCaTipo($value);
				break;
			case 6:
				$this->setCaLongitud($value);
				break;
			case 7:
				$this->setCaPrecision($value);
				break;
			case 8:
				$this->setCaIdregistro($value);
				break;
			case 9:
				$this->setCaFchcreado($value);
				break;
			case 10:
				$this->setCaUsucreado($value);
				break;
			case 11:
				$this->setCaFchactualizado($value);
				break;
			case 12:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FileColumnPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdfileheader($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcolumna($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaColumna($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLabel($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaMascara($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTipo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaLongitud($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaPrecision($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdregistro($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsucreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsuactualizado($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FileColumnPeer::DATABASE_NAME);

		if ($this->isColumnModified(FileColumnPeer::CA_IDFILEHEADER)) $criteria->add(FileColumnPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
		if ($this->isColumnModified(FileColumnPeer::CA_IDCOLUMNA)) $criteria->add(FileColumnPeer::CA_IDCOLUMNA, $this->ca_idcolumna);
		if ($this->isColumnModified(FileColumnPeer::CA_COLUMNA)) $criteria->add(FileColumnPeer::CA_COLUMNA, $this->ca_columna);
		if ($this->isColumnModified(FileColumnPeer::CA_LABEL)) $criteria->add(FileColumnPeer::CA_LABEL, $this->ca_label);
		if ($this->isColumnModified(FileColumnPeer::CA_MASCARA)) $criteria->add(FileColumnPeer::CA_MASCARA, $this->ca_mascara);
		if ($this->isColumnModified(FileColumnPeer::CA_TIPO)) $criteria->add(FileColumnPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(FileColumnPeer::CA_LONGITUD)) $criteria->add(FileColumnPeer::CA_LONGITUD, $this->ca_longitud);
		if ($this->isColumnModified(FileColumnPeer::CA_PRECISION)) $criteria->add(FileColumnPeer::CA_PRECISION, $this->ca_precision);
		if ($this->isColumnModified(FileColumnPeer::CA_IDREGISTRO)) $criteria->add(FileColumnPeer::CA_IDREGISTRO, $this->ca_idregistro);
		if ($this->isColumnModified(FileColumnPeer::CA_FCHCREADO)) $criteria->add(FileColumnPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(FileColumnPeer::CA_USUCREADO)) $criteria->add(FileColumnPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(FileColumnPeer::CA_FCHACTUALIZADO)) $criteria->add(FileColumnPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(FileColumnPeer::CA_USUACTUALIZADO)) $criteria->add(FileColumnPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FileColumnPeer::DATABASE_NAME);

		$criteria->add(FileColumnPeer::CA_IDCOLUMNA, $this->ca_idcolumna);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcolumna();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcolumna($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdfileheader($this->ca_idfileheader);

		$copyObj->setCaColumna($this->ca_columna);

		$copyObj->setCaLabel($this->ca_label);

		$copyObj->setCaMascara($this->ca_mascara);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaLongitud($this->ca_longitud);

		$copyObj->setCaPrecision($this->ca_precision);

		$copyObj->setCaIdregistro($this->ca_idregistro);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		$copyObj->setNew(true);

		$copyObj->setCaIdcolumna(NULL); 
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
			self::$peer = new FileColumnPeer();
		}
		return self::$peer;
	}

	
	public function setFileHeader(FileHeader $v = null)
	{
		if ($v === null) {
			$this->setCaIdfileheader(NULL);
		} else {
			$this->setCaIdfileheader($v->getCaIdfileheader());
		}

		$this->aFileHeader = $v;

						if ($v !== null) {
			$v->addFileColumn($this);
		}

		return $this;
	}


	
	public function getFileHeader(PropelPDO $con = null)
	{
		if ($this->aFileHeader === null && ($this->ca_idfileheader !== null)) {
			$c = new Criteria(FileHeaderPeer::DATABASE_NAME);
			$c->add(FileHeaderPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
			$this->aFileHeader = FileHeaderPeer::doSelectOne($c, $con);
			
		}
		return $this->aFileHeader;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aFileHeader = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFileColumn:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFileColumn::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 