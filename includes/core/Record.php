<?php

//Parent class of all the records and models.
require_once 'IRecord.php';
require_once 'includes/DatabaseOps.php';
class Record implements IRecord
{
	private $oDatabaseConnection;
	private $oRecord;
	private $aRecordProperties;

	public function __construct(IEntity $oRecordObject)
	{
		/*
		 * @Todo: Inject logged in user too. Think about it.
		 */
		if($this->oDatabaseConnection == NULL)
		{
			$this->oDatabaseConnection = new DatabaseOps();
		}
		$this->oRecord           = $oRecordObject;
		$this->aRecordProperties = $oRecordObject->getAllProperties();
	}


	public function getSetRecord()
	{
		RecordHelper::getRecordMappings(get_class($this->oRecord));

		return $this->oRecord;
	}

	public function handleFailedSQLOperation($sQuery, $oResult)
	{
		if(array_key_exists('message', $oResult->aFetchResults)) {
			$sExceptionMessage = $oResult->aFetchResults['message'];
		}
		if(array_key_exists('stackTrace', $oResult->aFetchResults)) {
			$sExceptionStackTrace = $oResult->aFetchResults['stackTrace'];
		}
		/*
         * @Todo: Log the exception and the query.
         */
	}

	public function createRecord()
	{
		$bSuccess = TRUE;
		//Replace this by a static method helper.
		$sTableName = RecordHelper::getRecordMappings(get_class($this->oRecord));
		$sQuery   = $this->oDatabaseConnection->prepareInsertQuery($sTableName, $this->aRecordProperties);
		$oResult  = $this->oDatabaseConnection->fireQuery($sQuery,$this->aRecordProperties, FALSE);

		if($oResult->bSuccess == FALSE) {
			$bSuccess = FALSE;
			$this->handleFailedSQLOperation($sQuery,$oResult);
		}
		return $bSuccess;
	}

	public function getRecords( $aSelectColumns, $bUseFilterLogic, $sFilterLogic, $aFilters, $bUseTop, $iTop, $sGroupBy,
							   $sOrderByColumn, $sOrderBySequence )
	{
		$sTableName = RecordHelper::getRecordMappings(get_class($this->oRecord));
		$sQuery   = $this->oDatabaseConnection->prepareSelectQuery($sTableName, $aSelectColumns,
			$bUseFilterLogic, $sFilterLogic, $aFilters, $bUseTop, $iTop, $sGroupBy, $sOrderByColumn, $sOrderBySequence);
		$oResult  = $this->oDatabaseConnection->fireQuery($sQuery, $this->aRecordProperties, TRUE);

		if($oResult->bSuccess == FALSE || !is_array($oResult->aFetchResults) || empty($oResult->aFetchResults)) {
			$this->handleFailedSQLOperation($sQuery,$oResult);
			return FALSE;
		}

		return $oResult->aFetchResults;
	}

	public function updateRecord($aUpdateRecords, $aFilters)
	{
		/*
		 * @Todo: Re-think about it.
		 */
		$sTableName = RecordHelper::getRecordMappings(get_class($this->oRecord));
		$bSuccess = TRUE;
		$sQuery   = $this->oDatabaseConnection->prepareUpdateQuery($sTableName, $aUpdateRecords, $aFilters);
		$oResult  = $this->oDatabaseConnection->fireQuery($sQuery, $aFilters, FALSE);
		if($oResult->bSuccess == FALSE) {
			$bSuccess = FALSE;
			$this->handleFailedSQLOperation($sQuery,$oResult);
		}

		return $bSuccess;

	}

	public function deleteRecord($aRecordIds, $sRecordIDParameter)
	{
		$bSuccess   = TRUE;
		$sTableName = RecordHelper::getRecordMappings(get_class($this->oRecord));
		$sQuery     = $this->oDatabaseConnection->prepareDeleteQuery($sTableName, $aRecordIds, $sRecordIDParameter);
		$oResult    = $this->oDatabaseConnection->fireQuery($sQuery, $aRecordIds, FALSE);
		if ($oResult->bSuccess == FALSE) {
			$bSuccess = FALSE;
			$this->handleFailedSQLOperation($sQuery, $oResult);
		}

		return $bSuccess;
	}

	public function getRecordByID($sRecordType, $sRecordIDName, $iRecordID)
	{
		$aFilters = array();
		array_push($aFilters, $sRecordIDName);
		$sQuery   = $this->oDatabaseConnection->prepareSelectQuery($sRecordType, array(), FALSE, '', $aFilters);
		$aValues  = array();
		array_push($aFilters,$iRecordID);
		$oResult = $this->oDatabaseConnection->fireQuery($sQuery,$aValues, TRUE);
		if($oResult->bSuccess == FALSE || !is_array($oResult->aFetchResults) || empty($oResult->aFetchResults)) {
			$bSuccess = FALSE;
			$this->handleFailedSQLOperation($sQuery,$oResult);
			return $bSuccess;
		}

		return $oResult->aFetchResults;
	}

}