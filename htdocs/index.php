<?php
session_start();
include '../authdb/config.php';
include '../authdb/opendb.php';?>
<html>
<title>Welcome</title>
      <h1>Welcome to the test site </h1>
<?php
        $max_results = 100;
        $getlimitsql="SELECT * from genericdb.stuff order by date LIMIT $max_results ;";
        $result=mysql_query($getlimitsql);
        //echo $getlimitsql
        //echo $result
        ?>
        <?php while ($i = mysql_fetch_array($result)) {
/* This is where you print your current results to the page */
        ?><p><small><?php echo date("F d, Y" ,strtotime($i[2])) ?><?php echo ":</small> ".$i[3]?>: 
        <?php echo $i[4]?><?php }?>
               </div>
    <div id="footerline"></div>
  </div>
</html>
<?php include '../authdb/closedb.php';?>
