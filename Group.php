<?php

public class Group extends IGroupOrUser {

	//***********************PRIVATE  PROPERTIES *****************************
	private $iGroupId;
	private $sGroupName;
	private $aGroupMembers;
	private $aGroupProfilePic;

	//***********************PUBLIC METHODS **********************************

	public function getGroupName()
	{		
		return $this->sGroupName;
	}

	public function planATripWithTheGroup() 
	{

	}

	public function getProfile()
	{
		//Get the profile pic file location, members involved and other stuff.
	}

	public function addMember()
	{

	}

	public function deleteMember()
	{

	}

	public function getAllTrips()
	{

	}



}