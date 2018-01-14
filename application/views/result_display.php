<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Take Quiz</title>

</head>
<body>

<div id="container">
	<h1>Play the Quiz!</h1>
    
    <?php 

    $score =0; 
    $array1= array(); 
    $array2= array();   
    
    if(isset($checks)){
      foreach($checks as $checkans) 
      { 
        array_push($array1, $checkans); 
      }
    }
    
    if(isset($results)){
      foreach($results as $res) 
      {
        array_push($array2, $res['answer']);
      }
    }

    $questions_numbers = base64_decode($_COOKIE['question_numbers']);

		for ($x=1; $x <= $questions_numbers; $x++) { 

      if ($array2[$x] != $array1[$x]) { 
          
      } else { 
          $score+1; 
      } 
    } 

    echo ($score.'/'. $questions_numbers);
    
    ?>


</div>

</body>
</html>