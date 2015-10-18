<?php

class DatabaseOps {

	private $_sHostName;
	private $_sDatabaseUserName;
	private $_sDatabasePassword;
	private $_sDatabaseName;
	private $_bIsDatabaseServerUp;
	private $_oDatabaseConnection;


	///////////////////////// PUBLIC FUNCTIONS /////////////////////////////////////////////////

	public function __construct($sHostName='localhost', $sDatabaseName='theexperience', $sDatabasePassword='', $sDatabaseUserName ='root')
	{
		$this->_sHostName         = $sHostName;
		$this->_sDatabaseName     = $sDatabaseName;
		$this->_sDatabasePassword = $sDatabasePassword;
		$this->_DatabaseUserName  = $sDatabaseUserName;
		//Check for the up-state of the database server (call pingDatabaseServer method) and accordingly set the IsDatabaseServerUp flag.
	}

	public function getPDOObject()
	{
		$sHostName         = $this->_sHostName;
		$sDatabaseUserName = $this->_sDatabaseUserName;
		$sDatabasePassword = $this->_sDatabasePassword;
		$sDatabaseName     = $this->_sDatabaseName;
		if($this->_oDatabaseConnection == NULL)
		{		
			$this->_oDatabaseConnection = new PDO("mysql:host=$sHostName;dbname=$sDatabaseName", $sDatabaseUserName, $sDatabasePassword);
		}

		return $this->_oDatabaseConnection;
	}

	public static function getQuestionMarkSequence($iQuestions)
	{
		$sQuestionSequence = '';
		for ($iCounter = 1 ; $iCounter <= $iQuestions; $iCounter++)
		{
			$sQuestionSequence.='?,';
		}
		$sQuestionSequence = rtrim($sQuestionSequence,',');

		return $sQuestionSequence;
	}

	public function prepareInsertQuery($sTableName, $aRecord)
	{
		$sQuery       = '';
		$aRecordKeys  = array_keys($aRecord);
		$sRecordKeys  = implode(',', $aRecordKeys);
		$sQuestionSequence = self::getQuestionMarkSequence(count($aRecordKeys));
		$sQuery = 'INSERT INTO ' . $sTableName . ' ('.$sRecordKeys . ')' . ' VALUES (' . $sQuestionSequence. ')';
		//Validate the query via a regular expression and log it, of-course.

		return $sQuery;
	}

	public function prepareSelectQuery($sTableName,$aSelectColumns, $bUseFilterLogic,
									   $sFilterLogic ='', $aFilters, $bUseTop, $iTop=0, $sGroupBy,
									   $sOrderByColumn, $sOrderBySequence)
	{
		/*
		 * @Todo: Create a separate library for all creating all the SQL stuff.
		 */
		$sQuery      = 'SELECT ';
		$sSelectColumns = implode(',', $aSelectColumns);
		if($sSelectColumns == NULL || $sSelectColumns == '') {
			$sSelectColumns = ' *';
		}

		if ($bUseTop && $iTop !=0) {
			$sQuery .= ' TOP '. $iTop;
		}

		if($bUseFilterLogic && $sFilterLogic != '') {
			foreach ($aFilters as $sFilter) {
				$iPos = strpos($sFilterLogic, '@');
				if ($iPos != FALSE) {
					$sFilterLogic = substr_replace('@', $sFilter . '=?', $iPos, 1);
				}
			}
		}
		else {
			//Implement without filter logic.
			$sFilterLogic = '';
			foreach($aFilters as $sFilter) {
				$sFilterLogic = $sFilter . '=? AND';
			}
		}

		$sQuery .= $sSelectColumns . ' FROM '. $sTableName;
		if($sFilterLogic != '')
		{
			$sQuery.=' WHERE '.$sFilterLogic;
		}
		//Impelement for orderby and groupby clauses.
		//Implement for JOINS here and sub-sql queries.

		return $sQuery;
	}


	public function prepareDeleteQuery($sTableName, $aRecords, $aFilters)
	{

	}

	public function prepareUpdateQuery($sTableName, $aUpdateRecords, $aFilters)
	{

	}


	public function pingDatabaseServer() 
	{

	}

}
