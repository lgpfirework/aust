<?php
function get_td_array($table) {   
        $table = preg_replace("'<table[^>]*?>'si","",$table);  
        $table = preg_replace("'<tr[^>]*?>'si","",$table);   
        $table = preg_replace("'<td[^>]*?>'si","",$table);   
        $table = str_replace("</tr>","{tr}",$table);   
        $table = str_replace("</td>","{td}",$table);   
        //去掉 HTML 标记    
        $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);  
        //去掉空白字符     
        $table = preg_replace("'([rn])[s]+'","",$table);
        $table = preg_replace('/&nbsp;/',"",$table);   
        $table = str_replace(" ","",$table);   
        $table = str_replace(" ","",$table);   
           
        $table = explode('{tr}', $table);   
        array_pop($table);   
        foreach ($table as $key=>$tr) {   
                $td = explode('{td}', $tr);   
                array_pop($td);   
            $td_array[] = $td;    
        }   
        return $td_array;   
}
class SimulatedLogin {
	private $username;//学号
	private $password;//密码
	private $name;//姓名
	private $operate;//操作
	public $message = '';//返回信息
	public $url = 'http://219.244.50.245:8989/';//教务系统

	public function __construct($username, $password, $operate) {
		$this->username = $username;
		$this->password = $password;
		$this->operate = $operate;
		//首先进行登陆, 方便后面获取数据
		$this->Simulated($this->url.'default_ysdx.aspx', TRUE,  '__VIEWSTATE=dDw1MjQ2ODMxNzY7Oz5ZwJvJUE7fvnYgRo1rWXsAsKwdhQ%3D%3D&TextBox1='.$this->username.'&TextBox2='.$this->password.'&RadioButtonList1=%D1%A7%C9%FA&Button1=');
		$this->getName();
	}

	public function returnJson() {
		switch ($this->operate) {
			case 'xinxi'://个人信息查询
				$this->prifile();
				break;
			case 'dengji'://等级考试查询
				$this->getDjks();
				break;
			case 'chengji'://成绩查询
				$this->getchengji();
				break;
			case 'kebiao'://课表查询
				$this->getKb();
				break;
			case 'bukao'://补考查询
				$this->getbukao();
				break;
		}
		return $this->message;
	}

	/**
	 * 获取个人信息
	 */
	private function prifile() {
		$result = $this->Simulated($this->url.'xsgrxx.aspx?xh='.$this->username.'&xm='.$this->name.'&gnmkdm=N121501');
		preg_match_all('/<img id="xszp" src="(.*)" alt="照片" align="AbsMiddle" border="0" height="144" width="112" \/>/', $result, $dataHeader);//1,0
		preg_match_all('/<span id="(.*)">(.*)<\/span>/', $result, $dataValue);//2
		$dataValue1= array('id'=>strip_tags($dataValue[0][1]),'name'=>strip_tags($dataValue[0][8]),'cid'=>strip_tags($dataValue[0][46]),'xi'=>strip_tags($dataValue[0][54]),'zhuan'=>strip_tags($dataValue[0][64]));
		$this->message = $dataValue1;
	}
	
	private function getKb() {//课表
		$result = $this->Simulated($this->url.'xskbcx.aspx?xh='.$this->username.'&xm='.$this->name.'&gnmkdm=N121603');
		preg_match_all('/<table id="Table1" [^>]*>([\s\S]*?)<\/table>/',$result,$rs);
   $arr = get_td_array($rs[0][0]);
   for ($d=1;$d<=7;$d++){
$shuzu[$d][1]=$arr[1][$d];
$shuzu[$d][2]=$arr[2][$d+1];
$shuzu[$d][3]=$arr[3][$d];
$shuzu[$d][4]=$arr[4][$d];
$shuzu[$d][5]=$arr[5][$d];
$shuzu[$d][6]=$arr[6][$d];
$shuzu[$d][7]=$arr[7][$d];
$shuzu[$d][8]=$arr[8][$d];
$shuzu[$d][9]=$arr[9][$d];
$shuzu[$d][10]=$arr[10][$d];
$shuzu[$d][11]=$arr[11][$d];
$shuzu[$d][12]=$arr[12][$d];
$shuzu[$d][13]=$arr[13][$d];
} 
    $this->message =$shuzu;
	}
	
