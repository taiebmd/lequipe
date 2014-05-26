<?php
class OpsWorksDb {
  public $adapter, $database, $encoding, $host, $username, $password, $reconnect;

  public function __construct() {
    $this->adapter = '';
    $this->database = 'sfeir';
    $this->encoding = 'utf8';
    $this->host = '192.168.1.104';
    $this->username = 'sfeir';
    $this->password = 'sfeir123m';
    $this->reconnect = 'false';
  }
}
?>
