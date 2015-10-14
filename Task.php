<?php

//Include Status enums
public class Task extends Record {

	private $iTaskID;
	private $iTaskName;
	private $sTaskUserID;
	private $bIsGroupTask;
	private $sTaskStatus;

	public function setTaskStatus($iTaskStatus = 0) 
	{
		if($iTaskStatus === 0)
		{
			$this->sTaskStatus = TaskStatus::NotCompleted;
		}

	}

	//Not sure if required.
	public function getID()
	{

	}




}