	/**
	 * 成绩成绩
	 */
	private function getchengji() {
$result = $this->Simulated($this->url.'xscjcx.aspx?xh='.$this->username.'&xm='.$this->name.'&gnmkdm=N121605');
preg_match_all('/<table class="datelist" [^>]*>([\s\S]*?)<\/table>/',$result,$rs);
   $arr = get_td_array($rs[0][0]);
      if(count($arr) ==1){
 	$shuzu = '暂时没有查到成绩.';
 }
   else{
      for ($d=1;$d<count($arr);$d++){
   $shuzu[$d][0]='课程代码:'.trim($arr[$d][0]);
   $shuzu[$d][1]='课程名称:'.$arr[$d][1];
   $shuzu[$d][2]='课程性质:'.$arr[$d][2];
   $shuzu[$d][3]='学分:'.$arr[$d][3];
   $shuzu[$d][4]='最高成绩:'.$arr[$d][4];
   $shuzu[$d][5]='课程归属:'.$arr[$d][5];
   }
   }
$this->message = $shuzu;
	}
/**
* 补考查询
* 
* @return
*/
	private function getbukao() {
$result = $this->Simulated($this->url.'xsbkkscx.aspx?xh='.$this->username.'&xm='.$this->name.'&gnmkdm=N121617');
preg_match_all('/<table class="datelist" [^>]*>([\s\S]*?)<\/table>/',$result,$rs);
   $arr = get_td_array($rs[0][0]);
   if(count($arr) ==1){
 	$shuzu = '你没有要补考的课程.';
 }
   else{
      for ($d=1;$d<count($arr);$d++){
   $shuzu[$d][0]='选课课号:'.trim($arr[$d][0]);
   $shuzu[$d][1]='课程名称:'.$arr[$d][1];
   $shuzu[$d][2]='姓名:'.$arr[$d][2];
   $shuzu[$d][3]='考试时间:'.$arr[$d][3];
   $shuzu[$d][4]='考试地点:'.$arr[$d][4];
   $shuzu[$d][5]='座位号:'.$arr[$d][5];
      $shuzu[$d][6]='考试形式:'.$arr[$d][6];
   }
   }
$this->message = $shuzu;
	}	
	/**
	 * 等级考试查询
	 */
	private function getDjks() {
		$result = $this->Simulated($this->url.'xsdjkscx.aspx?xh='.$this->username.'&xm='.$this->name.'&gnmkdm=N121606');
preg_match_all('/<table [^>]*>([\s\S]*?)<\/table>/',$result,$rs);
   $arr = get_td_array($rs[0][0]);
      if(count($arr) ==1){
 	$shuzu = '你没有参加等级考试吧.';
 }
   else{
   for ($d=1;$d<count($arr);$d++){
   $shuzu[$d][0]='学年:'.trim($arr[$d][0]);
   $shuzu[$d][1]='学期:'.$arr[$d][1];
   $shuzu[$d][2]='等级考试名称:'.$arr[$d][2];
   $shuzu[$d][3]='准考证号:'.$arr[$d][3];
   $shuzu[$d][4]='考试日期:'.$arr[$d][4];
   $shuzu[$d][5]='成绩:'.$arr[$d][5];
   $shuzu[$d][6]='听力成绩:'.$arr[$d][6];
   $shuzu[$d][7]='阅读成绩:'.$arr[$d][7];
   $shuzu[$d][8]='写作成绩:'.$arr[$d][8];
   $shuzu[$d][9]='综合成绩:'.$arr[$d][9];
   }}
		$this->message = $shuzu;
	}

	/**
	 * 获得姓名
	 */
	private function getName() {
		$result = file_get_contents($this->url.'xs_main.aspx?xh='.$this->username);
		preg_match('/&xm=(.*)&/U', $result, $name);
		$this->name = $name[1];
	}

	/**
	 * curl信息
	 */
	private function Simulated($url, $post=FALSE, $postFields=null, $returnTransfer=TRUE) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, $returnTransfer);
		curl_setopt($ch, CURLOPT_REFERER, $this->url.'xs_main.aspx?xh='.$this->username);
		if ($post) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		}
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
		$result = curl_exec($ch);
		curl_close($ch);
		return iconv('GB2312', 'UTF-8', $result);
	}
}

if(!empty($_GET['user']) && !empty($_GET['pwd']) && !empty($_GET['op'])) {
	$json = new SimulatedLogin($_GET['user'], $_GET['pwd'], $_GET['op']);
	echo json_encode($json->returnJson());
}