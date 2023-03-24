<!--class3b.php-->
<!DOCTYPE html>
<html>  
  <head>
    <title>HTML Embedded Form with echo and \</title>
    <style>
      .form{color:blue;}
      .formhandling{color:red;}
      .display-name{color:green;}
      table, tr, td {
  border: 1px solid black;
}
    </style>
  </head>
  <body>
    <?php					
      echo "<h1>Enter minimum and maximum numbers</h1><BR>";
      echo "<h3>Here are six different number find the minimum and maximum numbers in them</h3><br>";

//       To add
// 
// 
//       

      //Form 
      echo "<form id=\"form1\" method=\"post\" action=\"ex3\" >"; //Beginning form tag
          // Form fields to input data
          echo "<label>Enter the  minimum number</label>"; 
          echo "<br />";

          echo "<input id=\"inputRows\" type=\"text\" name=\"numOne\" required=\"required\">"; 
          echo "<br />";
          echo "<br />";

          echo "<label>Enter the  minimum number</label>"; 
          echo "<br />";
          
          echo "<input id=\"inputRows\" type=\"text\" name=\"userDataSet\" required=\"required\">"; 
          echo "<br />";
          echo "<br />";


          // Submit button to send form data		
          echo "<input id=\"submitbutton1\" type=\"submit\" name=\"send\" value=\"SEND IT\" />"; 
          echo "<br />";

          echo "<br />";

      echo "</form>"; //Closing form tag
      //Form Handling
      //Go below only after a user pressed the input button name="send" 
    if (isset($_POST['send'])) {

        $one = $_POST['numOne'];
        $two = $_POST['numTwo'];


        getOutputs();

     

      
        
    }

    function getMessage(){
      return array(
        "negative"=>"One or both of the number you entered is negative",
        "same"=>"The numbers you entered are the same",
        "multi"=>" is multiple of:",
        "gcd"=>"Their greatest divisor is ",
        "lcm"=>"There least common multiple is "
      );
    }
    
    function getMultiple25($a){
        if ($a % 2 == 0 && $a % 5 == 0)
            return "2 and 5";
        elseif ($a % 2 == 0)
            return "2";
        elseif($a % 5 == 0)
            return "5";
        else
            return "not 2 or 5";
    }

    function setGCDivisor($a,$b){
        if ($b == 0) 
            return $a; 
        else 
            return setGCDivisor($b, $a % $b);
    }
    function getGCDivisor($a,$b){
        return setGCDivisor($a, $b);
    }
    function getLCMultiple($a,$b){
       return ($a * $b)/setGCDivisor($a, $b);
    }

    function getOutputs(){
        global $one;
        global $two;

        if($one==$two){
            echo getMessage()["same"];
            return;
        } 
        if($one<0 or $two<0){
            echo getMessage()["negative"];
            return;
        }


        echo $one . getMessage()["multi"] . getMultiple25($one)."</br>";
        echo $two . getMessage()["multi"] . getMultiple25($two)."</br>";

        echo  getMessage()["gcd"] . getGCDivisor($one,$two)."</br>";

        echo  getMessage()["lcm"] . getLCMultiple($one,$two)."</br>";



    }
    ?>
  </body>
</html>

