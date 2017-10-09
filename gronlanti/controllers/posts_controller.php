<?php
	class PostsController {
		public function index() {
			$posts = Post::all();
			require_once('views/posts/index.php');
		}
		
		public function showPosts() {
			if(!isset($_GET['blogId']))
				return call('pages', 'error');
			
			$post = Post::find($_GET['blogId']);
			require_once('views/posts/show.php');
		}
	}
?>