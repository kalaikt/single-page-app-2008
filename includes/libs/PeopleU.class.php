<?php 
class PeopleU{
	public $total=0;
	public function __construct() {
	}
	private function setPageLimit($n = 5) {
		$this->num_per_page = $n;
		$page = ($_POST['p']) ? $_POST['p'] : 1;
		$start = ($page == 1) ? 0 : ($page-1) * $this->num_per_page;
		$this->limit = 'LIMIT '.$start.', '.$this->num_per_page;
	}
	public function setDB() {
		$db = NewADOConnection('mysql');
		$db->Connect(DB_HOST,DB_USER_NAME,DB_PASSWORD,DB);
		$db->SetFetchMode(ADODB_FETCH_ASSOC);
		$this->db = $db;
	}
 	public function runQuery($type='execute',$sql='',$time=0) {
		if(!$this->db) {
			$this->setDB();
			# In order to pull foreign characters from the database and display
			# at this time, these 2 queries must be run
			$this->runQuery('execute','SET NAMES utf8');
			$this->runQuery('execute','SET CHARACTER_SET utf8');
		}
		switch($type) {
			case 'execute': 
				$qstart 	= $this->getStartTime(); 
				$results	= $this->db->Execute($sql);
				$qend		= $this->getEndTime($qstart);
					break;
			case 'count': 
				$qstart 	= $this->getStartTime(); 
				$results	= $this->db->Execute($sql);
				$results	= $results->RecordCount();
				$qend		= $this->getEndTime($qstart);
					break;
	
			case 'getAll': 
				$qstart 	= $this->getStartTime(); 
				$results	= $this->db->getAll($sql);
				$qend		= $this->getEndTime($qstart);
					break;

			case 'getAssoc': 
				$qstart 	= $this->getStartTime(); 
				$results	= $this->db->GetAssoc($sql);
				$qend		= $this->getEndTime($qstart);
					break;

			case 'cache': 
				$qstart 	= $this->getStartTime(); 
				//$results 	= $db->CacheExecute($time,$sql);
				$results	= $this->db->Execute($sql);
				$qend		= $this->getEndTime($qstart);
					break;
		}
		$this->q++;
		$this->queries['all']['queries'] += 1;
		$this->queries['all']['time'] += number_format($qend,6,'.','');
		$this->queries[$this->q]['query'] = $sql;
		$this->queries[$this->q]['time'] 	= number_format($qend,6,'.','');
		return $results;
	}

# Function Start Time to Determine Page Load Time
	public function getStartTime() {
		$gentime = explode(' ',microtime());
		$gentime = $gentime[1] + $gentime[0];
		return $gentime;
	}

# Function End Time to Determine Page Load Time
	public function getEndTime($pg_start) {
		$gentime = explode(' ',microtime());
		$gentime = $gentime[1] + $gentime[0];
		$pg_end = $gentime;
		return $pg_end - $pg_start;
	}	
	
# Set the Page Start Time for Calulating the Page Generation Time
	public function setStartTime() {
		$this->pg_start = $this->getStartTime();
	}

# Function Get Queries Returns All Run Queries and Time for the Page
	public function getQueries() {
		$display = '<br /><font color="#000000" size="2"><div align="center">This page was generated in <font color="#ff0000">'.number_format($this->getEndTime($this->pg_start),6,'.','').'</font> seconds<br />'.php_uname('n').'</div>';

		if($this->queries) {
			foreach($this->queries as $query => $data) {
				$data['query'] = ($query == 'all') ? $data['queries'] . ' total queries run on '.$this->slave : $data['query'];
				$display .= '<strong><font color="#000000">'.$data['query'].'</font></strong> <br /><font color="#cccccc">&rarr;</font> <font color="#ff0000">'.$data['time'].' seconds</font><hr color="#cccccc" />';
			}
			$display =  '<br /><div style="height: 100px; overflow:auto;z-index:1001>'.$display .'</div>';
		}
		echo $display;
	}

	public function getWebRoot() {
		return WEB_ROOT;
	}

	public function getSiteRoot() {
		return SITE_ROOT;
	}

