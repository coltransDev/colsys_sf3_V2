<?
define('rsODBC', 'yes');
// $Id: odbc-recordset.php,v 1.7 2002/10/27 18:02:57 alarion Exp $
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

class DlOdbcRecordset extends DlRecordset {
    /**
    * @var integer $mBMode the binmode setting for the ODBC driver
    */
    var $mBMode = 1;
    /**
    * @var integer $mChunk the longreadlen setting for the ODBC driver
    */
    var $mChunk = 4096;

    /**
    * Executes the query
    *
    * Executes the SQL query and loads the data into a dataset/table
    * @param string $sql the SQL query to execute
    * @return boolean
    */
    function Open ($sql){
        $this->mResultSet = null;                  // initialize to Null
        $this->mSql = $sql;
        $this->mResultSet = odbc_exec($this->mDbCon, $this->mSql);

        if (!$this->mResultSet) {                    // query failed
            $this->mErrMsg = "Query could not be executed";
            return (false);
        }
        $this->mColumnCount = odbc_num_fields($this->mResultSet);



        if ($i > 0) { $this->mRowCount = $i; }   // not using $this->getrowcount for this driver

        $this->LoadData();
        $this->mRowCount = odbc_num_rows($this->mResultSet);
        $this->MoveFirst();
        return (true);
    } // function open

    /**
    * Loads the data into an array
    *
    * Loads the result data into an array
    */
    function LoadData() {
        $this->mDataSet = array();
        while (odbc_fetch_into($this->mResultSet, $row)) {
            /**
            * WORKAROUND:
            * Since the PHP ODBC functions can't return an array that
            * contains both indexed and associative keys, we do it ourselves
            */
            $assoc_row = array();
            foreach ($row as $key=>$val) {
                $field_name = odbc_field_name($this->mResultSet, $key+1);
                $assoc_row[$field_name] = $val;
            }
            $row = array_merge($row, $assoc_row);
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
    function Close() {                         // free memory associated with the result set
        if (!odbc_free_result($this->mResultSet)) {
            $this->mErrMsg = "Could not free memory.";
            return (false);
        }

        return (true);
    } // function close

} // class ODBCRecordset
?>
