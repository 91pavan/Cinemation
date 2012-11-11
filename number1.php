<?php
$apikey = 'qmtbwkhqwyg8ne2vypzq2mwj';
$q = urlencode('Kung Fu Panda'); // make sure to url encode an query parameters

// construct the query with our apikey and the query we want to make
$endpoint = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=' . $apikey . '&q=' . $q;

// setup curl to make a call to the endpoint
$session = curl_init($endpoint);

// indicates that we want the response back
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// exec curl and get the data back
$data = curl_exec($session);

// remember to close the curl session once we are finished retrieveing the data
curl_close($session);

// decode the json data to make it easier to parse the php
$search_results = json_decode($data);
if ($search_results === NULL) die('Error parsing json');

// play with the data!
$movies = $search_results->movies;
echo '<ul>';
foreach ($movies as $movie) {
  echo '<li><a href="' . $movie->links->alternate . '">' . $movie->title . " (" . $movie->year . ")</a></li>";
            $image = preg_replace('{/$}', '', $movie->posters->detailed);
            echo "<div class=\"span4\"><img src=".$image." align=\"left\" style=\"margin: 0px 10px 0px 0px;\"></div>";
            
            echo "<b>Title of the Movie :</b><a href=\"".$movie->links->alternate."\" target=\"_blank\">.".$movie->title."</a><br/><br/>";
            echo "<b>Runtime :</b>".$movie->runtime."<br/><br/>";
            echo "<b>Year of the Release :</b>".$movie->year."<br/><br/>";
            echo "<b>Critics :</b>".$movie->critics_consensus."<br/><br/>";
            echo "<b>Critics Rating :</b>".$movie->ratings->critics_score."<br/><br/>";
            echo "<b>Audience Rating :</b>".$movie->ratings->audience_rating."<br/><br/>";
            if($movie->synopsis!="") {
            echo "<p><b>Synopsis :</b>".$movie->synopsis."<br/></p>";}
            else{echo "<b>Synopsis not present . Sorry :(</b><br/><br/>";}
            
            echo "<b>Cast and Crew:</b><br/><br/>";
            $a=0;
            for($i=0;$i<sizeof($movie->abridged_cast);$i++) 
            {
                $a++;
                echo $a.".".$movie->abridged_cast[$i]->name;
                echo "<br/>";
            }
        
}
echo '</ul>';


?>
