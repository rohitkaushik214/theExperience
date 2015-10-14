<?php

public class DatabaseOps {

	private $_sHostName;
	private $_sDatabaseUserName;
	private $_sDatabasePassword;
	private $_sDatabaseName;
	private $_bIsDatabaseServerUp;
	private $_oDatabaseConnection;	




	///////////////////////// PUBLIC FUNCTIONS /////////////////////////////////////////////////

	public function __construct() 
	{

		$this->_sHostName         = $sHostName;
		$this->_sDatabaseName     = $sDatabaseName;
		$this->_sDatabasePassword = $sDatabasePassword;
		$this->_DatabaseUserName  = $sDatabaseUserName;
		$_oDatabaseConnection     = NULL;
		//Check for the up-state of the database server (call pingDatabaseServer method) and accordingly set the IsDatabaseServerUp flag.

	}

	public function getPDOObject()
	{
		if($_oDatabaseConnection == NULL)
		{		
			$_oDatabaseConnection = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
		}

		return $this->_oDatabaseConnection;
	}


	public function getRecord() 
	{

	}

	public function insertRecord()
	{

	}

	public function deleteRecord()
	{

	}

	public function updateRecord() 
	{

	}	

	public function pingDatabaseServer() 
	{

	}

}
