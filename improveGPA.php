<!DOCTYPE html>
<html lang="en">

<head>
    <title>GPA Improvement Calculator</title>
    <style>
        .error {
          color: #FF0000;
        }
    </style>
</head>

<body>
    <h1>GPA Improvement Calculator</h1>

    <p><span class="error">All form fields must be completed for the GPA calculator to function.</span></p>

    <form method="post" action="improveGPA.php">

    <?php

    $name = "" ;
   $nameErr = "";
    $email   = "" ;
   $emailErr = "";
   $agree = "";
    $agreeErr = "";
    $currentGPA = "";
    $currentGPAErr = "";
    $currentCredits = "" ;
     $currentCreditsErr = "";
     $newCredits = "";
    $newCreditsErr = "";
    $GPAincrease = "";
    $GPAincreaseErr = "";
    $newGPA="????";
    



 if (isset($_POST['submit'] )) {
      
       $name=$_POST['name'] ;
      if ( preg_match ( "/^[a-zA-Z ]*$/" , $name)) {
        $nameErr = "" ;
       }
     else {
       $nameErr = "Your name must consists of letters and white space" ;
      } 


      $email = $_POST['email'] ; 
     if(filter_var($email, FILTER_VALIDATE_EMAIL )){
      $emailErr = "";
     }
     else {
     $emailErr = "Invalid email format" ;
         }

      $agree  = isset($_POST['agree']) ;
        if ($agree) {
       $agreeErr = "" ;
    }
    else {
        $agreeErr = "You must agree to terms and conditions" ;
        } 
   
   

         $currentGPA = $_POST['currentGPA'] ;
    
        
   
          if (filter_var($currentGPA, FILTER_VALIDATE_FLOAT) === 0.0 ||filter_var($currentGPA, FILTER_VALIDATE_FLOAT) && $currentGPA >= 0 && $currentGPA <=                     4.0)
          {
             $currentGPAErr = "";
          }
          else {
          $currentGPAErr = "Your GPA should be in between 0.0 and 4.0" ;
          } 


     $currentCredits = $_POST['currentCredits'];
         
         if (filter_var($currentCredits, FILTER_VALIDATE_INT) === 0 || filter_var($currentCredits, FILTER_VALIDATE_INT) && $currentCredits >= 0){
                  
             $currentCreditsErr=""; 
                }
            else {
             $currentCreditsErr="Your current number of credits must be a positive number";
            }
    




       $newCredits = $_POST['newCredits'] ;
            if (filter_var($newCredits, FILTER_VALIDATE_INT) === 0 || filter_var($newCredits, FILTER_VALIDATE_INT) && $newCredits > 0){
           $newCreditsErr = "" ;
           }
            else {
              $newCreditsErr = "(the number of credits this semester an integer greater than 0) ";
              }
     


	$GPAincrease = $_POST['GPAincrease'] ;


          if (filter_var($GPAincrease, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($GPAincrease, FILTER_VALIDATE_FLOAT) && $GPAincrease >= 0){
             $GPAincreaseErr ="" ;
        }

         else {
          $GPAincreaseErr = "(your desired GPA must be a positive number)" ;
           }
   



          if (($nameErr== "") && ($emailErr =="") && ($agreeErr =="") && ($currentGPAErr == "" ) && ($currentCreditsErr == "")
           && ($newCreditsErr =="") && ($GPAincreaseErr == "")) {
     

  
         $currentGPAhours = $currentGPA * $currentCredits;
         $desiredGPA = $currentGPA + $GPAincrease;
         $desiredGPAhours = $desiredGPA * ($currentCredits + $newCredits);
         $GPAhoursincrease = $desiredGPAhours - $currentGPAhours;
         $newGPA = $GPAhoursincrease / $newCredits;
         $newGPA = number_format($newGPA,2,'.','.');
     }
    

 }

     ?>

          


        
        Name: <input type="text" size="35" name="name" value="<?php echo $name;?>">
        <span class="error"><?php echo $nameErr; ?></span>
        <br><br>

        E-mail: <input type="text" size="35" name="email" value="<?php echo $email;?>">
        <span class="error"><?php echo $emailErr; ?></span>
        <br><br>

        <input type="checkbox" name="agree" <?php echo (empty($_POST['agree'] )) ? '':'checked' ?>>
        I agree to the terms and conditions of this website.
        <span class="error"><?php echo $agreeErr; ?></span>
        <br><br>

        Current GPA: <input type="text" size="4" name="currentGPA" value="<?php echo $currentGPA; ?>">
        <span class="error"><?php echo $currentGPAErr; ?></span>
        <br><br>

        Current Total Credits: <input type="text" size="3" name="currentCredits" value="<?php echo $currentCredits;?>">
        <span class="error"><?php echo $currentCreditsErr; ?> </span>
        <br><br>

        I am taking <input type="text" size="3" name="newCredits" value="<?php echo $newCredits;?>">
        <span class="error"><?php echo $newCreditsErr; ?></span> credits this semester.

        If I want to raise my GPA
        <input type="text" size="4" name="GPAincrease" value="<?php echo $GPAincrease; ?>">
        <span class="error">  <?php echo $GPAincreaseErr; ?> </span> points,
        I need a <span style="font-weight: bold;"><?php echo $newGPA;?></span> GPA on my courses this semester.
        <br><br>

        <input type="submit" name="submit" value="Calculate">

    </form>

</body>

</html>
