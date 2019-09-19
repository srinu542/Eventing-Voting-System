<?php

    $con = mysqli_connect("localhost","root","","voting");

    $sel = "SELECT * FROM votes";
    $query = mysqli_query($con,$sel);
?>

<html>
    <head>
        <title>Vote</title>
    <script src="jquery-1.10.2.min.js"></script>
    <script src = "https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <style>
*{
  font-family: sans-serif;
  margin:0;
  padding:0;
}
body{
  margin:0;
  padding:0;
  background: #e8e8e8;
}
.con{
  width: 100%;
  position: absolute; 
  top: 100px;
  display: grid;
  font-size:.8em;
  grid-template-columns:repeat(auto-fill,minmax(180px,230px));
  box-sizing: border-box;
  /* margin:50px; */
}

.vote_con{
  display: grid; 
  background: #fff;
  box-shadow: 3px 3px 8px rgba(0,0,0,0.3);
  height: 100px;
  text-align: center;
  padding: 10px;
  margin: 20px 25px;
}
h4{
  position: relative;
  top:10px;
  color: #1e1e1e;
  text-align: center;
  left: 10px;
  font-variant-caps: petite-caps;
}
.odd{
  border: none;
  color: #fff;
  font-variant-caps: all-petite-caps;
  background: #1967da;
  font-weight: bolder;
  letter-spacing: 2px;
}
.even{
  border: none;
  font-variant-caps: all-petite-caps;
  color: #fff;
  background: #15D679;
  font-weight: bolder;
  letter-spacing: 2px;
}
.vote_btn{
  padding: 10px 25px;  
  position: relative;
  top:10px;
}
.vote_btn:disabled {
  background: #dddddd !important;
  color: #0d0d0d;
}
header{
  overflow:hidden;
  box-sizing: border-box;
  width:100%;
  position:relative;
  font-variant-caps: all-small-caps;
  top:0px;
  text-align: center;
}

header h2{
  background: #000;
  color:#fff;
  padding: 5px 0px;
  margin:0px;
}

header p{
  background: #fff;
  color:#1e1e1e;
  padding: 5px 0px;
  font-weight:bold;
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
a:hover,.even:hover{
  background: #15c579;
}
.odd:hover{
  background:#1f6fff;
}
.back{
  position: fixed;
  top: 90%;
  left: 10px;
}
  </style>
</head>
<body>

    <header>
    <h2>Vote to your favorite Project</h2>
    <p>single chance to vote</p>
    </header>

    <div class="con">
    <?php
    while($row = mysqli_fetch_assoc($query)){
    ?>        
    
    <div class="vote_con">
      <h4><?php echo $row["projectName"];?></h4>
      <form action="vote.php" method="post">
        <input onclick="vote(this)" id= "<?php echo $row['id'];?>" type="submit" class="vote_btn <?php if($row["id"]% 2 == 0) echo "even";else echo "odd";?>"  value="vote" name="btn<?php echo $row["id"]?>">
      </form>
    </div>
    
    <?php
    }
    ?>
    
    </div>
    <a class="back" href="index.php">Back</a>
    
<script>
let btn_id,btn_name;
var count = 0;

function vote(btn){
  count++;
  var btn_obj ={};

  btn_obj.btn_id = btn.id;
  btn_obj.btn_name = btn.name;

  $.ajax({
    url: "update.php",
    method: "POST",
    data: {obj: JSON.stringify(btn_obj)},
    success: function(data){
      console.log("voted");
    }
  })
  
  if(count==1){
    $(".vote_btn").attr("disabled",true);
  }else{
    $(".vote_btn").attr("disabled",false);
  }
}

setInterval(() => {
    location.reload();
}, 3000);

</script>
</body>
</html>