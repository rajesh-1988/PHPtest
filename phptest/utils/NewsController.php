<?php 

class NewsController
{
	protected $db;
	
	
	 function __construct()
		{
			require_once(ROOT . '/utils/Dbconfig.php');
		    $this->db=	DBconnection();
		}	
		
		public function listNews()
	  {
	        
			$stmt = $this->db->prepare('SELECT * FROM `news`');
			        $stmt->execute();
			 $res = $stmt->fetchAll();
			
			foreach($res as $row) {
			
			$news[] = array('setId'=>$row['id'],'setTitle'=>$row['title'],'setBody'=>$row['body'],'setCreatedAt'=>$row['created_at']);
						  
		   }
		   
		   return $news;
	 	}
				/*** add a record in news table 	*/
	
		public function addNews($title, $body)
		{

		try
		{
		$stmt = $this->db->prepare("INSERT INTO tbl_users(`title`, `body`, `created_at`) VALUES(:title, :body, :creatdate)");
		$stmt->bindparam(":title",$title);
		$stmt->bindparam(":body",$body);
		$stmt->bindparam(":creatdate",date('Y-m-d'));

		$stmt->execute();
		$id = $this->$db->lastInsertId();
		return $id;
		}
		catch(PDOException $e)
		{
		echo $e->getMessage(); 
		return false;
		}
		}
			
	
			/*** Delete a record in news table and comment table	*/
	
	 public function deleteNews($id)
   {
	 
	try
		{
	    $stmt1 = $this->db->prepare("DELETE FROM comment WHERE news_id=:id");
	    $stmt1->bindparam(":id",$id);
	    $stmt1->execute(); 
  
		$stmt = $this->db->prepare("DELETE FROM news WHERE id=:id");
		$stmt->bindparam(":id",$id);
	    return $stmt->execute();

		}
		catch(PDOException $e)
		{
		echo $e->getMessage(); 
		return false;
		}
  
   }
 

}


?>