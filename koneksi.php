<?php 
class DB
{
	private $hostname = 'localhost'; 
	private $username = 'root';
	private $password = '';
	private $dbName = 'aplikasi_presentasi';

	public $dbh = NULL;

	public function __construct()
	{
		try
		{
			$this->dbh = new PDO("mysql:host=$this->hostname;dbname=$this->dbName", $this->username, $this->password);
		}
		catch(PDOException $e)
		{
			echo __LINE__.$e->getMessage();
		}
	}

	public function __destruct()
	{
		$this->dbh = NULL;
	}

	public function runquery($sql)
	{
		//echo $sql;
		try
		{
			$this->dbh->exec($sql) ;
			return true;
		}
		catch(PDOException $e)
		{
			echo __LINE__.$e->getMessage();
			return false;
		}
	}

	public function getquery($sql)
	{
		try {
			$stmt = $this->dbh->query($sql);
	    	$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt;
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}

	public function nextid($table,$tableid){
		try {
			$stmt = $this->dbh->query("SELECT ".$tableid." FROM ".$table." ORDER BY ".$tableid." DESC LIMIT 1");
	    	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	    	$hasil=0;
	    	foreach($stmt as $data){
	    		$hasil=$data[$tableid]+1;
	    	}
	    	if($hasil==0){
	    		$hasil=1;
	    	}
	    	return $hasil;
		} catch (PDOException $e) {
			echo __LINE__.$e->getMessage();
		}
	}
}
$db=new DB();
?>