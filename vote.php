<?php

    $con = mysqli_connect("localhost","root","","voting");

    $sel = "SELECT * FROM votes";
    $query = mysqli_query($con,$sel);

?>

<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <style>
            *{
                font-family: sans-serif;
            }
            body{
                margin:0;
                padding:0;
                background: #e8e8e8;
            }
            .con{
            width: 80%;
            margin-left: 20%;
            display: inline-block;
            }

            .vote_con{
                display: inline-block;
                width: 200px;
                background: #fff;
                box-shadow: 3px 3px 8px rgba(0,0,0,0.3);
                height: 150px;
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
                padding: 10px 15px;
                position: relative;
                top:30px;
            }
            .even{
                border: none;
                font-variant-caps: all-petite-caps;
                color: #fff;
                background: #15D679;
                font-weight: bolder;
                letter-spacing: 2px;
                padding: 10px 15px;
                position: relative;
                top:30px;
            }
            .vote_btn:disabled {
              background: #dddddd !important;
              color: black;
            }
            h2{
                text-align: center;
                color: #fff;
                padding: 5px 0px;
                background: #1e1e1e;
                font-variant-caps: all-small-caps;
            }
            p{
                font-weight: bolder;
                font-variant-caps: all-small-caps;
                text-align: center;
                position: relative;
                top: -20px;
                background: #fff;
                padding: 5px;
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
                top: 10%;
                left: 140px;
            }
        </style>
    </head>
    <body>
    <h2>Vote to your favorite Project</h2>
    <p>single chance to vote</p>
        <div class="circle"></div>
        <div class="con">
        <?php
        while($row = mysqli_fetch_assoc($query)){
        ?>        
        <div class="vote_con">
            <h4><?php echo $row["projectName"];?></h4>
            <form action="vote.php" method="post">
                <input onclick="vote(this)" id= "<?php echo $row['id'];?>" type="submit" class="vote_btn <?php if($row["id"]% 2 == 0) echo "even";else echo "odd";?>"  value="vote <?php echo $row["id"]?>" name="btn<?php echo $row["id"]?>">
            </form>
        </div>
        <?php
        }
        ?>
        </div>
        <a class="back" href="index.php">Back</a>
    </body>
</html>
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
                console.log(data);
            }            
        })
        
        if(count==1){
        $(".vote_btn").attr("disabled",true);
        }else{
        $(".vote_btn").attr("disabled",false);
        }

    }
    // setInterval(() => {
    //     location.reload();
    // }, 1500);
</script>