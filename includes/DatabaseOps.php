<?php

require_once 'IDatabaseOps.php';
require_once '../Helpers/DatabaseHelper.php';

class DatabaseFetchResult {

	public $bSuccess;
	public $aFetchResults;
}

class DatabaseOps implements IDatabaseOps {

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
		$this->_oDatabaseConnection = $this->getPDOObject();
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

	public function prepareInsertQuery($sTableName, $aRecord)
	{
		$aRecordKeys  = array_keys($aRecord);
		$sRecordKeys  = implode(',', $aRecordKeys);
		$sQuestionSequence = DatabaseHelper::getQuestionMarkSequence(count($aRecordKeys));
		$sQuery = 'INSERT INTO ' . $sTableName . ' (' . $sRecordKeys . ')' . ' VALUES (' . $sQuestionSequence. ')';
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
		//Implement for <> conditions.
		//Implement for orderby and groupby clauses.
		//Implement for JOINS here and sub-sql queries.

		return $sQuery;
	}

	public function fireQuery($sQuery, $aValues, $bFetchResults)
	{
		$oQueryResult = new DatabaseFetchResult();
		$oQueryResult->bSuccess = TRUE;
		$aArrayValues = array_values($aValues);
		try {
			$oStatement = $this->_oDatabaseConnection->prepare($sQuery);
			$oStatement->execute($aArrayValues);

			if ($bFetchResults) {
				$oQueryResult->aFetchResults = $oStatement->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		catch (Exception $oException)
		{
			$oQueryResult->bSuccess      = FALSE;
			$oQueryResult->aFetchResults['message']    = $oException->getMessage();
			$oQueryResult->aFetchResults['stackTrace'] = $oException->getTrace();
		}
		return $oQueryResult;
	}


	public function prepareDeleteQuery($sTableName, $aRecordIds, $sRecordIDParameter)
	{
		$sQuestionSequence = DatabaseHelper::getQuestionMarkSequence(count($aRecordIds));
		$sQuery  = 'DELETE FROM '. $sTableName. ' WHERE ' . $sRecordIDParameter . ' IN (' . $sQuestionSequence . ')' ;

		return $sQuery;
	}

	public function prepareUpdateQuery($sTableName, $aUpdateRecords, $aFilters)
	{
		//update Expense set adsad = '' and

	}


	public function pingDatabaseServer() 
	{

	}

}
