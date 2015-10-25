<?php

 abstract class TaskStatus {

	const NotCompleted   = 2;
	const Completed      = 1;
	const InProgress     = 3;
	const MarkedForLater = 4;

}

// "Will be there","Pending","Not Sure","Nope"

 abstract class MemberStatusSelect {

	const YesStatus     = 1;
	const NoStatus      = 2;
	const PendingStatus = 3;
	const NotSureStatus = 4;
}