	public function getTemplateRoot() {
		return TEMPLATE_ROOT;
	}
	public function sendEMail(){
		$to = 'jpyle@peopleu.com';
		$subject = 'Request - '.$_POST['send_to'];
		$headers = "From: \"".$_POST['Name']."\"<".$_POST['email'].">\nReply-To: ".$_POST['email']."\nX-Mailer: PHP/".phpversion();
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$message ="Send to: ".$_POST['send_to'].'<br/>';
		$message .="Name : ".$_POST['name'].'<br/>';
		$message .="Email : ".$_POST['email'].'<br/>';
		$message .="Message : ".$_POST['message'].'<br/>';		
		
		mail($to,$subject,$message,$headers);
		return 'Your message has been sent. Please allow up to 8 business hours for a response. Thank you.';
	}
	public function insert($table,$values){
		if(!is_array($values))
			return FALSE;
		foreach( $values as $key=>$list){
			$fld[]= $key;
			$val[]= strstr($list,'()')?$list : "'".$list."'";
		}
		
		$sql = "INSERT INTO $table (".implode(',',$fld).") VALUES (".implode(',',$val).")";
			
		if(! $this->runQuery('execute',$sql)){
		   return FALSE;
		}
		return TRUE;
	}
	public function update($table,$values,$where = null){
		if(!is_array($values))
			return FALSE;
		foreach( $values as $k=>$v){
       		$str[]= " $k = '".trim($v)."'";
     	}
		
		$sql = "UPDATE $table SET ".implode(',',$str)." WHERE $where";
	
		if(! $this->runQuery('execute',$sql)){
		   return FALSE;
		}
		return TRUE;
	}
	public function checkAdminUser(){
		$sql = " SELECT user_id, username, first_name, last_name FROM admin_users WHERE username = '$_POST[username]' and '".md5($_POST[password])."'";
		$result = $this->runQuery('execute',$sql);
		
		if($result->RecordCount()){
			$_SESSION['admin_user_id'] = $result->Fields("user_id");
			$_SESSION['username'] = $result->Fields("username");
			$_SESSION['first_name'] = $result->Fields("first_name");
			$_SESSION['last_name'] = $result->Fields("last_name");
			header("location:?p=news");
		}
		else{
			header("location:?error=1");
			exit;
		}
	}
	public function setLogout(){
		session_destroy();
		header("location:?c=main");
	}
	public function getMenus($id = 0){
		$this->setPageLimit();
		
		if(isset($_POST['keyword'])){
			$whare = " AND menu_name LIKE '%".$_POST['keyword']."%' ";
		}
		$this->query='SELECT *  FROM menus WHERE menu_parent_id ='.$id.' '.$whare.' ORDER BY menu_name';
		$this->query = str_replace("%","|",$this->query);
				
		$sql = 'SELECT menus.*, total.pages  FROM 
					(SELECT 
						IF((ROUND((COUNT(*)/'.$this->num_per_page.'))*'.$this->num_per_page.') 
							>= 
							COUNT(*),
						ROUND((COUNT(*)/'.$this->num_per_page.')),
						ROUND((COUNT(*)/'.$this->num_per_page.')+1)) AS pages 
					FROM menus WHERE menu_parent_id = '.$id.''.$whare.') as total, menus 
				WHERE menu_parent_id = '.$id.' '.$whare.' ORDER BY menu_name '. $this->limit;
		return $this->runQuery('getAssoc',$sql);
	}
	public function getNews($id='',$status=0){
		$this->setPageLimit(10);
		
		if(isset($_POST['keyword'])){
			$whare = " WHERE (title LIKE '%".$_POST['keyword']."%' OR description LIKE '%".$_POST['keyword']."%') ";
		}
		$this->query='SELECT *  FROM news '.$whare.' ORDER BY news_id DESC';
		$this->query = str_replace("%","|",$this->query);
		$id = $id !=''?" WHERE news_id=$id":'';
		$id = $status !=0?" WHERE status=1":'';
		$sql = 'SELECT news.*, total.pages  FROM 
					(SELECT 
						IF((ROUND((COUNT(*)/'.$this->num_per_page.'))*'.$this->num_per_page.') 
							>= 
							COUNT(*),
						ROUND((COUNT(*)/'.$this->num_per_page.')),
						ROUND((COUNT(*)/'.$this->num_per_page.')+1)) AS pages 
					FROM news '.$id.' '.$whare.') as total, news 
				'.$id.' '.$whare.' ORDER BY news_id DESC '. $this->limit;
		return $this->runQuery('getAssoc',$sql);
	}
	public function menuUpdate(){
		$arr = array('menu_name'=>$_POST['menu_name'],'menu_content'=>str_replace('../','',$_POST['description']),'status'=>$_POST['status']);
		if(!empty($_POST['menu_id']))
			$this->update('menus',$arr,' menu_id = '.$_POST['menu_id']);
		else
			$this->insert('menus',$arr);
	}
	
