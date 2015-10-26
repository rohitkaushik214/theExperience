<?php

class Expense implements IEntity{

	private $sExpenseName;
	private $bIsExpensePrivate;
	private $sExpenseCategory;
	private $sExpenseSubCategory;
	private $sExpenseAmount;
	private $sExpenseDate;
	private $sExpenseTime;
	private $aExpenseMembersShared;// Ids of the members sharing the expenditure.


	/**
	 * @return mixed
	 */
	public function getIsExpensePrivate()
	{
		return $this->bIsExpensePrivate;
	}

	/**
	 * @param mixed $bIsExpensePrivate
	 */
	public function setIsExpensePrivate($bIsExpensePrivate)
	{
		$this->bIsExpensePrivate = $bIsExpensePrivate;
	}

	/**
	 * @return mixed
	 */
	public function getExpenseName()
	{
		return $this->sExpenseName;
	}

	/**
	 * @param mixed $sExpenseName
	 */
	public function setExpenseName($sExpenseName)
	{
		$this->sExpenseName = $sExpenseName;
	}

	/**
	 * @return mixed
	 */
	public function getExpenseCategory()
	{
		return $this->sExpenseCategory;
	}

	/**
	 * @param mixed $sExpenseCategory
	 */
	public function setExpenseCategory($sExpenseCategory)
	{
		$this->sExpenseCategory = $sExpenseCategory;
	}

	/**
	 * @return mixed
	 */
	public function getExpenseSubCategory()
	{
		return $this->sExpenseSubCategory;
	}

	/**
	 * @param mixed $sExpenseSubCategory
	 */
	public function setExpenseSubCategory($sExpenseSubCategory)
	{
		$this->sExpenseSubCategory = $sExpenseSubCategory;
	}

	/**
	 * @return mixed
	 */
	public function getExpenseDate()
	{
		return $this->sExpenseDate;
	}

	/**
	 * @param mixed $sExpenseDate
	 */
	public function setExpenseDate($sExpenseDate)
	{
		$this->sExpenseDate = $sExpenseDate;
	}

	/**
	 * @return mixed
	 */
	public function getExpenseAmount()
	{
		return $this->sExpenseAmount;
	}

	/**
	 * @param mixed $sExpenseAmount
	 */
	public function setExpenseAmount($sExpenseAmount)
	{
		$this->sExpenseAmount = $sExpenseAmount;
	}

	/**
	 * @return mixed
	 */
	public function getExpenseTime()
	{
		return $this->sExpenseTime;
	}

	/**
	 * @param mixed $sExpenseTime
	 */
	public function setExpenseTime($sExpenseTime)
	{
		$this->sExpenseTime = $sExpenseTime;
	}

	/**
	 * @return mixed
	 */
	public function getExpenseMembersShared()
	{
		return $this->aExpenseMembersShared;
	}

	/**
	 * @param mixed $aExpenseMembersShared
	 */
	public function setExpenseMembersShared($aExpenseMembersShared)
	{
		$this->aExpenseMembersShared = $aExpenseMembersShared;
	}

	public function getAllProperties()
	{
		$aProperties = array();
		$aProperties['IsExpensePrivate']   = $this->bIsExpensePrivate;
		$aProperties['ExpenseSubCategory'] = $this->sExpenseSubCategory;
		$aProperties['ExpenseDate']        = $this->sExpenseDate;
		$aProperties['ExpenseName']        = $this->sExpenseName;
		$aProperties['ExpenseAmount']      = $this->sExpenseAmount;
		$aProperties['ExpenseCategory']    = $this->sExpenseCategory;

		return $aProperties;
	}

}

/*
class ExpenseMethods {

	public function __construct() {

	}

	public function storeExpense($oExpense)
	{

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
*/