<?php

class ExpenseOperations implements IEntityOperations
{


    private static function getIDColumnName()
    {
        return 'ExpenseID';
    }

    public function getEntity($iExpenseID)
    {
        $oExpense             = new Expense();
        $oRecord              = new Record($oExpense);
        $aExpenseProperties   = $oRecord->getRecordByID(RecordType::Expense, self::getIDColumnName(), $iExpenseID);
        //Recheck for the data return format of $oExpenseProperties.
        $oExpense->setExpenseSubCategory($aExpenseProperties['ExpenseCategory']);
        //Fill all the variables of $oExpense
        return $oExpense;

    }

    public function insertEntity($aProperties)
    {
        $oExpense = new Expense();
        $oExpense->setExpenseAmount($aProperties['ExpenseAmount']);
        $oExpense->setExpenseCategory($aProperties['ExpenseCategory']);
        $oExpense->setExpenseDate($aProperties['ExpenseDate']);
        $oExpense->setExpenseName($aProperties['ExpenseName']);
        $oExpense->setExpenseSubCategory($aProperties['ExpenseSubCategory']);
        $oExpense->setIsExpensePrivate($aProperties['IsExpensePrivate']);
        $oRecord  = new Record($oExpense);
        $bSuccess = $oRecord->createRecord();
            if($bSuccess == TRUE)
        {
            //do something.
        }
        else
        {
            //do something else.
        }
    }

    public function deleteEntity($iExpenseID)
    {
        $aRecordIds = array();
        array_push($aRecordIds, $iExpenseID);
        $oExpense = new Expense();
        $oRecord  = new Record($oExpense);
        $bSuccess = $oRecord->deleteRecord($aRecordIds, self::getIDColumnName());
        return $bSuccess;
    }

    public function updateEntity($iExpenseID, $aProperties)
    {

    }

    /**
     * is triggered when invoking inaccessible methods in an object context.
     *
     * @param $name string
     * @param $arguments array
     * @return mixed
     */
    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }

}