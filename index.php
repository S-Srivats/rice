<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <style media="screen">
      body{background-image:linear-gradient(to right ,Salmon,lightyellow,Moccasin,Plum,skyblue,skyblue,lightgreen,lightyellow,Salmon);
           color:black;}
      .a{margin:2px;
         margin-color:black}
         .error {color: #FF0000;}
    </style>
    <meta charset="utf-8">
    <title>test run</title>
  </head>
  <body>
    <?php
    // define variables and set to empty values
    $nameErr =   $phoneErr = $flatErr="";
    $name = $flat =$brand=$qty = $phone = "";
    $t=0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $t=0;
      }

      else {
        $name = test_input($_POST["name"]);
        $t=1;
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
          $nameErr = "Only letters and white space allowed";
          $t=0;
        }
      }

      if (empty($_POST["flat"])) {
        $flatErr = "Address is required";
        $t=0;
      } else {
        $flat = test_input($_POST["flat"]);
        // check if e-mail address is well-formed
        $t=1;
      }

      if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
        $t=0;
      } else if(strlen($_POST["phone"])!=10){
  $phoneErr = "Enter valid phone number";
  $t=0;
      }
    else{    $phone = test_input($_POST["phone"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      $t=1;

      }

    $brand=$_POST["brand"];
    $qty=$_POST["qty"];


    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>
    <center>
<div class="">
    <h1><u> Place your order:</u></h1>
    <div class='a'>
      <p><span class="error">* required field</span></p>
  <marquee> <b>Please provide  correct information for proper delivery</b></marquee>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <br>
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
<br>

  Phone Number <input type="number" name="phone" value="<?php echo $phone;?>">  <span class="error">* <?php echo $phoneErr;?></span>
    <br>
  <span class="error"><?php echo $phoneErr;?></span>
  <br><br>  <label for="add">Flat Number</label>

  <input id="flatno" name="flat" value="<?php echo $flat;?>">
  <span class="error">* <?php echo $nameErr;?></span><br><br><br>
  <label for="Brand "><b>Choose the brand</b></label>
   <select class="" name="brand" >
     <option value="brand a">Brand a</option>
     <option value="brand b">Brand b</option>
     <option value="brand c">Brand c</option>
     <option value="brand d" selected>Brand d</option>
     <option value="brand e">Brand e</option>
     <option value="brand f" >Brand f</option>
   </select>

  <br><br><br><br>
  <label for="qty"><b>Select No of Kgs</b></label>
  <br>
  <input type="range" id='qty' name="qty" value="5" min="5" max="100" step="5" oninput="num.value = this.value" >
  <br>
  <output id="num">5</output>
  <b>Kg</b>
  <br><br><br><br><br><br><br>
  <input type="submit" onclick="sri()" value="Submit">
</form>
</div>
</div>
</center>
<script type="text/javascript">
function sri(){
 alert("Do you really want to submit")
//  document.getElementById("1").submit;
}

</script>

<?php


if($t==1){


  echo "<h2>Your Input:</h2>";
  echo $name;
  echo "<br>";
  echo $phone;
  echo "<br>";
  echo $flat;
  echo "<br>";
  echo $brand;
  echo "<br>";
  echo $qty;
  echo "<br>";
  echo "Thank You";

  $servername = "db4free.net:3306";
  $username = "rootuser1";
  $password = "Srinidhi123$";

  $dbname = "project101";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("INSERT INTO Cust (name,phone,flatNo,brand,quantity)
  VALUES (:name,:phone,:flatNo,:brand,:quantity)");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':phone', $phone);
  $stmt->bindParam(':flatNo', $flat);

    $stmt->bindParam(':brand', $brand);
     $stmt->bindParam(':quantity', $qty);

$stmt->execute();

 echo "New record created successfully";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;





}

?>

  </body>
</html>
