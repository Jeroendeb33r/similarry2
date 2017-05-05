<?php

class url{
	
	public function getUrl($db_conn, $name){
		
		$db = new DB(...$db_conn);
		$result = $db->select('SELECT url FROM page WHERE name = ?', array($name), array('s'));
		
		if(count($result) != 0){
			
			foreach($result as $part => $value){
				
				return($value['url']);
				
			}
		
		}else {
				
			return false;
			
		}		
		
	}
	
}


?>