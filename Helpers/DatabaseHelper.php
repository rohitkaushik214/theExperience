<?php
final class DatabaseHelper {


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