<?php


abstract class BaseFalaDetail extends BaseObject  implements Persistent {


  const PEER = 'FalaDetailPeer';

	
	protected static $peer;

	
	protected $ca_iddoc;

	
	protected $ca_sku;

	
	protected $ca_vpn;

	
	protected $ca_num_cont_part1;

	
	protected $ca_num_cont_part2;

	
	protected $ca_num_cont_sell;

	
	protected $ca_container_iso;

	
	protected $ca_cantidad_pedido;

	
	protected $ca_cantidad_miles;

	
	protected $ca_unidad_medidad_cantidad;

	
	protected $ca_descripcion_item;

	
	protected $ca_cantidad_paquetes_miles;

	
	protected $ca_unidad_medida_paquetes;

	
	protected $ca_cantidad_volumen_miles;

	
	protected $ca_unidad_medida_volumen;

	
	protected $ca_cantidad_peso_miles;

	
	protected $ca_unidad_medida_peso;

	
	protected $aFalaHeader;

	
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

	
	public function getCaIddoc()
	{
		return $this->ca_iddoc;
	}

	
	public function getCaSku()
	{
		return $this->ca_sku;
	}

	
	public function getCaVpn()
	{
		return $this->ca_vpn;
	}

	
	public function getCaNumContPart1()
	{
		return $this->ca_num_cont_part1;
	}

	
	public function getCaNumContPart2()
	{
		return $this->ca_num_cont_part2;
	}

	
	public function getCaNumContSell()
	{
		return $this->ca_num_cont_sell;
	}

	
	public function getCaContainerIso()
	{
		return $this->ca_container_iso;
	}

	
	public function getCaCantidadPedido()
	{
		return $this->ca_cantidad_pedido;
	}

	
	public function getCaCantidadMiles()
	{
		return $this->ca_cantidad_miles;
	}

	
	public function getCaUnidadMedidadCantidad()
	{
		return $this->ca_unidad_medidad_cantidad;
	}

	
	public function getCaDescripcionItem()
	{
		return $this->ca_descripcion_item;
	}

	
	public function getCaCantidadPaquetesMiles()
	{
		return $this->ca_cantidad_paquetes_miles;
	}

	
	public function getCaUnidadMedidaPaquetes()
	{
		return $this->ca_unidad_medida_paquetes;
	}

	
	public function getCaCantidadVolumenMiles()
	{
		return $this->ca_cantidad_volumen_miles;
	}

	
	public function getCaUnidadMedidaVolumen()
	{
		return $this->ca_unidad_medida_volumen;
	}

	
	public function getCaCantidadPesoMiles()
	{
		return $this->ca_cantidad_peso_miles;
	}

	
	public function getCaUnidadMedidaPeso()
	{
		return $this->ca_unidad_medida_peso;
	}

	
	public function setCaIddoc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_iddoc !== $v) {
			$this->ca_iddoc = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_IDDOC;
		}

		if ($this->aFalaHeader !== null && $this->aFalaHeader->getCaIddoc() !== $v) {
			$this->aFalaHeader = null;
		}

		return $this;
	} 
	
	public function setCaSku($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sku !== $v) {
			$this->ca_sku = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_SKU;
		}

		return $this;
	} 
	
	public function setCaVpn($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vpn !== $v) {
			$this->ca_vpn = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_VPN;
		}

		return $this;
	} 
	
	public function setCaNumContPart1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_num_cont_part1 !== $v) {
			$this->ca_num_cont_part1 = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_NUM_CONT_PART1;
		}

		return $this;
	} 
	
	public function setCaNumContPart2($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_num_cont_part2 !== $v) {
			$this->ca_num_cont_part2 = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_NUM_CONT_PART2;
		}

		return $this;
	} 
	
	public function setCaNumContSell($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_num_cont_sell !== $v) {
			$this->ca_num_cont_sell = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_NUM_CONT_SELL;
		}

		return $this;
	} 
	
	public function setCaContainerIso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_container_iso !== $v) {
			$this->ca_container_iso = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CONTAINER_ISO;
		}

		return $this;
	} 
	
	public function setCaCantidadPedido($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_cantidad_pedido !== $v) {
			$this->ca_cantidad_pedido = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_PEDIDO;
		}

		return $this;
	} 
	
	public function setCaCantidadMiles($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_cantidad_miles !== $v) {
			$this->ca_cantidad_miles = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_MILES;
		}

		return $this;
	} 
	
	public function setCaUnidadMedidadCantidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_unidad_medidad_cantidad !== $v) {
			$this->ca_unidad_medidad_cantidad = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD;
		}

		return $this;
	} 
	
	public function setCaDescripcionItem($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_descripcion_item !== $v) {
			$this->ca_descripcion_item = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_DESCRIPCION_ITEM;
		}

		return $this;
	} 
	
	public function setCaCantidadPaquetesMiles($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cantidad_paquetes_miles !== $v) {
			$this->ca_cantidad_paquetes_miles = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES;
		}

		return $this;
	} 
	
	public function setCaUnidadMedidaPaquetes($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_unidad_medida_paquetes !== $v) {
			$this->ca_unidad_medida_paquetes = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES;
		}

		return $this;
	} 
	
	public function setCaCantidadVolumenMiles($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cantidad_volumen_miles !== $v) {
			$this->ca_cantidad_volumen_miles = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES;
		}

		return $this;
	} 
	
	public function setCaUnidadMedidaVolumen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_unidad_medida_volumen !== $v) {
			$this->ca_unidad_medida_volumen = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN;
		}

		return $this;
	} 
	
	public function setCaCantidadPesoMiles($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cantidad_peso_miles !== $v) {
			$this->ca_cantidad_peso_miles = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_CANTIDAD_PESO_MILES;
		}

		return $this;
	} 
	
	public function setCaUnidadMedidaPeso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_unidad_medida_peso !== $v) {
			$this->ca_unidad_medida_peso = $v;
			$this->modifiedColumns[] = FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO;
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

			$this->ca_iddoc = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_sku = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_vpn = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_num_cont_part1 = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_num_cont_part2 = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_num_cont_sell = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_container_iso = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_cantidad_pedido = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->ca_cantidad_miles = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_unidad_medidad_cantidad = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_descripcion_item = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_cantidad_paquetes_miles = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_unidad_medida_paquetes = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_cantidad_volumen_miles = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_unidad_medida_volumen = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_cantidad_peso_miles = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_unidad_medida_peso = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FalaDetail object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aFalaHeader !== null && $this->ca_iddoc !== $this->aFalaHeader->getCaIddoc()) {
			$this->aFalaHeader = null;
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
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = FalaDetailPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aFalaHeader = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaDetail:delete:pre') as $callable)
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
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FalaDetailPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFalaDetail:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaDetail:save:pre') as $callable)
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
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFalaDetail:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			FalaDetailPeer::addInstanceToPool($this);
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

												
			if ($this->aFalaHeader !== null) {
				if ($this->aFalaHeader->isModified() || $this->aFalaHeader->isNew()) {
					$affectedRows += $this->aFalaHeader->save($con);
				}
				$this->setFalaHeader($this->aFalaHeader);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FalaDetailPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += FalaDetailPeer::doUpdate($this, $con);
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


												
			if ($this->aFalaHeader !== null) {
				if (!$this->aFalaHeader->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFalaHeader->getValidationFailures());
				}
			}


			if (($retval = FalaDetailPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaDetailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIddoc();
				break;
			case 1:
				return $this->getCaSku();
				break;
			case 2:
				return $this->getCaVpn();
				break;
			case 3:
				return $this->getCaNumContPart1();
				break;
			case 4:
				return $this->getCaNumContPart2();
				break;
			case 5:
				return $this->getCaNumContSell();
				break;
			case 6:
				return $this->getCaContainerIso();
				break;
			case 7:
				return $this->getCaCantidadPedido();
				break;
			case 8:
				return $this->getCaCantidadMiles();
				break;
			case 9:
				return $this->getCaUnidadMedidadCantidad();
				break;
			case 10:
				return $this->getCaDescripcionItem();
				break;
			case 11:
				return $this->getCaCantidadPaquetesMiles();
				break;
			case 12:
				return $this->getCaUnidadMedidaPaquetes();
				break;
			case 13:
				return $this->getCaCantidadVolumenMiles();
				break;
			case 14:
				return $this->getCaUnidadMedidaVolumen();
				break;
			case 15:
				return $this->getCaCantidadPesoMiles();
				break;
			case 16:
				return $this->getCaUnidadMedidaPeso();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FalaDetailPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIddoc(),
			$keys[1] => $this->getCaSku(),
			$keys[2] => $this->getCaVpn(),
			$keys[3] => $this->getCaNumContPart1(),
			$keys[4] => $this->getCaNumContPart2(),
			$keys[5] => $this->getCaNumContSell(),
			$keys[6] => $this->getCaContainerIso(),
			$keys[7] => $this->getCaCantidadPedido(),
			$keys[8] => $this->getCaCantidadMiles(),
			$keys[9] => $this->getCaUnidadMedidadCantidad(),
			$keys[10] => $this->getCaDescripcionItem(),
			$keys[11] => $this->getCaCantidadPaquetesMiles(),
			$keys[12] => $this->getCaUnidadMedidaPaquetes(),
			$keys[13] => $this->getCaCantidadVolumenMiles(),
			$keys[14] => $this->getCaUnidadMedidaVolumen(),
			$keys[15] => $this->getCaCantidadPesoMiles(),
			$keys[16] => $this->getCaUnidadMedidaPeso(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaDetailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIddoc($value);
				break;
			case 1:
				$this->setCaSku($value);
				break;
			case 2:
				$this->setCaVpn($value);
				break;
			case 3:
				$this->setCaNumContPart1($value);
				break;
			case 4:
				$this->setCaNumContPart2($value);
				break;
			case 5:
				$this->setCaNumContSell($value);
				break;
			case 6:
				$this->setCaContainerIso($value);
				break;
			case 7:
				$this->setCaCantidadPedido($value);
				break;
			case 8:
				$this->setCaCantidadMiles($value);
				break;
			case 9:
				$this->setCaUnidadMedidadCantidad($value);
				break;
			case 10:
				$this->setCaDescripcionItem($value);
				break;
			case 11:
				$this->setCaCantidadPaquetesMiles($value);
				break;
			case 12:
				$this->setCaUnidadMedidaPaquetes($value);
				break;
			case 13:
				$this->setCaCantidadVolumenMiles($value);
				break;
			case 14:
				$this->setCaUnidadMedidaVolumen($value);
				break;
			case 15:
				$this->setCaCantidadPesoMiles($value);
				break;
			case 16:
				$this->setCaUnidadMedidaPeso($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FalaDetailPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIddoc($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaSku($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVpn($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaNumContPart1($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaNumContPart2($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNumContSell($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaContainerIso($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaCantidadPedido($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaCantidadMiles($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUnidadMedidadCantidad($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaDescripcionItem($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaCantidadPaquetesMiles($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUnidadMedidaPaquetes($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaCantidadVolumenMiles($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUnidadMedidaVolumen($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaCantidadPesoMiles($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUnidadMedidaPeso($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FalaDetailPeer::DATABASE_NAME);

		if ($this->isColumnModified(FalaDetailPeer::CA_IDDOC)) $criteria->add(FalaDetailPeer::CA_IDDOC, $this->ca_iddoc);
		if ($this->isColumnModified(FalaDetailPeer::CA_SKU)) $criteria->add(FalaDetailPeer::CA_SKU, $this->ca_sku);
		if ($this->isColumnModified(FalaDetailPeer::CA_VPN)) $criteria->add(FalaDetailPeer::CA_VPN, $this->ca_vpn);
		if ($this->isColumnModified(FalaDetailPeer::CA_NUM_CONT_PART1)) $criteria->add(FalaDetailPeer::CA_NUM_CONT_PART1, $this->ca_num_cont_part1);
		if ($this->isColumnModified(FalaDetailPeer::CA_NUM_CONT_PART2)) $criteria->add(FalaDetailPeer::CA_NUM_CONT_PART2, $this->ca_num_cont_part2);
		if ($this->isColumnModified(FalaDetailPeer::CA_NUM_CONT_SELL)) $criteria->add(FalaDetailPeer::CA_NUM_CONT_SELL, $this->ca_num_cont_sell);
		if ($this->isColumnModified(FalaDetailPeer::CA_CONTAINER_ISO)) $criteria->add(FalaDetailPeer::CA_CONTAINER_ISO, $this->ca_container_iso);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_PEDIDO)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_PEDIDO, $this->ca_cantidad_pedido);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_MILES)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_MILES, $this->ca_cantidad_miles);
		if ($this->isColumnModified(FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD)) $criteria->add(FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD, $this->ca_unidad_medidad_cantidad);
		if ($this->isColumnModified(FalaDetailPeer::CA_DESCRIPCION_ITEM)) $criteria->add(FalaDetailPeer::CA_DESCRIPCION_ITEM, $this->ca_descripcion_item);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES, $this->ca_cantidad_paquetes_miles);
		if ($this->isColumnModified(FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES)) $criteria->add(FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES, $this->ca_unidad_medida_paquetes);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES, $this->ca_cantidad_volumen_miles);
		if ($this->isColumnModified(FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN)) $criteria->add(FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN, $this->ca_unidad_medida_volumen);
		if ($this->isColumnModified(FalaDetailPeer::CA_CANTIDAD_PESO_MILES)) $criteria->add(FalaDetailPeer::CA_CANTIDAD_PESO_MILES, $this->ca_cantidad_peso_miles);
		if ($this->isColumnModified(FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO)) $criteria->add(FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO, $this->ca_unidad_medida_peso);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FalaDetailPeer::DATABASE_NAME);

		$criteria->add(FalaDetailPeer::CA_IDDOC, $this->ca_iddoc);
		$criteria->add(FalaDetailPeer::CA_SKU, $this->ca_sku);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIddoc();

		$pks[1] = $this->getCaSku();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIddoc($keys[0]);

		$this->setCaSku($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIddoc($this->ca_iddoc);

		$copyObj->setCaSku($this->ca_sku);

		$copyObj->setCaVpn($this->ca_vpn);

		$copyObj->setCaNumContPart1($this->ca_num_cont_part1);

		$copyObj->setCaNumContPart2($this->ca_num_cont_part2);

		$copyObj->setCaNumContSell($this->ca_num_cont_sell);

		$copyObj->setCaContainerIso($this->ca_container_iso);

		$copyObj->setCaCantidadPedido($this->ca_cantidad_pedido);

		$copyObj->setCaCantidadMiles($this->ca_cantidad_miles);

		$copyObj->setCaUnidadMedidadCantidad($this->ca_unidad_medidad_cantidad);

		$copyObj->setCaDescripcionItem($this->ca_descripcion_item);

		$copyObj->setCaCantidadPaquetesMiles($this->ca_cantidad_paquetes_miles);

		$copyObj->setCaUnidadMedidaPaquetes($this->ca_unidad_medida_paquetes);

		$copyObj->setCaCantidadVolumenMiles($this->ca_cantidad_volumen_miles);

		$copyObj->setCaUnidadMedidaVolumen($this->ca_unidad_medida_volumen);

		$copyObj->setCaCantidadPesoMiles($this->ca_cantidad_peso_miles);

		$copyObj->setCaUnidadMedidaPeso($this->ca_unidad_medida_peso);


		$copyObj->setNew(true);

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
			self::$peer = new FalaDetailPeer();
		}
		return self::$peer;
	}

	
	public function setFalaHeader(FalaHeader $v = null)
	{
		if ($v === null) {
			$this->setCaIddoc(NULL);
		} else {
			$this->setCaIddoc($v->getCaIddoc());
		}

		$this->aFalaHeader = $v;

						if ($v !== null) {
			$v->addFalaDetail($this);
		}

		return $this;
	}


	
	public function getFalaHeader(PropelPDO $con = null)
	{
		if ($this->aFalaHeader === null && (($this->ca_iddoc !== "" && $this->ca_iddoc !== null))) {
			$c = new Criteria(FalaHeaderPeer::DATABASE_NAME);
			$c->add(FalaHeaderPeer::CA_IDDOC, $this->ca_iddoc);
			$this->aFalaHeader = FalaHeaderPeer::doSelectOne($c, $con);
			
		}
		return $this->aFalaHeader;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aFalaHeader = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFalaDetail:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFalaDetail::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 