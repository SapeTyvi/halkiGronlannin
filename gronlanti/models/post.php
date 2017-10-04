<?php 
	class Post {
		public $id;
		public $subject;
		public $content;
		
		public function __construct($id, $subject, $content){
			$this->id		= $id;
			$this->subject	= $subject;
			$this->content	= $content;
		}
		
		public static function all(){
			$list	= [];
			$db		= testDb::getInstance();
			$req 	= $db->query('SELECT * FROM blogposts');
			
			foreach($req->fetchAll() as $post){
				$list[] = new Post($post['id'], $post['subject'], $post['content']);
			}
			return $list;
		}
		public static function find($id){
			$db = testDb::getInstance();
			$id = intval($id);
			$req = $db->prepare('SELECT * FROM blogposts WHERE id = :id');
			$req->execute(array('id' => $id));
			$post = $req->fetch();
			
			return new Post($post['id'], $post['subject'], $post['content']);
		}
	}
?>