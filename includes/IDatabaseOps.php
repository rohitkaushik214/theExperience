<?php
interface IDatabaseOps
{

    public function getPDOObject();
    public function prepareInsertQuery($sTableName,$aRecord);
    public function prepareSelectQuery($sTableName,$aSelectColumns, $bUseFilterLogic,
                                       $sFilterLogic, $aFilters, $bUseTop, $iTop, $sGroupBy,
                                       $sOrderByColumn, $sOrderBySequence);
    public function prepareDeleteQuery($sTableName, $aRecordIds, $sRecordIDParameter);
    public function prepareUpdateQuery($sTableName, $aUpdateRecords, $aFilters);
    public function pingDatabaseServer();
    public function fireQuery($sQuery, $aValues, $bFetchResults);

}