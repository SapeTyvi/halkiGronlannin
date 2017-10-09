<?php	
	class ExpeditionController {
		public function expedition() {
		$expeditors = Expeditor::allExpeditors();
		require_once('views/expedition/expedition.php');
		}
		
		public function showExpeditors() {
			if(!isset($_GET['pId']))
				return call('pages', 'error');
			
		$expeditor = Expeditor::findExpeditor($_GET['pId']);
		require_once('views/expedition/showExpeditor.php');
		}
	}
?>