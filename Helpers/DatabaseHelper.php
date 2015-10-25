<?php
final class DatabaseHelper {

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

    public static function getQuestionMarkSequence($iQuestions)
    {
        $sQuestionSequence = '';
        for ($iCounter = 1 ; $iCounter <= $iQuestions; $iCounter++)
        {
            $sQuestionSequence .= '?,';
        }
        $sQuestionSequence = rtrim($sQuestionSequence,',');

        return $sQuestionSequence;
    }

}