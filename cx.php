<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<title>放假结伴回家查询小伙伴</title>

<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link href="css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.9.1.js" ></script>
<script type="text/javascript" src="js/date.js" ></script>
<script type="text/javascript" src="js/iscroll.js" ></script>

<script type="text/javascript" src="js/jquery.cityselect.js"></script>
<script type="text/javascript">
$(function(){
	$("#city_1").citySelect({
		nodata:"none",
		required:false
	}); 
	
	
	
});
</script>
<script type="text/javascript">
$(function(){
	$('#beginTime').date();
	$('#endTime').date({theme:"datetime"});
});
</script>
<script type="text/javascript">
function empty(theform)
{
	
	if(theform.time.value=="")
	{
		alert("请选择时间!");
		theform.time.focus();
		return(false);
	}
	if(theform.prov.value=="")
	{
		alert("请选择省份!");
		theform.prov.focus();
		return(false);
	}
	

	
}




</script>
<style>

.prov {
display: block;
width: 100%;
height: 34px;
padding: 6px 12px;
font-size: 14px;
line-height: 1.42857143;
color: #555;
background-color: #fff;
background-image: none;
border: 1px solid #ccc;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.city {
display: block;
width: 100%;
height: 34px;
padding: 6px 12px;
font-size: 14px;
line-height: 1.42857143;
color: #555;
background-color: #fff;
background-image: none;
border: 1px solid #ccc;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
</style>
</head>
<body>  
<?php

	include "conn.php";
	$db_num="select id from pinche";
	$db_query=mysql_query($db_num);
	$db_nums=mysql_num_rows($db_query);
?> 
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="list-group">
				 <p  class="list-group-item active"><strong>找TA结伴回家</strong><span style="float:right;">共<?php echo $db_nums;?>人参加</span></p>
				 
			</div>
			
			<form role="form" action="" method="post"  onSubmit="return empty(this)">
				<!--<div class="form-group">
					 <label for="exampleInputEmail1"></label><input type="text" placeholder="姓名" name="name" class="form-control" id="exampleInputEmail1" />
				</div>
				<div class="form-group">
					 <select id="exampleInputEmail1" name="sex" class="form-control">
    
					<option value="男">男</option>
					<option value="女">女</option>
    
					</select>
				</div>-->
				
				<div class="form-group">
					<input placeholder="选择回家具体日期" name="time"   id="beginTime" class="form-control" />
						<div id="datePlugin"></div>
				</div>
				
				<div class="form-group">
					 <label for="exampleInputEmail1">坐车到达城市(只需选择城市)</label>
					 
					<div id="city_1">
							<select  class="prov" name="prov" ></select>
							<select class="city" name="city" disabled="disabled"></select>
						</div>
				</div>
				<div class="form-group">
					 <label for="exampleInputEmail1"></label><input type="text" placeholder="车次 如:D2202,不知道留空，不要乱填" name="checi" class="form-control" id="exampleInputEmail1" />
				</div>
				<!--<div class="form-group">
					 <label for="exampleInputEmail1"></label><input type="text" placeholder="您的联系电话" name="tel" class="form-control" id="exampleInputEmail1" />
				</div>-->
				<input type="submit" name="submit" class="btn btn-default btn-block btn-primary" value="查询小伙伴">
			</form>
			
		
			
		</div>
	</div>
</div>
<?php
	
	include "conn.php";
	$openid=$_GET['openid'];
	

?>

	<br>
	<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table table-hover table-condensed table-bordered">
				<thead style="font-size: 14px; text-align:center;font-weight: normal;">
					<tr>
						<th style=" text-align:center;font-weight: normal;">
							姓名
						</th>
						<th style="text-align:center;font-weight: normal;">
							性别
						</th>
						<th style="text-align:center;font-weight: normal;">
							时间
						</th>
						<th style="text-align:center;font-weight: normal;">
							车次
						</th>
						<th style=" text-align:center;font-weight: normal;">
							短信Ta
						</th>
					</tr>
				</thead>
				<tbody style="font-size: 12px; text-align:center;">
				<?php
				if(isset($_POST[submit])){
					
					$time=$_POST['time'];
					$checi=$_POST['checi'];
					$city=$_POST['city'];
					$sqlc="select * from pinche where time='{$time}' and city='{$city}'";
					$queryc=mysql_query($sqlc);
					$num=mysql_num_rows($queryc);
					while($rowc=mysql_fetch_array($queryc)){
				?>
				
					<tr class="success">
						<td>
							<?php echo $rowc['name'];?>
						</td>
						<td>
							<?php echo $rowc['sex'];?>
						</td>
						<td>
							<?php echo $rowc['time'];?>
						</td>
						<td>
							<?php echo $rowc['checi'];?>
						</td>
						<td>
							<img src="email.png" style="width:15px;height:12px;"><a href="sms:<?php echo $rowc[tel];?>">短信Ta</a>
						</td>
					</tr>
					<?php
					}
					}
					?>
					
				
				</tbody>
			</table>
			<p style="text-align:center;">
			<strong style="color:red;"><?php echo $time;?></strong>&nbsp前往&nbsp <strong style="color:red;"><?php echo $city;?></strong>&nbsp的小伙伴，主页君为你找到&nbsp<strong style="color:red;"><?php echo $num;?></strong>&nbsp位
			</p>
		</div>
	</div>
</div>
	
	<br>
 <div style="font-size: 13px;line-height: 20px;width: 100%;text-align: center;color: #999999;margin-top: -5px; font-weight:blod;">
         <span> ©2014 长大校园助手版权所有</span>
    </div>

</body>
</html>
