<?php

public interface IGroupOrUser {

	//Get User Name
	public function getName($iUserId);
	//Get full name for the user of a group
	public function getFullName($iUserId);
	//Get full profile for the user eg. email-address,age,sex etc.
	public function getProfile($iUserId);	

}