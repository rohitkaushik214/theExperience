<?php

//Parent class of all the records and models.
require_once 'IRecord.php';
class Record implements IRecord
{
	private $oRecord;
	private $sRecordType;
	private $oDatabaseConnection;

	public function __construct(IRecord $oRecord)
	{
		$this->oRecord     = $oRecord;
		$this->sRecordType = get_class($oRecord);
		if($this->oDatabaseConnection == NULL)
		{
			$this->oDatabaseConnection = new DatabaseOps();
		}
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
		$sQuery   = $this->oDatabaseConnection->prepareInsertQuery($this->sRecordType, $this->oRecord);
		$oResult  = $this->oDatabaseConnection->fireQuery($sQuery, $this->oRecord, FALSE);

		if($oResult->bSuccess == FALSE) {
			$bSuccess = FALSE;
			$this->handleFailedSQLOperation($sQuery,$oResult);
		}
		return $bSuccess;
	}

	public function getRecords($aSelectColumns, $bUseFilterLogic, $sFilterLogic, $aFilters, $bUseTop, $iTop, $sGroupBy,
							   $sOrderByColumn, $sOrderBySequence )
	{
		$bSuccess = TRUE;
		$sQuery   = $this->oDatabaseConnection->prepareSelectQuery($this->sRecordType, $aSelectColumns,
			$bUseFilterLogic, $sFilterLogic, $aFilters, $bUseTop, $iTop, $sGroupBy, $sOrderByColumn, $sOrderBySequence);
		$oResult  = $this->oDatabaseConnection->fireQuery($sQuery, $this->oRecord, TRUE);

		if($oResult->bSuccess == FALSE || !is_array($oResult->aFetchResults) || empty($oResult->aFetchResults)) {
			$bSuccess = FALSE;
			$this->handleFailedSQLOperation($sQuery,$oResult);
			return $bSuccess;
		}

		return $oResult->aFetchResults;
	}

	public function updateRecord($aUpdateRecords, $aFilters)
	{
		/*
		 * @Todo: Re-think about it.
		 */
		$bSuccess = TRUE;
		$sQuery   = $this->oDatabaseConnection->prepareUpdateQuery($this->sRecordType, $aUpdateRecords, $aFilters);
		$oResult  = $this->oDatabaseConnection->fireQuery($sQuery, $aFilters, FALSE);
		if($oResult->bSuccess == FALSE) {
			$bSuccess = FALSE;
			$this->handleFailedSQLOperation($sQuery,$oResult);
		}

		return $bSuccess;

	}

	public function deleteRecord($aRecordIds, $sRecordIDParameter)
	{
		$bSuccess = TRUE;
		$sQuery   = $this->oDatabaseConnection->prepareDeleteQuery($this->sRecordType, $aRecordIds, $sRecordIDParameter);
		$oResult  = $this->oDatabaseConnection->fireQuery($sQuery, $aRecordIds, FALSE);
		if($oResult->bSuccess == FALSE) {
			$bSuccess = FALSE;
			$this->handleFailedSQLOperation($sQuery,$oResult);
		}

		return $bSuccess;
	}

}