<?
define('rsIbase', 'yes');
// $Id: ibase-recordset.php,v 1.7 2002/10/27 18:02:40 alarion Exp $
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
/**************************/
class DlIBaseRecordset extends DlRecordset {
    /**
    * Executes the query
    *
    * Executes the SQL query and loads the data into a dataset/table
    * @param string $sql the SQL query to execute
    * @return boolean
    */
    function Open($sql) {
        $this->mResultSet = null;
        $this->mSql = $sql;
        if (!isset($this->mDbCon)) {
            $this->mErrMsg = 'Connection resource not set. This is probably because a successful connection to the databases was not made.';
            return false;
        }
        $this->mResultSet = ibase_query($this->mDbCon, $this->mSql);

        if (!$this->mResultSet) {                    // query failed
            $this->mErrMsg = "Query could not be executed";
            return (false);
        }
        $this->mColumnCount = ibase_num_fields($this->mResultSet);
        $this->LoadData();
        $this->mRowCount = count($this->mDataSet);
        $this->MoveFirst();
        return true;
    } // function Open

    /**
    * Loads the data into an array
    *
    * Loads the result data into an array
    */
    function LoadData() {
        $this->mDataSet = array();
        while ($row = get_object_vars(ibase_fetch_object($this->mResultSet))) {
            /**
            * WORKAROUND:
            * Since the PHP Interbase functions can't return an array that
            * contains both indexed and associative keys, we do it ourselves
            */
            $indexed_row = array();
            foreach ($row as $key=>$val) {
                array_push($indexed_row, $val);
            }
            $row = array_merge($row, $indexed_row);
            array_push($this->mDataSet, $row);
        }
    }

    /**
    * Returns the value of the specified column
    *
    * Overrides DlRecordset::Value, performs a upper-case-conversion on the fieldname and passes it back to the parent
    * @return mixed
    */
    function Value($field) {
        return DlRecordset::Value(strtoupper($field));
    }

    /**
    * Frees memory associated with the recordset
    *
    * Closes the recordset and frees associated memory
    * @return boolean
    */
    function Close() {                         // free memory associated with the result set
        if (!ibase_free_result($this->mResultSet)) {
            $this->mErrMsg = "Could not free memory.";
            return (false);
        }

        return (true);
    } // function close

} // class DlIBaseRecordset
?>
