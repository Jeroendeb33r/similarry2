<?php

$json_url = "http://api.themoviedb.org/3/search/movie?query=heat&api_key=119774138ec7af2f587f9bbd77ad1a89";
$json = file_get_contents($json_url);

print_r($json);







?>