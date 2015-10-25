<?php

require_once 'IGroupOrUser.php';
class User implements IGroupOrUser {


	//****************PRIVATE PROPERTIES********************
	private $iUserID;
	private $sUserName;
	private $sFullName;
	private $sEmailAddress;
	private $aAuthenticationToken;
	private $bIsAuthenticated;
	private $sWalletIntegrated;
	private $aProfileInfo;

	public function __construct() 
	{
		//Set the userID and do other intialisation stuff.
	}

	// ****************PUBLIC METHODS***********************
	// ******INTERFACE METHODS***************************
	public function getName($iUserId) 
	{
		if(!$this->bIsAuthenticated) {
			return FALSE;
		}

	}

	public function getFullName($iUserId) 
	{
		if(!$this->bIsAuthenticated) {
			return FALSE;
		}

		return $this->sFullName;
	}

	public function getProfile($iUserId) 
	{
		$sProfileInfo = '';
		if(!$this->bIsAuthenticated) {
			return FALSE;
		}
		else if(!empty($aProfileInfo)) {
			$sProfileInfo = json_encode($aProfileInfo);
			return $sProfileInfo;
		}
		//Make the array and set the $aProfileInfo parameter.
		$aProfileInfo                  = array();
		$aProfileInfo['email-address'] = '';//DB call
		$aProfileInfo['age']           = '';//DB call
		$aProfileInfo['profile_pic']   = '';
		$this->aProfileInfo            = $aProfileInfo;
		$sProfileInfo                  = json_encode($aProfileInfo);

		return $sProfileInfo;

	}
	//************* NON-INTERFACED METHODS********************
	//ToDo - Define parameters for each method later.
	public function resetPassword() {

	}


	// Personal activites
	public function savePersonalNote() {

	}

	public function getAllNotesForUser() {
		
	}


	public function getNote($iNoteID) {

	}
	
	public function getExpensesInBetweenDates($sFromDate, $sToDate) {
		//Check for the validity of the dates.

	}

	public function checkOutPlace() {

	}

	public function saveExpensesForTheDay() {

	}

	//Group related-activities

	public function createGroup() {

	}	

	public function deleteGroup() {

	}

	public function planATrip() {
		//Notify the users that a trip has been planned.
		//In the trip class- mark every member - "Will be there","Pending","Not Sure","Nope"

	}



}//End of class


