<?
define('rsOracle', 'yes');
// $Id: oracle8-recordset.php,v 1.8 2002/10/27 18:02:40 alarion Exp $
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

class DlOracleRecordset extends DlRecordset {       // the ODBC recordset object

    /**
    * Executes the query
    *
    * Executes the SQL query and loads the data into a dataset/table
    * @param string $sql the SQL query to execute
    * @return boolean
    */
    function Open($sql) {
        $this->mSql = $sql;
        $this->mResultSet = OCIParse($this->mDbCon, $this->mSql);
        OCIExecute($this->mResultSet);
        $this->mColumnCount = OCINumCols($this->mResultSet);
        $this->LoadData();
        $this->mRowCount = OCIRowCount($this->mResultSet);
        $this->MoveFirst();

        return (true);
    } // function open

    /**
    * Loads data into array
    *
    * Loads all rows from the query into an internal array
    */
    function LoadData() {
        $this->mDataSet = array();
        while (OCIFetchInto($this->mResultSet, &$row, OCI_ASSOC+OCI_NUM)) {
            array_push($this->mDataSet, $row);
            $row = array();
        }
    }

    /**
    * Frees memory associated with the recordset
    *
    * Closes the recordset and frees associated memory
    * @return boolean
    */
    function Close() {
        if (!OCIFreeStatement($this->mResultSet)) {
            $this->mErrMsg = "Could not free memory.";
            return (false);
        }
        return (true);
    } // function close
} // class ODBCRecordset
?>
