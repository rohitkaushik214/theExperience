<?php

public class Expense {

	private $iExpenseID;
	private $iExpenseName;
	private $bIsExpensePrivate;
	private $aExpenseMembersShared;// Ids of the members sharing the expenditure.

	public function createNewExpense()
	{

	}

	public function updateExpense()
	{

	}

	public function deleteExpense()
	{

	}

}


public class ExpenseMethods {

	public function __construct() {

	}

	public function storeExpense($oExpense)
	{
		$oRecord = new Record();
		$oRecord->createRecord($oExpense, get_class($oExpense));
		$oRecord->storeRecord();
	}

	public function getAllExpensesForUser($iUserID) 
	{

	}

	public function reCalculateExpense($sTotalExpense, $aExpensePaid, $iUserRootID, $iUserWhoPaidExpense)
	{

	}

	public function notifyUsersofExpense($iExpenseID, $iUserRootID, $aExpenseMembers)
	{

	}

	public function divideExpenseAmongGroup($oExpense, $bDivideExpenseEqually, $aExpenseParams)
	{

	}

}