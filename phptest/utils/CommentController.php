<?php 

class CommentController
{
	protected $db;
	
	 function __construct()
		{
			require_once(ROOT . '/utils/Dbconfig.php');
		    $this->db=	DBconnection();
		}	
		
		public function listComments()
	  {
	   	$stmt = $this->db->prepare('SELECT * FROM `comment`');
			        $stmt->execute();
			 $res = $stmt->fetchall();
			
			foreach($res as $row) {
			
			$comment[] = array('Id'=>$row['id'],'Body'=>$row['body'],'created'=>$row['created_at'],'newsid'=>$row['news_id']);
						  
		   }
		   
		   return $comment;
	 }
			/*** add a record in comment table
	*/
	
		public function addCommentForNews($body, $newsId)
		{

		try
		{  
		$stmt = $this->db->prepare("INSERT INTO tbl_users(`body`, `created_at`,`news_id`) VALUES(:body, :creatdate, :newsid)");
		$stmt->bindparam(":newsid",$newsId);
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
	/**
	* Delete a record in comment table
	*/
	
	 public function deleteComment($id)
   {
	 try
		{ 
	    $stmt1 = $this->db->prepare("DELETE FROM comment WHERE id=:id");
	    $stmt1->bindparam(":id",$id);
	    $stmt1->execute(); 
		return true;
		}
		catch(PDOException $e)
		{
		echo $e->getMessage(); 
		return false;
		}
   }
}


?>