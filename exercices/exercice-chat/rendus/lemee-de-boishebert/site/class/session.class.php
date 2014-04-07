<?php
/*
	Session class save and update the session table in database
	This table store past and present connection to the site

*/


class Session
{
	private $_db; // database object
	private $_id_user; // id of the user in account table
	private $_lat = 0; // latitude of the user (0 if no access)
	private $_long = 0; // longitude of the user (0 if no access)
	private $_video_auto; // Auto launch video when chatting : 0 No, 1 Yes
	private $_with; // id of the other user, the user is chatting with

	public function __construct($db)
	{
		$this->setDb($db);
	}
	
	public function set($id_user, $lat, $long, $status, $video_auto)
	{
		$this->_id_user = $id_user;
		$this->_lat = $lat;
		$this->_long = $long;
		$this->_video_auto = $video_auto;
	}
	
	public function add()
	{
		/*
			Add a new session to database
		*/

		$q = $this->_db->prepare('INSERT INTO session SET id_user = :id_user, latitude = :lat, longitude = :long, ip = :ip, time = :time, status = :status, video_auto = :video_auto, last_activity = :last_activity');
	
	    $q->bindValue(':id_user', $this->_id_user, PDO::PARAM_INT);
	    $q->bindValue(':lat', $this->_lat, PDO::PARAM_INT);
	    $q->bindValue(':long', $this->_long, PDO::PARAM_INT);
	    $q->bindValue(':ip', $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
	    $q->bindValue(':time', date("Y-m-d H:i:s"));
	    $q->bindValue(':status', 1); // status (0: disconnected, 1: waiting for a peer, 2: in chat)
	    $q->bindValue(':video_auto', $this->_video_auto, PDO::PARAM_BOOL);
	    $q->bindValue(':last_activity', date("Y-m-d H:i:s"));
	    
	    $q->execute();
	    print_r($q->errorInfo());
	}
	
	public function activity($user_id)
	{
		/*
			This function has two features :
					Update the last time activity of current user
					Check activity of all active user (if no activity beetween the last 10 seconds, user status turn to disconnected)
		*/
		
		$this->_id_user = $user_id;
		
		$q = $this->_db->prepare('UPDATE session SET last_activity = :last_activity WHERE id_user = :id_user and status >= 1 ORDER BY id DESC LIMIT 1');
		
	    $q->bindValue(':id_user', $this->_id_user, PDO::PARAM_INT);
	    $q->bindValue(':last_activity', date("Y-m-d H:i:s"));
	
	    $q->execute();

	    
	    // Second part : 
	    $q = $this->_db->prepare('SELECT last_activity, id FROM session WHERE status >= 1');
		$q->execute();
		//print_r($q->errorInfo());
		//echo 'erase';
		
	    while($data = $q->fetch()){
		    if(strtotime($data['last_activity'])-time() < -5){
			    $this->status($data['id'], 0);
		    }
	    }
	}
	
	public function find_peer($user_id)
	{
		/*
			This function has two features :
					Update the last time activity of current user
					Check activity of all active user (if no activity beetween the last 10 seconds, user status turn to disconnected)
		*/
	    
	    
	    //Check if user isn't in already peer with someone
	    $q = $this->_db->prepare('SELECT * FROM session WHERE id_user = :id_user and status = 2');
		$q->bindValue(':id_user', $user_id, PDO::PARAM_INT);
		$q->execute();
		
	    $data = $q->fetch(PDO::FETCH_ASSOC);
	    
	    if($data != false){
		    echo "true";
	    }
	    else{
		    $q = $this->_db->prepare('SELECT * FROM session WHERE id_user != :id_user and status = 1');
			$q->bindValue(':id_user', $user_id, PDO::PARAM_INT);
			$q->execute();
			
		    $peer = $q->fetch(PDO::FETCH_ASSOC);
		    
		    
		    if($peer != false){
		    	$q = $this->_db->prepare('SELECT * FROM session WHERE id_user = :id_user and status = 1');
				$q->bindValue(':id_user', $user_id, PDO::PARAM_INT);
				$q->execute();
				
			    $current = $q->fetch(PDO::FETCH_ASSOC);
	
			    $this->peer($current['id'], $peer['id_user']);
			    $this->peer($peer['id'], $user_id);
			    
			    // Return 1 when a peer is found
			    echo "true";
		    }
		}
	}
	
	public function peer_id($user_id){
		$q = $this->_db->prepare('SELECT peer_with FROM session WHERE id_user = :id_user and status = 2');
		$q->bindValue(':id_user', $user_id, PDO::PARAM_INT);
		$q->execute();
		
	    $current = $q->fetch(PDO::FETCH_ASSOC);

	    return $current['peer_with'];
	}
	
	public function peerinfos($user_id){
		$peerinfos = array();
		
		$q = $this->_db->prepare('SELECT peer_with FROM session WHERE id_user = :id_user and status = 2');
		$q->bindValue(':id_user', $user_id, PDO::PARAM_INT);
		$q->execute();
		
	    $current = $q->fetch(PDO::FETCH_ASSOC);
	    
	    $q = $this->_db->prepare('SELECT * FROM account WHERE id = :id_user');
		$q->bindValue(':id_user', $current['peer_with'], PDO::PARAM_INT);
		$q->execute();
	    $infos = $q->fetch(PDO::FETCH_ASSOC);

	    $peerinfos['login'] = $infos['login'];
	    $peerinfos['message'] = $infos['message'];
	    
	    $q = $this->_db->prepare('SELECT * FROM session WHERE id_user = :id_user and status = 2');
		$q->bindValue(':id_user', $current['peer_with'], PDO::PARAM_INT);
		$q->execute();
		$infos2 = $q->fetch(PDO::FETCH_ASSOC);
	    
	    $peerinfos['latitude'] = $infos2['latitude'];
	    $peerinfos['longitude'] = $infos2['longitude'];

	    return json_encode($peerinfos);
	}
	
	
	public function session_id($user_id){
		$q = $this->_db->prepare('SELECT id FROM session WHERE id_user = :id_user and status = 2');
		$q->bindValue(':id_user', $user_id, PDO::PARAM_INT);
		$q->execute();
		
	    $current = $q->fetch(PDO::FETCH_ASSOC);

	    return $current['id'];
	}
	
	public function next(){
	    $this->status($this->session_id($_COOKIE['user_id']), 1);
	}
	
	public function reset(){
	    $this->status($this->session_id($_COOKIE['user_id']), 1);
	}

	public function status($session_id, $status)
	{
		/*
			This function change user status
			0: Inactive / Old session
			1: Looking for a peer
			2: In chat
		*/
		
		$q = $this->_db->prepare('UPDATE session SET status = :status WHERE id = :session_id');
	    $q->bindValue(':session_id', $session_id, PDO::PARAM_INT);
	    $q->bindValue(':status', $status, PDO::PARAM_INT);
	    $q->execute();
	}
	
	public function peer($session_id, $peer_with)
	{
		/*
			This function set a chat
		*/
		
		
		$q = $this->_db->prepare('UPDATE session SET peer_with = :peer_with, status = 2 WHERE id = :session_id');
	    $q->bindValue(':session_id', $session_id, PDO::PARAM_INT);
	    $q->bindValue(':peer_with', $peer_with, PDO::PARAM_INT);
	    $q->execute();
	}
	
	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}
?>