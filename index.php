<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
*{
    font-family: arial, sans-serif;
}
table {
  border-collapse: collapse;
  position: relative;
  left: 25%;
}
th{
  width: 202.1px;
  font-weight: bold;
  text-align: center;
  background: #000;
  color:#fff;
  padding: 15px;
  position: relative;
  left: -20px;
}
td{
  width: 200px;
  text-align: center;
  padding: 8px;
  border: 2px solid #ddd;
}
 a{
    text-decoration: none;
    background: #15D679;
    color: #fff;
    font-variant-caps: all-small-caps;
    font-weight: bold;
    padding: 10px 30px;
    margin: 15px;
    display:block;
}
a:hover{
   background: #15c579;
}
.result{
 position: fixed;
 top: 5%;
 left: 85%;
}
.vote{
 position: fixed;
 top: 5%;
 left: 75%;

}
input{
  border: none;
  background: #e9e9e9;
  padding: 10px;
}
.btn{
    background: #15D679;
    color: #fff;
    font-size: 1.2em;
    font-variant-caps: all-small-caps;
    font-weight: bold;
    padding: 10px 30px;
    margin: 15px;
  
}
body{
  text-align:center;
}
</style>

</head>

<body>

<form action="index.php" method="post">
        <h1>Add Project</h1>
        <input type="text" name="projectName" placeholder="Project name" value="">
        <input class="btn" type="submit" value="Add" name="addProName">
    </form>
    <a class="vote" href="vote.php">Vote</a>
    <a href="result.php" class="result">Results</a>

</body>

</html>

<?php
$con = mysqli_connect("localhost" ,"root","","voting");
if(isset($_POST['addProName']) && !empty($_POST['projectName'])){
    $proName = $_POST['projectName'];
        $insert = "INSERT INTO votes(projectName) VALUE ('$proName')";
        $query = mysqli_query($con,$insert);

}

$select = "SELECT * FROM votes";
$sel_query = mysqli_query($con,$select);
  echo '
  <table>
   <tr>
     <th>id</th>
     <th>Project Name</th>
     <th>Votes_count</th>
   </tr>
  </table>';

    while($row = mysqli_fetch_assoc($sel_query)){
       echo '
          <table>
          <tr>
              <td>'.$row["id"].'</td>
              <td>'.$row["projectName"].'</td>
              <td>'.$row["vote_count"].'</td>
          </tr>                  
        </table>';
} 
?>
