<?
define('rsPGSQL', 'yes');
// $Id: pgsql-recordset.php,v 1.7 2002/10/27 18:02:40 alarion Exp $
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
class DlPgSqlRecordset extends DlRecordset {       // the ODBC recordset object
    var $rows;                      // the array of row data

    /**
    * Executes the query
    *
    * Executes the SQL query and loads the data into a dataset/table
    * @param string $sql the SQL query to execute
    * @return boolean
    */
    function Open ($sql) {          // initialize some members and open the result set
       //$this->ResultSet = null;                  // initialize to Null
       $this->mSql = utf8_encode($sql);
//     $this->mSql = $sql;
//     $this->mResultSet = pg_query($this->mDbCon, $this->mSql);
       $this->mResultSet = pg_exec($this->mDbCon, $this->mSql);
       
        if (!$this->mResultSet)                    // query failed
        {
            $this->mErrMsg = "There was an error executing this query: '$sql'.<br>PostgreSQL said: " . pg_ErrorMessage($this->mDbCon);
            return (false);
         }
        if (!is_bool($this->mResultSet)) {
            $this->mColumnCount = pg_numfields($this->mResultSet);
            $this->mRowCount = pg_numrows($this->mResultSet);
            $this->LoadData();
            $this->MoveFirst();
        }
       return(true);
    } // function open

    /**
    * Load rows into an array
    *
    * Load result set into array
    */
    function LoadData() {
        $this->mDataSet = array();
        while ($row = pg_fetch_array($this->mResultSet)) {
            for (reset($row); list($key) = each($row);) {
                $row[$key] = utf8_decode($row[$key]);
            }
            array_push($this->mDataSet, $row);
        }

    } // function loadcolumns

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
    * Gets the number of columns in the current result set
    *
    * Gets the number of columns in the current result set
    * @return boolean
    */
    function GetColumnCount() {
        return $this->mColumnCount;
    }


    /**
    * Frees memory associated with the recordset
    *
    * Closes the recordset and frees associated memory
    * @return boolean
    */
    function Close() {                         // free memory associated with the result set
        if (!pg_freeresult($this->mResultSet)) {
            $this->mErrMsg = "Could not free memory.";
            return(false);
        }

        return(true);
    } // function close
} // class DlPgSqlRecordset
?>