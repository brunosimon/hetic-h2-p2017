<?php
/*
	This class is used to post and read messages
*/


class Chat
{
	private $_db; // database object

	public function __construct($db)
	{
		$this->setDb($db);
		
	}
	
	public function sendmessage($from, $to, $message)
	{
		$q = $this->_db->prepare('INSERT INTO messages SET from_id = :from_id, to_id = :to_id, text = :text');
		$q->bindValue(':from_id', $from, PDO::PARAM_INT);
		$q->bindValue(':to_id', $to, PDO::PARAM_INT);
	    $q->bindValue(':text', $message, PDO::PARAM_STR);
	    
	    $q->execute();
	    
	    print_r($q->errorInfo());
	}
	
	
	// Check if there is new messages, if yes, return a json with all the new messages
	public function checkmessage($id_last_message)
	{
		$q = $this->_db->prepare('SELECT * FROM messages WHERE id > :id_last_message AND to_id = :to_id');
		$q->bindValue(':to_id', $_COOKIE['user_id'], PDO::PARAM_INT);
		$q->bindValue(':id_last_message', $id_last_message, PDO::PARAM_INT);
		$q->execute();
		
		$new_messages['messages'] = array();
		$new_messages['new_last_id'] = $id_last_message;
		$new_last_id = 0;
		
	    while($data = $q->fetch()){
		    array_push($new_messages['messages'], $data['text']);
		    $new_last_id = $data['id'];
	    }
	    
	    if($id_last_message == 0){
		    $new_messages['messages'] = array();
	    }
	    
	    if($id_last_message < $new_last_id)
	    {
	    	$new_messages['new_last_id'] = $new_last_id;
	    }
	    
	    $q = $this->_db->prepare('SELECT status FROM session WHERE peer_with = :id_user and status >= 1');
		$q->bindValue(':id_user', $_COOKIE['user_id'], PDO::PARAM_INT);
		$q->execute();
		
	    $current = $q->fetch(PDO::FETCH_ASSOC);

	    if($current['status'] != 2)
	    {
	    	// If status isn't 2, the peer has closed the session and chat must be closed
	    	return 'disconnected';
	    }
	    else
	    {
		   return json_encode($new_messages); 
	    }
	}
	
	// check if videomode is activated by the peer to start a webRTC call
	public function videomode($user_id)
	{
		$q = $this->_db->prepare('SELECT video_auto, peer_with FROM session WHERE id_user = :id_user and status = 2');
		$q->bindValue(':id_user', $user_id, PDO::PARAM_INT);
		$q->execute();
		
	    $current = $q->fetch(PDO::FETCH_ASSOC);
	    
	    if($current['video_auto'] == 1){
		    return $current['peer_with'];
	    }
	    else{
		    return 0;
	    }
	}
	
	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}
?>