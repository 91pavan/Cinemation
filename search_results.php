<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Cinema Information!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
   
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
     
    <![endif]-->

    <!-- Fav and touch icons -->
     <link rel="icon" type="image/png"  href="assets/ico/favicon.png">
    <!--<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">-->
 
  </head>

  <body>

    <div class="container-fluid">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li  class="active"><a href="#">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul><h3>
        <a href="index.php">Cinemation</h3><br/>
        </a>
      </div>

      <hr>

      <!--<div class="jumbotron">
        <form class="form-search" name="form1" action="search_results.php" method="post" >
        <input type="text" class="input-large search-query" name="textboxid" id="textboxid">
        <input class="btn btn-large btn-success" type="submit" value="Search Now!">
        </form>
        <p class="lead">It's easy . Just search for a movie and i will do the rest . You take rest now!</p>
        
      </div>
-->


      <div class="row-fluid">
        <div class="span7">
          <div id="result">
        <?php 
        $flag=0;
		
	$apikey = 'YOUR_API_KEY';
$q = urlencode($_POST['textboxid']); // make sure to url encode an query parameters
if($q) {
// construct the query with our apikey and the query we want to make
$endpoint = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=' . $apikey . '&q=' . $q;

// setup curl to make a call to the endpoint
$session = curl_init($endpoint);

// indicates that we want the response back
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// exec curl and get the data back
$data = curl_exec($session);
if($data!="") {
// remember to close the curl session once we are finished retrieveing the data
curl_close($session);

// decode the json data to make it easier to parse the php
$search_results = json_decode($data);
if ($search_results === NULL && $search_results!="") die('Error parsing json');
else
{

// play with the data!
$movies = $search_results->movies;
if($movies!="") {

foreach ($movies as $movie) {
$flag=1;
            $image = preg_replace('{/$}', '', $movie->posters->detailed);
            echo "<div class=\"span4\"><img src=".$image." align=\"left\" style=\"margin: 0px 10px 0px 0px;\"></div>";
            
            echo "<b>Title of the Movie :</b><a href=\"".$movie->links->alternate."\" target=\"_blank\">.".$movie->title."</a><br/><br/>";
            echo "<b>Runtime :</b>".$movie->runtime."<br/><br/>";
            echo "<b>Year of the Release :</b>".$movie->year."<br/><br/>";
			if(isset($movie->critics_consensus)) {
            echo "<b>Critics :</b>".$movie->critics_consensus."<br/><br/>"; }
			if(isset($movie->ratings->critics_score)) {
            echo "<b>Critics Rating :</b>".$movie->ratings->critics_score."<br/><br/>";}
			if(isset($movie->ratings->audience_rating)) {
            echo "<b>Audience Rating :</b>".$movie->ratings->audience_rating."<br/><br/>";}
            if($movie->synopsis!="") {
            echo "<p><b>Synopsis :</b>".$movie->synopsis."<br/></p>";}
            else{echo "<b>Synopsis not present . Sorry :(</b><br/><br/>";}
            if($movie->abridged_cast!="") {
            echo "<b>Cast and Crew:</b><br/><br/>";
            $a=0;
            for($i=0;$i<sizeof($movie->abridged_cast);$i++) 
            {
                $a++;
                echo $a.".".$movie->abridged_cast[$i]->name;
                echo "<br/>";
            }}
			echo "<hr>";
        
}
}

}

}


}
else
{
	echo "Search query empty , please try again!";
}
if($flag==0)
{
	echo "  Wrong search query!";
} 
      ?>
          </div>
          <!--<h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="span6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>-->
      </div>

      <!--<hr>-->
        
      <div class="footer span5">
        
        <?php
        /*$string1 = file_get_contents("http://api.rottentomatoes.com/api/public/v1.0/lists/movies/box_office.json?apikey=YOUR_API_KEY");
        if($string1){
		if($flag==1) {
		echo "<p><h3>You might also like the current box office movies.</h3><br/>";
        $json_b = json_decode($string1, true);
        if($json_b!=""){
        //echo $json_a['movies']['title'];
        foreach($json_b['movies'] as $abcd) {
            $image = preg_replace('{/$}', '', $abcd['posters']['profile']);
            echo "<div class=\"span4\"><img src=".$image." align=\"left\" style=\"margin: 0px 10px 0px 0px;\"></div>";
            
            echo "<b>Title of the Movie :</b><a href=\"".$abcd['links']['alternate']."\" target=\"_blank\">.".$abcd['title']."</a><br/><br/>";
            echo "<b>Runtime :</b>".$abcd['runtime']."<br/><br/>";
			if(isset($abcd['critics_consensus'])) {
            echo "<b>Critics :</b>".$abcd['critics_consensus']."<br/><br/>";}
			if(isset($abcd['ratings']['critics_score'])) {
            echo "<b>Critics Rating :</b>".$abcd['ratings']['critics_score']."<br/><br/>";}
			if(isset($abcd['ratings']['audience_rating'])) {
            echo "<b>Audience Rating :</b>".$abcd['ratings']['audience_rating']."<br/><br/>";}
            
        echo "</p>";
        echo "<hr>";
        }
        }
		}
        }*/
		$endpoint1 = 'http://api.rottentomatoes.com/api/public/v1.0/lists/movies/box_office.json?apikey=' . $apikey ;

// setup curl to make a call to the endpoint
	$session1 = curl_init($endpoint1);

// indicates that we want the response back
	curl_setopt($session1, CURLOPT_RETURNTRANSFER, true);

// exec curl and get the data back
	$data1 = curl_exec($session1);
	if($data1!="") {
// remember to close the curl session once we are finished retrieveing the data
	curl_close($session1);

// decode the json data to make it easier to parse the php
	$search_results1 = json_decode($data1);
	if ($search_results1 === NULL && $search_results1!="") die('Error parsing json');
	else
	{
if($flag==1) {
// play with the data!
$movies1 = $search_results1->movies;
if($movies1!="") {
echo "<p><h4>You might also like the current box office movies.</h4><br/>";
foreach ($movies1 as $movie1) {

            $image = preg_replace('{/$}', '', $movie1->posters->profile);
            echo "<div class=\"span4\"><img src=".$image." align=\"left\" style=\"margin: 0px 10px 0px 0px;\"></div>";
            
            echo "<b>Title of the Movie :</b><a href=\"".$movie1->links->alternate."\" target=\"_blank\">.".$movie1->title."</a><br/><br/>";
            echo "<b>Runtime :</b>".$movie1->runtime."<br/><br/>";
            
			if(isset($movie1->critics_consensus)) {
            echo "<b>Critics :</b>".$movie1->critics_consensus."<br/><br/>"; }
			if(isset($movie1->ratings->critics_score)) {
            echo "<b>Critics Rating :</b>".$movie1->ratings->critics_score."<br/><br/>";}
			if(isset($movie1->ratings->audience_rating)) {
            echo "<b>Audience Rating :</b>".$movie1->ratings->audience_rating."<br/><br/>";}
            echo "</p>";
			echo "<hr>";
        
}
}

}
}
}?>
        
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
