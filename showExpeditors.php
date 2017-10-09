<?php
	class Expeditor {
		public $pId;
		public $firstName;
		public $lastName;
		public $occupation;
		public $introduction;
		public $picture;
		
		public function __construct($pId, $firstName, $lastName, $occupation, $introduction, $picture){
			$this->pId			= $pId;
			$this->firstName	= $firstName;
			$this->lastName		= $lastName;
			$this->occupation	= $occupation;
			$this->introduction	= $introduction;
			$this->picture		= $picture;
		}
		
		public static function allExpeditors() {
			$list		= [];
			$db			= testDB::getInstance();
			$result		= $db->query('SELECT * FROM expedition');
			
			foreach($result->fetchAll() as $expeditor) {
				$list[] = new Expeditor($expeditor['pId'], $expeditor['firstName'], $expeditor['lastName'],
					$expeditor['occupation'], $expeditor['introduction'], $expeditor['picture']);
			}
			return $list;
		}
		public static function findExpeditor($pId){
			$db			= testDB::getInstance();
			$pId		= intval($pId);
			$result		= $db->prepare('SELECT * FROM expedition WHERE pId = :pId');
			$result->execute(array('pId' => $pId));
			$expeditor	= $result->fetch();
			
			return new Expeditor($expeditor['pId'], $expeditor['firstName'], $expeditor['lastName'],
					$expeditor['occupation'], $expeditor['introduction'], $expeditor['picture']);
		}
	}
?>