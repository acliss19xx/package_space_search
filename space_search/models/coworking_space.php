<?php
class CoworkingSpace extends Object {
	
	public function delete() {
		$db = Loader::db();
		$db->Execute('delete from CoworkingSpace where csID = ?', array($this->csID));
	}
	
	public function save($data) {
		$db = Loader::db();
		$vals = array(
			$data['spaceName'],
			$data['prefecture'],
			$data['ward'],
			$data['address'],
			$data['url'],
			$data['email'],
			$data['tel'],
			$data['coop'],
			$data['visa'],
			$this->csID
		);
		$db->query("update CoworkingSpace set spaceName = ?, prefecture = ?, ward = ?, address = ?, url = ?, email = ?, tel = ?, coop = ?, visa = ? where csID = ?", $vals);
	}
	
	public function add($data) {
		$db = Loader::db();
		$vals = array(
			$data['spaceName'],
			$data['prefecture'],
			$data['ward'],
			$data['address'],
			$data['url'],
			$data['email'],
			$data['tel'],
			$data['coop'],
			$data['visa']
		);
		$db->query("insert into CoworkingSpace (spaceName, prefecture, ward, address, url, email, tel, coop, visa) values (?,?,?,?,?,?,?,?,?)", $vals);
		$csID = $db->Insert_ID();
		return $csID;
	}
	
	public static function getByID($csID) {
		$db = Loader::db();
		$r = $db->GetRow('select * from CoworkingSpace where csID = ?', array($csID));
		if ($r['spaceName']) {
			$cs = new CoworkingSpace();
			$cs->setPropertiesFromArray($r);
			return (is_a($cs, "CoworkingSpace")) ? $cs : false;
		}
	}
	
}