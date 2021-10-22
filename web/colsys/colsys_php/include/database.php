<?php
// $Id: database.php,v 1.11 2002/10/28 23:00:55 alarion Exp $:
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

class DlDatabase {
    /**
    * @var string $mUserName the user name to login with
    */
    var $mUserName;
    /**
    * @var string $mPassword the password for said user name
    */
    var $mPassword;
    /**
    * @var string $mDbName name of database to connect to, or in ODBC, the DSN name. For Interbase, use the full absolute path to the .gdb file.
    */
    var $mDbName;
    /**
    * @var string $mErrMsg last error message encountered, if any.
    */
    var $mErrMsg;
    /**
    * @var resource $mDbCon the database connection resource
    */
    var $mDbCon;
    /**
    * @var string $mServer the database server name.
    */
    var $mServer;
    /**
    * @var string $mDbType Which database type are we using? This is used internally
    */
    var $mDbType;
    /**
    * @var double $mTimeOne Used for calculating execution time
    */
    var $mTimeOne;
    /**
    * @var doublt $mTimeTwo Used for calculating execution time
    */
    var $mTimeTwo;
    /**
    * @var double $mTotalTime Used for calculating execution time
    */
    var $mTotalTime;

    /**
    * Database Objects constructor
    *
    * Takes the input parameters and assigns them to members
    * @param string $userName The user name to login with
    * @param string $password The password to login with
    * @param string $databaseName The name of the database to use
    * @param string $serverName The name of the server to connect to
    */

    function DlDatabase( $userName= "", $password = "", $databaseName = "", $serverName = "") {
        $this->mUserName = $userName;                     // assign our initial variables
        $this->mPassword = $password;
        $this->mDbName = $databaseName;
        $this->mServer = $serverName;
    } // function Database

    /**
    * Returns an error message
    *
    * Returns the latest error message encountered
    * @return string the error message
    */
    function GetError() {
        return($this->mErrMsg);
    } // function GetError()

    /**
    * Returns current time in milliseconds
    *
    * This is used by the benchmarking functions to get the current time
    * @return double The current time in milliseconds
    */
    function GetMicroTime() {
        $timer = doubleval(ereg_replace('^0\.([0-9]*) ([0-9]*)$','\\2.\\1',microtime()));
        return $timer;
    } // function getmicrotime

    /**
    * Sets the start time
    *
    * Sets the start time, for benchmarking
    * @return boolean returns true always
    */
    function StartTimer() {
        $this->mTimeOne = $this->GetMicroTime();
        return(true);
    } // function StartTimer

    /**
    * Sets the end time
    *
    * Sets the end time and calculates the difference between start time and end time, for benchmarking
    * @return boolean returns true always
    */
    function StopTimer() {
        $this->mTimeTwo = $this->GetMicroTime();
        $this->mTotalTime = $this->mTimeTwo - $this->mTimeOne;
        return(true);
    } // function StopTimer

    /**
    * Returns the total time
    *
    * Returns the total time between $mTimeOne and $mTimeTwo, for benchmarking
    * @return double the total execution time
    */
    function GetTimer() {
        return($this->mTotalTime);
    } // function GetTimer

    /**
    * Determines which database files to include
    *
    * Use this function to create a new connection object.
    * @param string $databaseType The type of database. use "MySQL", "PGSQL", "MSSQL", "ODBC", "Oracle", "Sybase" or "Ibase"
    * @param string $userName The user name to login with
    * @param string $password The password to login with
    * @param string $databaseName The database to select/use after logged in
    * @param string $serverName The server to connect to
    * @return object DlDatabase $link Returns a new DlDatabase Object (actually, returns an object inherited from DlDatabase)
    */
    function NewConnection( $databaseType="", $userName="", $password="", $databaseName="", $serverName="") {
        switch ($databaseType) {
            case "ODBC":
                if(!defined('dbODBC'))
                    include_once("include/odbc-database.php");
                return new DlOdbcDatabase($userName, $password, $databaseName, $serverName);
                break;
            case "MySQL":
                if(!defined('dbMySQL'))
                    include_once("include/mysql-database.php");
                return new DlMySqlDatabase($userName, $password, $databaseName, $serverName);
                break;
            case "Oracle":
                if(!defined('dbOracle'))
                    include_once("include/oracle8-database.php");
                return new DlOracleDatabase($userName, $password, $databaseName, $serverName);
                break;
            case "Sybase":
                if(!defined('dbSybase'))
                    include_once("include/sybase-database.php");
                return new DlSybaseDatabase($userName, $password, $databaseName, $serverName);
                break;
            case "MSSQL":
                if(!defined('dbMSSQL'))
                    include_once("include/sqlserver-database.php");
                return new DlSqlServerDatabase($userName, $password, $databaseName, $serverName);
                break;
            case "PGSQL":
                if(!defined('dbPGSQL'))
                    include_once("include/pgsql-database.php");
                return new DlPgSqlDatabase($userName, $password, $databaseName, $serverName);
                break;
            case "Ibase":
                if (!defined('dbIbase'))
                    include_once("include/ibase-database.php");
                return new DlIBaseDatabase($userName, $password, $databaseName, $serverName);

                break;
            default:
                die("No or invalid database type specified.");
        }
    }
} // class DlDatabase
?>