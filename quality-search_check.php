<?php
session_start();
header("Content-type:text/html; charset=utf-8");
require_once('conn.php');
$quality_id=$_POST['quality_id'];

$sql="select * from orders where order_id='$quality_id' ";
$sql0="select * from smt where order_id='$quality_id' ";

$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);

$result0=mysqli_query($conn,$sql0);
$num0=mysqli_num_rows($result0);
if ($num0>0) {
  $_SESSION['order_id']=$quality_id;
    header("Location: quality-add.php");
    // echo "yes";
	exit;
}elseif($num>0){
    $_SESSION['order_id']=$quality_id;
    echo "<script>alert('警告！此订单可能未进行生产。系统测试阶段允许继续操作');window.location.href='quality-add.php';</script>";
    // header("Location: quality-add.php");
    // echo "yes";
	exit;
}else{
  header("Location: quality-search-fail.php");
  echo "no";
	die('Could not connect:' .mysqli_error());
	exit;
	}

mysqli_close($conn);

?>
