<?php // $Id: sybase-database.php,v 1.6 2002/10/23 18:31:00 alarion Exp $
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

define('dbSybase', 'yes');
class DlSybaseDatabase extends DlDatabase {
    /**
    * Open the database connection
    *
    * Open the database connection
    * @return boolean
    */
    function Open() {
        $this->mDbCon = @sybase_connect($this->mServer, $this->mUserName, $this->mPassword);
        if (!$this->mDbCon) {
            $this->mErrMsg = "Could not connect to the Sybase server.";
            return(false);
        }

        if (!@sybase_select_db($this->mDbName, $this->mDbCon)) {
            $this->mErrMsg = "Could not open specified database.";
            return(false);
        }

        $this->mDbType = "Sybase";
        return(true);
    } // function open
    /**
    * Close the database connection
    *
    * Close the database connection
    * @return boolean
    */
    function Close() {
        if (!sybase_close($this->mDbCon)) {
            $this->mErrMsg = "Could not close connection to the Sybase Server.";
            return(false);
        }
        return(true);
    } // function close
    /**
    * Execute a sql query to the database
    *
    * Execute a sql query to the database, use this for queries that don't return a result set
    * @param string $sql the sql query to be executed
    * @return boolean
    */
    function Execute($sql) {
        $result = sybase_query($sql, $this->mDbCon);
        if (!$result) die ("Error executing SQL statement");
        return(true);
    } // function execute
} // class DlSybaseDatabase
?>
