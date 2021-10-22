<?php // $Id: recordset.php,v 1.10 2002/10/27 18:02:40 alarion Exp $
/********************************************************************************/
/** Datalib v0.5beta                                                           **/
/** Copyright (C)2000-2001 Sean Finkel                                         **/
/**                                                                            **/
/**                                                                            **/
/** This library is free software; you can redistribute it and/or              **/
/** modify it under the terms of the GNU Lesser General Public                 **/
/** License as published by the Free Software Foundation; either               **/
/** version 2.1 of the License, or (at your option) any later version.         **/
/**                                                                            **/
/** This library is distributed in the hope that it will be useful,            **/
/** but WITHOUT ANY WARRANTY; without even the implied warranty of             **/
/** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU          **/
/** Lesser General Public License for more details.                            **/
/**                                                                            **/
/** You should have received a copy of the GNU Lesser General Public           **/
/** License along with this library; if not, write to the Free Software        **/
/** Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA  **/
/**                                                                            **/
/** @author Sean Finkel <alarion@databound-software.com>                       **/
/** @package DataLib                                                           **/
/********************************************************************************/


class DlRecordset
{
    /**
    * @var resource $mDbCon The database connection resource
    */
    var $mDbCon;
    /**
    * @var object DlDatabase $mDbConnection The database object
    */
    var $mDbConnection;
    /**
    * @var array $mColumnNames An array of column names in the query
    */
    var $mColumnNames;
    /**
    * @var integer $mColumnCount The number of columns in the current query
    */
    var $mColumnCount;
    /**
    * @var integer $mRowCount The number of rows in the current result set
    */
    var $mRowCount;
    /**
    * @var integer $mCurrentRow The number of the current row
    */
    var $mCurrentRow;
    /**
    * @var resource $mResultSet The PHP database result set resource
    */
    var $mResultSet;
    /**
    * @var string $mSql The current SQL query
    */
    var $mSql;
    /**
    * @var string $mErrMsg The last encountered error message
    */
    var $mErrMsg;
    /**
    * @var boolean $mIsAdding true if we are currently adding a new row to the current result set
    */
    var $mIsAdding;
    /**
    * @var boolean $mIsUpdating true if we are currently updating the current row in the result set
    */
    var $mIsUpdating;
    /**
    * @var string $mTableName The name of the table in the current query
    */
    var $mTableName;
    /**
    * @var array $mResultArray An array of the result data
    */
    var $mResultArray;
    /**
    * @var boolean $mEof true if we are at the end of the result set
    */
    var $mEof;
    /**
    * @var boolean $mBof true if we are at the beginning of the result set
    */
    var $mBof;
    /**
    * @var string $mDbName the name of the database to use
    */
    var $mDbName;
    /**
    * @var array $mDataSet our table of data
    */
    var $mDataset;
    /**
    * @var string $mMode the fetch mode of the recordset: either 'fetch' or 'ado'
    */
    var $mMode;
    /**
    * The DlRecordset Constructor
    *
    * The constructor takes in a DlRecordset (or inherited) object and sets up initial members
    * @param object DlRecordset $connection A DlRecordset object, passed by reference
    */
    function DlRecordset($connection)
    {
       $this->mColumns = null;
       $this->mRowCount = 0;
       $this->mCurrentRow = 0;
       $this->mResultSet = null;
       $this->mSql = "";
       $this->mErrMsg = "";
       $this->mIsAdding = False;
       $this->mIsUpdating = False;
       $this->mEof = False;
       $this->mBof = False;
       $this->mDbConnection = $connection;
       $this->mDbCon = $connection->mDbCon;
       $this->mDataSet = array();
       $this->mMode = 'ado';    // default to ADO style retrieval
    } // function DlRecordset (constructor)

/**
    * Moves to the first row in the dataset
    *
    * Moves to the first row in the dataset
    * @return boolean
    */
    function MoveFirst() {                      // attempt to move to the first row
        if ($this->IsEmpty()) { return (false); }

        if (!$this->mResultSet) {
            $this->mErrMsg = "There is no result set to work with";
            return (false);
        }
        $this->mCurrentRow = 0;

        $this->mEof = False;
        $this->mBof = True;
        return (true);
    } // function movefirst

    /**
    * Moves to the next row in the dataset
    *
    * Moves to the next row in the dataset
    * @return boolean
    */
    function MoveNext() {                      // move to the next row
        if($this->IsEmpty()) { return (false); }

        if (!$this->mResultSet) {
            $this->mErrMsg = "There is no result set to work with";
            return false;
        }
        if ($this->mMode === 'fetch') {
            if ($this->mCurrentRow >= $this->mRowCount) {
                $this->MoveLast();
                return (true);
            } else {
                $this->mBof = False;
                $this->mEof = False;
                $this->mCurrentRow++;
                return (true);
            }
        } else {
            if ($this->mCurrentRow >= $this->mRowCount-1) {
                $this->MoveLast();
                return true;
            } else {
                $this->mBof = false;
                $this->mEof = false;
                $this->mCurrentRow++;
                return true;
            }
        }
    } // function movenext

