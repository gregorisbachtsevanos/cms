<?php
if(!defined('estatedrive'))
	die('Direct access not permitted');
$dbhost = 'localhost'; //Usually localhost
// #######
$dbuser = 'root';      //MySQL User
$dbpass = '';          //User's Password
$appURL = 'http://localhost/globalcms/httpdocs/';   //baseDomain configuration
// #######
// $dbuser = 'global';      //MySQL User
// $dbpass = 'NCglo#@!GLO!@#1';          //User's Password
// $appURL = 'https://nostalgic-mcnulty.135-181-182-183.plesk.page/';   //baseDomain configuration
// #######
$dbname = 'global_crm';   //Name of the database
$appDir = '/';   //baseDomain configuration
$appName = 'Philoxenia';   //appName configuration
$appControllers = '../app/controllers/';   //app controllers folder
$appViews = 'app/views/';   //app views folder
$appLibraries = '../includes/libraries/';   //libraries folder
$appHelpers = '../includes/libraries/helpers/';   //libraries folder
$appRequests = '../app/requests/';   //libraries folder
$appEmail = 'info@laikiapp.gr';   //appEmail configuration
$appUploads = '../public/uploads/';   //appEmail configuration
$smsAppKey = 'a5e92b0ca1ef2b';
$smsProvider = 'https://easysms.gr/api/sms';
$defaultLang = 'el';
$companyLogo = 'global-concept-logo-small.png';
$companyLogoWidth = '120px'	;
date_default_timezone_set('Europe/Athens');
session_start();

class DB extends SQL{
public $pdo,$i='`';
static $q=array();
function __construct($c){extract($c);$this->pdo=new PDO($dsn,$user,$pass,$args);}
function column($q,$p=NULL,$k=0){return($s=$this->query($q,$p))?$s->fetchColumn($k):0;}
function row($q,$p=NULL){return($s=$this->query($q,$p))?$s->fetch(PDO::FETCH_OBJ):0;}
function fetch($q,$p=NULL){return($s=$this->query($q,$p))?$s->fetchAll(PDO::FETCH_OBJ):0;}
function query($q,$p=NULL){$s=$this->pdo->prepare(self::$q[]=str_replace('"',$this->i,$q));$s->execute($p);return$s;}
}
class SQL {
function delete($t,$w=0){$q="DELETE FROM $t";list($w,$p)=$this->where($w);if($w)$q.=" WHERE $w";return($s=$this->query($q,$p))?$s->rowCount():0;}
function select($c=0,$t,$w=0,$l=0,$o=0,$s=0){$c=$c?:'*';$q="SELECT $c FROM \"$t\"";list($w,$p)=$this->where($w);if($w)$q.=" WHERE $w";return array($q.($s?" ORDER BY $s":'').($l?" LIMIT $o,$l":''),$p);}
function count($t,$w=0){list($q,$p)=$this->select('COUNT(*)',$t,$w);return$this->column($q,$p);}
function insert($t,$d){$q="INSERT INTO $t (\"".implode('","',array_keys($d)).'")VALUES('.rtrim(str_repeat('?,',count($d)),',').')';return $this->query($q,array_values($d))?$this->pdo->lastInsertId():0;}
function update($t,$d,$w=NULL){$q="UPDATE $t SET \"".implode('"=?,"',array_keys($d)).'"=? WHERE ';list($a,$b)=$this->where($w);return(($s=$this->query($q.$a,array_merge(array_values($d),$b)))?$s->rowCount():NULL);}
function where($w=0){$a=$s=array();if($w){foreach($w as$c=>$v){if(is_int($c))$s[]=$v;else{$s[]="\"$c\"=?";$a[]=$v;}}}return array(join(' AND ',$s),$a);}
}
$config = array(
        'dsn' => 'mysql:host='.$dbhost.';dbname='.$dbname.'',
        'user' => $dbuser,
        'pass' => $dbpass,
        'args' => array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" // If using MySQL, force UTF-8
        )
);
$db = new DB($config);
function db($config = array()){
	static $db = NULL;
	if($db === NULL)
		$db = new DB($config);
	return $db;
}
db($config);
?>