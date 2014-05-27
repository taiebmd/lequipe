<?php
class OpsWorksDb {
  public $adapter, $database, $encoding, $host, $username, $password, $reconnect;

  public function __construct() {
	$this->adapter = '';
    $this->database = 'sfeir';
    $this->encoding = 'utf8';
    $this->host = '192.168.1.105';
    $this->username = 'sfeir';
    $this->password = 'sfeir123m';
    $this->reconnect = 'false';
  }
}

class OpsWorksMemcached {
  public $host, $port;

  public function __construct() {
    $this->host = '';
    $this->port = '11211';
  }
}

class OpsWorks {
  public $db;
  public $memcached;
  private $stack_map;

  public function __construct() {
    $this->db = new OpsWorksDb();
    $this->memcached = new OpsWorksMemcached();
    $this->stack_map = array('db-master' => array('ddb.greenshift.eu'), 'php-app' => array('87.255.51.25'), 'lb' => array('87.255.51.25'));
    $this->stack_name = 'EquipePetition';
  }

  public function layers() {
    return array_keys($this->stack_map);
  }

  public function hosts($layer) {
    return $this->stack_map[$layer];
  }
}
?>