	public function newsUpdate(){
		$arr = array('user_id'=>$_SESSION['admin_user_id'],'title'=>$_POST['title'],'description'=>$_POST['description'],'image'=>$_POST['image'],'added_date'=>date("Y-m-d H:i:s"),'status'=>1);
		if(!empty($_POST['news_id']))
			$this->update('news',$arr,' news_id = '.$_POST['news_id']);
		else
			$this->insert('news',$arr);
		
		unset($_POST['news_id']);
	}
	
	public function deleteCourses(){
		$sql = "UPDATE courses  SET status = 0 WHERE course_id = ".implode(' OR course_id= ',explode('|',$_POST['course_id']));
		$this->runQuery('execute',$sql);
		
		
		$sql = "SELECT exam_id FROM exams WHERE course_id = ".implode(' OR course_id= ',explode('|',$_POST['course_id']));
		$results = $this->runQuery('getAll',$sql);
		$res = $this->setArray($results);
			
		$sql = "UPDATE exams SET status = 0 WHERE course_id = ".implode(' OR course_id= ',explode('|',$_POST['course_id']));
		$this->runQuery('execute',$sql);
		

		if(is_array($res)){
			$sql = "SELECT question_id FROM exam_questions WHERE exam_id = ".implode(' OR exam_id= ',$res);
			$results1 = $this->runQuery('getAll',$sql);
			$res1 = $this->setArray($results1);
			
			$sql = "UPDATE exam_questions SET status = 0 WHERE exam_id = ".implode(' OR exam_id= ',$res);
			$this->runQuery('execute',$sql);
			
			
			if(is_array($res1)){
				$sql = "UPDATE exam_question_options SET status = 0 WHERE question_id = ".implode(' OR question_id= ',$res1);
				$this->runQuery('execute',$sql);
			}
		}
	}
	public function testUpdate(){
		$arr = array('course_id'=>$_POST['course_id'],'exam_name'=>$_POST['test_name'],'pass_score'=>$_POST['pass_mark'],'status'=>$_POST['status']);
		
		if(!empty($_POST['exam_id']))
			$this->update('exams',$arr,' exam_id = '.$_POST['exam_id']);
		else
			$this->insert('exams',$arr);
	}
	public function questionUpdate(){
		$arr = array('exam_id'=>$_POST['exam_id'], 'question'=>$_POST['question'], 'status'=>$_POST['status']);
		//print_r($arr);
		
		if(!empty($_POST['question_id']))
			$this->update('exam_questions',$arr,' question_id = '.$_POST['question_id']);
		else
			$this->insert('exam_questions',$arr);
	}
	
	public function deleteNews(){
		$sql = "UPDATE news SET status = 0 WHERE news_id = ".implode(' OR news_id= ',explode('|',$_POST['news_id']));
		$this->runQuery('execute',$sql);
		unset($_POST['news_id']);
	}
	
