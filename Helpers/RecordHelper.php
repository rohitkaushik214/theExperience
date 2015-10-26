<?php
final class RecordHelper
{
    public static function getRecordMappings($sClassName)
    {
        $sRecordName = '';
        switch($sClassName)
        {
            case 'Expense' : $sRecordName = 'Expense';
                break;
            case 'Note' : $sRecordName = 'Note';
                break;
        }

        return $sRecordName;
    }

}