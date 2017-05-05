<?php

class upload{
	
	public function uploadImage($target, $files, $size, $limit, $l, $d){
		
		$error = [];
		if(count($files) > $limit){
			
			$error[] = $limit . " " . input('err limit of files is', $l, $d)->text();
			return $error;
			exit;
			
		}
		
		foreach($files as $file){
			
			if(!file_exists($target . '/' . $file["name"])){
				
				if($file['size'] < $size){
			
					if(getimagesize($file['tmp_name']) != 0){
						
						if (!move_uploaded_file($file["tmp_name"], $target . '/' . $file["name"])) {
							
							$error[] = $file['name'] . ' ' . input('err could not be uploaded', $l, $d)->text();
							
						}
						
					}else{
						
						$error[] = $file['name'] . ' ' . input('err is not image', $l, $d)->text(); //if uploaded file is no image
						
					}
				}else{
					
					$error[] = $file['name'] . ' ' . input('err is to large', $l, $d)->text(); //if file already exists in folder
					
				}
			}else{
				
				$error[] = $file['name'] . ' ' . input('err already exists', $l, $d)->text(); //if file already exists in folder
				
			}
		}
		
		return $error;
		
	}
}

?>