    /**
    * Moves to the previous row in the dataset
    *
    * Moves to the previous row in the dataset
    * @return boolean
    */
    function MovePrevious() {                  // attempt to move to the previous row
        if($this->IsEmpty()) { return (false); }

        if (!$this->mResultSet) {
            $this->mErrMsg = "There is no result set to work with";
            return (false);
        }

        if ($this->mCurrentRow <= 0) {
            $this->MoveFirst();
            return (true);
        } else {
            $this->mBof = False;
            $this->mEof = False;
            $this->mCurrentRow--;             // we move back one
            return (true);
        }
    } // function moveprevious

    /**
    * Moves to the last row in the dataset
    *
    * Moves to the last row in the dataset
    * @return boolean
    */
    function MoveLast() {                      // attempt to move to the last row
        if($this->IsEmpty()) { return (false); }

        if (!$this->mResultSet) {
            $this->mErrMsg = "There is no result set to work with";
            return (false);
        }

        $this->mCurrentRow = $this->mRowCount-1;
        $this->mEof = true;
        $this->mBof = false;
        return (true);
    } // function movelast

    /**
    * Returns the value for the field
    *
    * Returns the value for the requested field on the current row in the dataset
    * @param mixed $field the field to return the value for, can either be a string or a long
    * @return mixed
    */
    function Value($field) {
        return $this->mDataSet[$this->mCurrentRow][$field];

    } // function value

    /**
    * Gets the number of rows in the current result set
    *
    * Gets the number of rows in the current result set
    * @return boolean
    */
    function GetRowCount() {
        return $this->mRowCount;
    }

    /**
    * Is the result set at the end?
    *
    * Check the member var $mEof to see if we are at the end of the result set
    * @return boolean
    */
    function Eof()
    {
       return($this->mEof);
    } // function eof

    /**
    * Is the result set at the beginning?
    *
    * Check the member var $mBof to see if we are at the beginning of the result set
    * @return boolean
    */
    function Bof()
    {
       return($this->mBof);
    } // function bof

    /**
    * Returns the last error encountered
    *
    * Returns the last error encountered by the result set object
    * @return string
    */
    function GetError()                        // returns the last error message
    {
       return($this->mErrMsg);
    } // function geterror

    /**
    * Check to see if the resultset is empty
    *
    * Checks the row count to see if it is zero
    * @return boolean
    */
    function IsEmpty()
    {
       if($this->mRowCount == 0) {
           $this->mBof = true;
           $this->mEof = true;
           $this->mCurrentRow = 0;
           return(true);
       } else { return(false); }
    } // function IsEmpty

    /**
    * Gets the table name for the current query
    *
    * Currently only works correctly with single table queries
    * @return string
    */
    function GetTableName()
    {
        $tok = strtok($this->mSql, " ");
        while (strtoupper($tok) <> "FROM")
        {
            $tok = strtok(" ");
        }
        $tok = strtok(" ");
        return($tok);
    } // function gettablename

    /**
    * Returns the current row as an array
    *
    * Returns the current row in the data set as an indexed and associative array
    * @return array
    * @return boolean
    */
    function FetchArray() {
        if ($this->mMode === 'ado') { $this->mMode = 'fetch'; }

        if ($this->Eof()) {
            //$this->MoveLast();
            return false;
        } else {
            $row = $this->mDataSet[$this->mCurrentRow];
            $this->MoveNext();
            return $row;
        }
    }

    /**
    * Returns the current row number
    *
    * Returns the current row number, starting with 1
    * @return integer
    */
    function GetCurrentRow() {
        if ($this->mMode === 'fetch') {
            return $this->mCurrentRow;
        } else {
            return $this->mCurrentRow+1;
        }
    }

    /**
    * Creates a new recordset object
    *
    * Returns a recordset object of the appropriate type
    * @param DlRecordset $connection A DlRecordset (or inherited from) object
    * @return object DlRecordset
    */
    function NewRecordset(&$connection)
    {
        $recordset = null;
        switch ($connection->mDbType)
        {
            case "ODBC":
                if(!defined('rsODBC'))
                    include_once("include/odbc-recordset.php");
                return new DlOdbcRecordset($connection);
                break;
            case "MySQL":
                if(!defined('rsMySQL'))
                    include_once("include/mysql-recordset.php");
                return new DlMySqlRecordset($connection);
                break;
            case "Sybase":
                if(!defined('rsSybase'))
                    include_once("include/sybase-recordset.php");
                return new DlSybaseRecordset($connection);
                break;
            case "Oracle":
                if(!defined('rsOracle'))
                    include_once("include/oracle8-recordset.php");
                return new DlOracleRecordset($connection);
                break;
            case "MSSQL":
                if(!defined('rsMSSQL'))
                    include_once("include/sqlserver-recordset.php");
                return new DlSqlServerRecordset($connection);
                break;
            case "PGSQL":
                if(!defined('rsPGSQL'))
                    include_once("include/pgsql-recordset.php");
                return new DlPgSqlRecordset($connection);
                break;
            case "Ibase":
                if (!defined('rsIbase'))
                    include_once("include/ibase-recordset.php");
                return new DlIBaseRecordset($connection);
                break;
            default:
                die("No or invalid database type selected in your recordset object");
       }
    }
} // class DlRecordset
?>