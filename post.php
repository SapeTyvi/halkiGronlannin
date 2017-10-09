<?php 
	class Post {
		public $blogId;
		public $subject;
		public $content;
		
		public function __construct($blogId, $subject, $content){
			$this->blogId		= $blogId;
			$this->subject		= $subject;
			$this->content		= $content;
		}
		
		public static function all(){
			$list	= [];
			$db		= testDB::getInstance();
			$req 	= $db->query('SELECT * FROM blogposts');
			
			foreach($req->fetchAll() as $post){
				$list[] = new Post($post['blogId'], $post['subject'], $post['content']);
			}
			return $list;
		}
		public static function find($blogId){
			$db = testDB::getInstance();
			$blogId = intval($blogId);
			$req = $db->prepare('SELECT * FROM blogposts WHERE blogId = :blogId');
			$req->execute(array('blogId' => $blogId));
			$post = $req->fetch();
			
			return new Post($post['blogId'], $post['subject'], $post['content']);
		}
	}
?>