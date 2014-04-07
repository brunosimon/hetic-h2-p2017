<?php

// Test if values sent with 'action' inside
if(!empty($_GET) && !empty($_GET['action']))
{
	// Debug
	echo '<pre>';
	print_r($_GET);
	echo '</pre>';

	$action = $_GET['action'];

	// Send a new todo
	if($action == 'send')
	{
		
	}

	// Other cases
	else
	{
		$id = (int)$_GET['id'];

		// Test if ID well received
		if($id !== 0)
		{
			// Delete an existing todo
			if($action == 'delete')
			{
				
			}
			// Mark as done an existing todo
			else if($action == 'do')
			{
				
			}
			// Mark as undone an existing todo
			else if($action == 'undo')
			{
				
			}
		}
	}
}