	public function deleteTests(){
					
		$sql = "UPDATE exams SET status = 0 WHERE exam_id = ".implode(' OR exam_id= ',explode('|',$_POST['exam_id']));
		$this->runQuery('execute',$sql);
		
		$sql = "SELECT question_id FROM exam_questions WHERE exam_id = ".implode(' OR exam_id= ',explode('|',$_POST['exam_id']));
		$results = $this->runQuery('getAll',$sql);
		$res = $this->setArray($results);
		
		if(is_array($res)){
			$sql = "UPDATE exam_questions SET status = 0 WHERE exam_id = ".implode(' OR exam_id= ',explode('|',$_POST['exam_id']));
			$this->runQuery('execute',$sql);
						
			$sql = "UPDATE exam_question_options SET status = 0 WHERE question_id = ".implode(' OR question_id= ',$res);
			$this->runQuery('execute',$sql);
		}
	}
	public function deleteQuestions(){
			$sql = "UPDATE exam_questions SET status = 0 WHERE question_id = ".implode(' OR question_id = ',explode('|',$_POST['question_id']));
			$this->runQuery('execute',$sql);
			
			$sql = "UPDATE exam_question_options SET status = 0 WHERE question_id = ".implode(' OR question_id = ',explode('|',$_POST['question_id']));
			$this->runQuery('execute',$sql);
	}
	private function setArray($arr){
		foreach($arr as $value){
			if(is_array($value))
				$temp[] = $this->setArray($value);
			else
				$temp = $value;
		}
		return $temp;
	}
	public function checkLogin(){
		return isset($_SESSION['admin_user_id'])?'':header("location:?p=error");	
	}
	
	public function getQuery(){
		return $this->query;
	}
	
	public function getReport(){
		switch($_GET['report']){
			case csv:
				header("Expires: 0");
				header("Cache-control: private");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Content-Description: File Transfer");
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"".$_GET['name'].''.date('m-d-Y h i s').".csv\"");
				
				$ret = '';
			
				foreach($this->runQuery('getAll',stripslashes(str_replace('|','%',$_GET['sql']))) as $data){
					$ret .= join(',', $data) .PHP_EOL;
				}
				echo $ret;
				break;
			case excel:
				header("Expires: 0");
				header("Cache-control: private");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Content-Description: File Transfer");
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=\"".$_GET['name'].''.date('m-d-Y h i s').".xls\"");
			
				$ret = '';
				foreach($this->runQuery('getAll',stripslashes(str_replace('|','%',$_GET['sql']))) as $data){
					$ret .= join("\t", $data) .PHP_EOL;
				}
				echo $ret;
				break;
			case word:
				header("Expires: 0");
				header("Cache-control: private");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Content-Description: File Transfer");
				header("Content-type: application/vnd.ms-word");
				header("Content-Disposition: attachment; filename=\"".$_GET['name'].''.date('m-d-Y h i s').".doc\"");
				
				$flg=true;
				$ret = '<table>';
				foreach($this->runQuery('getAll',stripslashes(str_replace('|','%',$_GET['sql']))) as $data){
					if($flg){
						$ret .="<tr>";
						foreach($data as $key=>$record){
							$ret .= '<td><b>'. strtoupper($key).'</b></td>';
						}
						$ret .="</tr>";
						$flg=false;
					}
					$ret .="<tr>";
					foreach($data as $key=>$record){
						$ret .= '<td>'. $record.'</td>';
					}
					$ret .="</tr>";
				}
				echo $ret."</table";
				break;
			case pdf:
				header("Expires: 0");
				header("Cache-control: private");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Content-Description: File Transfer");
				header("Content-type: application/pdf");
				header("Content-Disposition: attachment; filename=\"my-data.pdf\"");
				$pdf = pdf_new();
				pdf_open_file($pdf);
				pdf_set_info($pdf, "author", "kalai kumar"); 
				pdf_set_info($pdf, "title", "generate report"); 
				pdf_set_info($pdf, "creator", "kalaikumar"); 
				pdf_set_info($pdf, "subject", "report");
				pdf_begin_page($pdf, 450, 450); 
				$font = pdf_findfont($pdf, "helvetica-bold",  "winansi",0);
				pdf_setfont($pdf, $font, 12); 
							 
				$result = mysql_query(str_replace("|","'",$_REQUEST[query]));
				$ret = '<table>';
				while($data = mysql_fetch_assoc($result)){
					if($flg){
						$ret .="<tr>";
						foreach($data as $key=>$record){
							$ret .= '<td><b>'. strtoupper($key).'</b></td>';
						}
						$ret .="</tr>";
						$flg=false;
					}
					$ret .="<tr>";
					foreach($data as $key=>$record){
						$ret .= '<td>'. $record.'</td>';
					}
					$ret .="</tr>";
				}
				$ret .= $ret."</table";
				pdf_show($pdf, $ret);
				pdf_end_page($pdf); 
				pdf_close($pdf); 
				echo pdf_get_buffer($pdf); 
				//echo $ret."</table";
				break;
		}
	}
}
?>
