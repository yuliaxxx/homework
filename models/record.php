<?

define('DB_USER', 'thisisyu24'); /*название бд*/
define('DB_PASS', 'H0ywioJs'); /*пароль от бд*/

class Record {	
  public $id;
  public $theme; 
  public $place;
  public $case;
  public $date;
  public $time;
  public $type;
  public $comm; 
  public $dbh;
  
  /*список атрибутов*/
  protected static $properties = 
  [
    'theme',
    'place',
    'case',
    'date',
    'time',
    'type',
    'comm',
  ];
	
  public static $cases = 
  [
    1 => '30 минут', 
    2 => '1 час', 
    3 => '2 часа',
    4 => '3 часа',
    5 => '4 часа',
  ];
	
  public static $types = 
  [
  	1 => 'Встреча',
    2 => 'Звонок',
    3 => 'Совещание',
  	4 => 'Дело',
  ];

  public function __construct($data = null)
  {
    if (isset($data) && is_array($data))
    {
    	$this->theme = isset($data['theme']) ? $data['theme'] : "" ;
      $this->place = isset($data['place']) ? $data['place'] : "" ;
      $this->case = isset($data['case']) ? $data['case'] : "" ;
      $this->date = isset($data['date']) ? $data['date'] : "" ;
      $this->time = isset($data['time']) ? $data['time'] : "" ;
      $this->type =  isset($data['type']) ? $data['type'] : "" ;
      $this->comm = isset($data['comm']) ? $data['comm'] : "" ;
  	}

  }
	/*функция подключения к бд*/
  protected static function get_pdo()
   {
    	$dbh = new PDO('mysql:host=127.0.0.1;dbname=thisisyu24;charset=utf8',DB_USER, DB_PASS);
    	return $dbh;
   }     
    
  public function get_data()
  {
  	return $data = 
      [
    	'theme' => $this->theme,
      'place'=> $this->place,
      'case' => $this->case,
      'date' => $this->date,
      'time' => $this->time,
      'type' => $this->type,
      'comm' =>$this->comm,      
      ];
  }
  /*функция сохранения в бд*/
  public function save()
  {
      $sql = static::get_pdo()->prepare('INSERT INTO `calendar` (`'.implode('`, `', static::$properties).'`) VALUES (:'.implode(', :', static::$properties).');');
      $info = [];
      $data = $this->get_data();
      foreach (static::$properties as $property)
      {
       	$info[$property] = $data[$property];
      }
      $sql->execute($info);
			return $sql->rowCount() === 1;
    }
  /*Возвращает текстовое представление выбранного типа*/
  public function get_types()
  {
   return Record::$types[$this->type];    
  }
  /*Возвращает текстовое представление выбранной длительнности*/
  public function get_cases()
  {
    return Record::$cases[$this->case];
  }   
  /*Получение всех задач*/
  public static function get_all()
  {
    $sql = static::get_pdo()->prepare('SELECT * FROM `calendar`;');
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }    

  public static function import_file()
  {
    return Record::get_all();
  }    
  /*Получение задач на сегодня*/
  public static function today() {
    $a = 1;
    $sql = static::get_pdo()->prepare('SELECT * FROM `calendar` WHERE `date` = CURDATE();');
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }
  /*Получение задач на завтра*/
  public static function tomm() {
    
    $sql = static::get_pdo()->prepare('SELECT * FROM `calendar` WHERE `date` = CURDATE() + INTERVAL 1 DAY;');
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }
  /*Получение задач на эту неделю*/
   public static function thisweek() {
    
    $sql = static::get_pdo()->prepare('SELECT * FROM `calendar` WHERE (YEAR(`date`) = YEAR(NOW())) and (WEEK(`date`, 1) = WEEK(NOW(), 1)) and DAY(CURDATE()) <= day(`date`);');
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }
  /*Получение задач на след неделю*/
  public static function nextweek() {
    
    $sql = static::get_pdo()->prepare('SELECT * FROM `calendar` WHERE YEAR(`date`) = YEAR(NOW()) and WEEK(`date`,1) = WEEK(NOW()+ INTERVAL 7 DAY,1);');
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }
 
  public static function done() {
    $records = Record::get_all();
		foreach ($records as $record) 
    { 
    	if($_POST[$record->id])
    	{
        $sql = static::get_pdo()->prepare('UPDATE `calendar` SET `done`=1 WHERE `id` = :id LIMIT 1;');
     		
        $data = ['id' => $record->id];
				$sql->execute($data);
      }
    }
   }
  /*Получение выполненных задач*/
  public static function donecase() {
    
    $sql = static::get_pdo()->prepare('SELECT * FROM `calendar` WHERE `done` = 1;');
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }
  /*получение текущих задач*/
  public static function nowcase() {
  	$sql = static::get_pdo()->prepare('SELECT * FROM `calendar` WHERE `date` = CURDATE() and `done`=0;');
    
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }
  
  /*Получение просроченных задач*/
  public static function pastcase() {
  	$sql = static::get_pdo()->prepare('SELECT * FROM `calendar` WHERE `date` < NOW();');
    
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }
  /*Получение задач на определенную дату*/
   public static function certaindate($dat) {
  	$sql = static::get_pdo()->prepare('SELECT * FROM `calendar` WHERE `date` ="'.$dat.'" LIMIT 1;');
    $sql->execute();

    $datas = [];

    while ($data = $sql->fetchObject(static::class))
     {
       $datas[] = $data;
     }

     return $datas;
    }
  
  /*удаления задачи*/
  public static function delete() 
  {
  	$records = Record::get_all();
		foreach ($records as $record) 
    { 
    	if($_POST[$record->id])
    	{
     		$sql = static::get_pdo()->prepare('DELETE FROM `calendar` WHERE id = :id LIMIT 1;');
        $data = ['id' => $record->id];
				$sql->execute($data);
      }
    }
   }
 }
  
   