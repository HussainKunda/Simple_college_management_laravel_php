@extends('layout.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	<title>H.K University</title>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Keywords" content="College, Pokhara, IT College, Lions Marga, college in pokhara, nepalIT">
 <meta name="author" content="Bishworaj Poudel">
 <link rel="stylesheet" type="text/css" href="css/style.css">
<script src="javascript/js.js"></script>
<script src="javascript/validatename.js"></script>
<link rel="stylesheet" href="css.css">
<style>
body{
	background-color:skyblue;
	color:black;
	font-size:15px;
}
</style>
</head>
<body class="body">

<h3>Contact</h3>
<h4>H.K University<br>
SM Complex</h4>
Dahod, Gujarat, india
<pre>
Phone : +918849562733<br>
Email :  info@hku.edu.np<br>
Facebook : http://facebook.com<br>
</pre>


<!DOCTYPE html>
<html>
<body>

<br>
<br>

<strong>If you are student please enter your student number:</strong>
<center>
<input id="numb">

<button type="button" onclick="myFunction()">Submit</button>

<p id="demo"></p>
</center>
<hr>
<footer class="mainFooter">
  <center>
  <a href="#">Facebook</a>
  <a href="#">Twitter</a>
  <a href="#">Youtube</a>
  </center>
</footer>
<script>
function myFunction() {
    var x, text;

    // Get the value of the input field with id="numb"
    x = document.getElementById("numb").value;

    // If x is Not a Number or less than one or greater than 10
    if (isNaN(x) || x < 1 || x > 1000) {
        text = "Input not valid";
    } else {
        text = "Input OK";
    }
    document.getElementById("demo").innerHTML = text;
}
</script>

</body>
</html> 
<script type="text/javascript">
  document.title="About Us";
</script>
</body>

</html>
@endsection