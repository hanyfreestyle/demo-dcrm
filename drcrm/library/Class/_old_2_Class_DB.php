<?php
if(!defined('WEB_ROOT')) {	exit;}
 

/**
 * DB class allows you to manage most operations you will need to do with mysql dadtabases
 *
 * @package Mysql DB Management Class
 * @author Ahmed Elbshry(bondo2@bondo2.info)
 * @copyright 2008
 * @version 2.0
 * @access public
 */

define('AUTO_INSERT', 1);
define('AUTO_UPDATE', 2);
define('EMPTY_RESULT', -1);
define('PAGING_NEXT_PREV_ONLY',3);
define('PAGING_NEXT_PREV_NUM',4);

class DB {
	/**
	* the database host
	* @var	string
	*/
	private $hostname;
	/**
	* the database name
	* @var	string
	*/
	private $dbname;
	/**
	* the database username
	* @var	string
	*/
	private $dbuser;
	/**
	* the database password
	* @var	string
	*/
	private $dbpass;
	/**
	* the table perfix
	* @var	string
	*/
	private $perfix='';
	/**
	* Whether you want to show the database errors or not
	* @var	boolean
	*/
	private $showerr=true;
	/**
	* the pagination html code
	* @var	string
	*/
	public $pager;
    public $pager_Home;
	/**
	* current link with our database
	* @var	object
	*/
	public $link=false;
	
  /**
   * DB::__construct() - call connect function with specified username and password
   *
   * @param string $hostname - is host that database located in
   * @param string $dbuser - is the username of the database
   * @param string $dbpass - is the password of the database
   * @return
   */
	function __construct($hostname, $dbuser, $dbpass,$dbname) {
		$this->Connect($hostname, $dbuser, $dbpass,$dbname);
	}

  /**
   * DB::Connect() -  connect with specified username and password
   *
   * @param string $hostname - is host that database located in
   * @param string $dbuser - is the username of the database
   * @param string $dbpass - is the password of the database
   * @return object $link - is the connection with the database host
   */
	function Connect($hostname, $dbuser, $dbpass,$dbname) {
		$this->hostname = $hostname;
		$this->dbuser = $dbuser;
		$this->dbpass = $dbpass;
        $this->dbname = $dbname;
		
        $this->link = mysqli_connect($this->hostname, $this->dbuser, $this->dbpass, $this->dbname );
        
    
		if (!$this->link) {
		
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
		 exit();	
		} else {
            mysqli_set_charset($this->link,"utf8");
        	return $this->link;
		}
        
	}
	
  /**
   * DB::UseDB() - select a database to use
   *
   * @param string $dbname - the database name
   * @return boolean
   */
   /*
	function UseDB($dbname) {
		$this->dbname = $dbname;
		if (!$selected = mysql_select_db($this->dbname)) {
			throw new Exception($this->Err());
			exit();
		} else {
			return true;
		}
		
	}
	*/
  /**
   * DB::Close() - closes the current connection with the database
   *
   * @return object
   */
	function Close() {
		return mysqli_close($this->link);
	}
	
  /**
   * DB::Query() - execute mysql query
   *
   * @param string $sql - the text of the query you will execute
   * @return object
   */
	function Query($sql) {
		$result = mysqli_query($this->link,$sql);
		if (!$result) {
			throw new Exception($this->Err($sql));
			exit();
		}
		return $result;
	}
	
  /**
   * DB::Err() - get some information about the databse error
   *
   * @param string $sql - the text of the query you will execute
   * @return string
   */
	function Err($sql='') {
		$err = "
				Mysql Error Occurred<br />
				Error Details:<br />
				File Name: ".__FILE__."<br />
				Line Number: ". __LINE__."<br />
				Err Number: ".mysqli_errno($this->link)."<br />
				Err Desc: ".mysqli_errno($this->link)."<br />";
		if($sql != '') {
			$err .= "Query Says: <textarea cols='60' rows='8'>$sql</textarea>";
		}
		if ($this->showerr) {
			die($err);
		}
	}
	
  /**
   * DB::SelAssoc() - execute select query and get it back in associative array, pagination to move throw the records. or array to use with {html_options} in smarty
   *
   * @param string $sql - the text of the query you will execute
   * @param boolean $comboFill - if you want to use it to fill {html_options} in smarty
   * @param boolean $pager - if you want to activate the pagination function
   * @param integer $perpage - the number records to show per page
   * @param integer $mode - you can choose between the tow conectants PAGING_NEXT_PREV_ONLY or PAGING_NEXT_PREV_NUM
   * @param string $uri - if your page have some get vars assign them here
   * @param integer $pages - if you choose PAGING_NEXT_PREV_NUM in $mode you may need to specify the number of pages to show before and after the current page
   * @return Array
   */
	function SelAssoc($sql, $comboFill=false, $pager=false, $perpage=10, $mode=4, $uri='', $pages=5) {
		if($pager == true) {
			$result = $this->Query($sql);
			$this->pager = $this->Paging($perpage,$this->ResultNumRows($result),$mode,$pages,$uri);
			if(!empty($_GET['page']) && ($this->IntValue( $_GET['page']) > 1)) {
				$current = $this->IntValue($_GET['page'] - 1) * $perpage;
				$sql .= " LIMIT $current , $perpage";	
			} else {
				$sql .= " LIMIT $perpage";
			}
			
		}
		$result = $this->Query($sql);
		if ($result) {
			if ($this->ResultNumRows($result) == EMPTY_RESULT)
				return EMPTY_RESULT;
			while ($row = @mysql_fetch_array($result,MYSQL_ASSOC)) {
				if ($comboFill) {
					reset($row);
	                $key = current($row);
	                unset($row[key($row)]);
	                $rs[$key] = current($row);
	            } else {
	            	$rs[] = $row;
	            }
			}
			return $rs;
		}
	}
	
  /**
   * DB::SelArr() - execute select query and get it back in associative and numric array, pagination to move throw the records.
   *
   * @param string $sql - the text of the query you will execute
   * @param boolean $pager - if you want to activate the pagination function
   * @param integer $perpage - the number records to show per page
   * @param integer $mode - you can choose between the tow conectants PAGING_NEXT_PREV_ONLY or PAGING_NEXT_PREV_NUM
   * @param string $uri - if your page have some get vars assign them here
   * @param integer $pages - if you choose PAGING_NEXT_PREV_NUM in $mode you may need to specify the number of pages to show before and after the current page
   * @return Array
   */
#################################################################################################################################
###################################################    SelArr
#################################################################################################################################  
    function SelArr($sql, $pager=false, $perpage=10, $mode=4, $uri='', $pages=5) {

        if($pager == true) {
            if(isset($_GET['page'])){
                $current = $this->IntValue($_GET['page']);
                $from=($perpage*$current)-$perpage;
            }else{
                $from = "0";
            }

            $result = $this->Query($sql);
            $this->pager = $this->Paging($perpage,$this->ResultNumRows($result),$mode,$pages,$uri);
            $sql .= " LIMIT $from, $perpage";
        }

        $result = $this->Query($sql);
        if ($result) {
            if ($this->ResultNumRows($result) == EMPTY_RESULT)
                return EMPTY_RESULT;
            while ($row = mysqli_fetch_assoc($result)) {
                $rs[] = $row;
            }
            return $rs;
        }
    }

#################################################################################################################################
###################################################    SelArr_Home
#################################################################################################################################  
    function SelArr_Home($sql, $pager=false, $perpage=10, $mode=4, $uri='', $pages=5) {

        if($pager == true) {
            if(isset($_GET['page'])){
                $current = $this->IntValue($_GET['page']);
                $from=($perpage*$current)-$perpage;
            }else{
                $from = "0";
            }

            $result = $this->Query($sql);
            $this->pager = $this->Paging_Home($perpage,$this->ResultNumRows($result),$mode,$pages,$uri);
            $sql .= " LIMIT $from, $perpage";
        }

        $result = $this->Query($sql);
        if ($result) {
            if ($this->ResultNumRows($result) == EMPTY_RESULT)
                return EMPTY_RESULT;
            while ($row = mysqli_fetch_assoc($result)) {
                $rs[] = $row;
            }
            return $rs;
        }
    }


function H_SelArrOnlyRow($sql, $pager=false, $perpage=10, $mode=4, $uri='', $pages=5) {
  if($pager == true) {
  $current = $this->IntValue($_GET['page']);
  $from=($perpage*$current)-$perpage;
  if ($current == ""){
   $from = "0";
  }
  $result = $this->Query($sql);
   $this->pager = $this->Paging($perpage,$this->ResultNumRows($result),$mode,$pages,$uri);
   $sql .= " LIMIT $from, $perpage";
  }
  $result = $this->Query($sql);
  if ($result) {
  if ($this->ResultNumRows($result) == EMPTY_RESULT)
  return EMPTY_RESULT;
   while ($row = mysqli_fetch_assoc($result)) {   
          $rs[] = $row;
         }
   return $rs;
  }
}   

function SelArr_Old($sql, $pager=false, $perpage=10, $mode=4, $uri='', $pages=5) {
  
  if($pager == true) {
  $current = $this->IntValue($_GET['page']);
  $from=($perpage*$current)-$perpage;
  if ($current == ""){
   $from = "0";
  }

  $result = $this->Query($sql);
   $this->pager = $this->Paging($perpage,$this->ResultNumRows($result),$mode,$pages,$uri);
   $sql .= " LIMIT $from, $perpage";
  }
 
  $result = $this->Query($sql);
  if ($result) {
  if ($this->ResultNumRows($result) == EMPTY_RESULT)
  return EMPTY_RESULT;
   while ($row = mysqli_fetch_array($result)) {   
          $rs[] = $row;
         }
   return $rs;
  }
}
	
  /**
   * DB::SelOne() - execute select query and get the first feild from the first record in the result
   *
   * @param string $sql - the text of the query you will execute
   * @return string
   */
	function SelOne($sql) {
		$result = $this->Query($sql);
		if ($result) {
			$rs = $this->FetchRow($result);
			return ($rs == EMPTY_RESULT) ? EMPTY_RESULT : $rs[0];
		}
	}
	
  /**
   * DB::FetchRow() - fetching row from given result
   *
   * @param object $res
   * @return
   */
	function FetchRow($res) {
		$rs = mysqli_fetch_row($res);
		return (is_array($rs)) ? $rs : EMPTY_RESULT;
	}
	
  /**
   * DB::SelRow() - execute select query and get the first row from the result
   *
   * @param string $sql - the text of the query you will execute
   * @return Array
   */
	function SelRow($sql) {
		$res = $this->Query($sql);
		$rs = $this->FetchRow($res);
		return $rs;
	}
	
  /**
   * DB::AutoExecute() - execute INSERT or UPDATE query
   *
   * @param string $table - the table you will INSERT or UPDATE in it
   * @param array $keys_values - array from the feilds and values
   * @param integer $autoEx - you can choose between AUTO_INSERT (to insert new record) and AUTO_UPDATE (to update record)
   * @param string $where - if you choose AUTO_UPDATE you will need to specify where condition
   * @return object
   */
	function AutoExecute($table,$keys_values,$autoEx,$where=false) {
		$first = true;
		switch ($autoEx) {
            case AUTO_INSERT:
                $values = '';
                $names = '';
                foreach ($keys_values as $key=>$value) {
                    if ($first) {
                        $first = false;
                    } else {
                        $names .= ',';
                        $values .= ',';
                    }
                    $names .= $key;
                    $values .= $this->Quote($value);
                }
                $sql = "INSERT INTO $table ($names) VALUES ($values);";
                break;
            case AUTO_UPDATE:
                $set = '';
                foreach ($keys_values as $key=>$value) {
                    if ($first) {
                        $first = false;
                    } else {
                        $set .= ',';
                    }
                    $set .= "$key = ".$this->Quote($value);
                }
                $sql = "UPDATE $table SET $set";
                if ($where) {
                    $sql .= " WHERE $where";
                }
                break;
            default:
                throw new Exception("Check the variable autoEx, '$autoEx' Not a Valid option to AutoExecute function");
                exit();
        }
        $res = $this->Query($sql);
        return $res;
	}
	
  /**
   * DB::Quote() - prepare string to inserted or updated in the database
   *
   * @param string $string
   * @return string
   */
	function Quote($string = null) {
        return ($string === null) ? 'NULL' : "'" . str_replace("'", "''", $string) . "'";
    }
    
  /**
   * DB::ResultNumRows() - get the number of rows in select query
   *
   * @param object $result
   * @return integer
   */
    function ResultNumRows($result) {
		if($result) {
			$num_rows = mysqli_num_rows($result);
			return ($num_rows > 0)? $num_rows : EMPTY_RESULT;
		} else {
			throw new Exception("Not a valid Result to ResultNumRows function, check \$result var");
			exit();
		}
	}
	
  /**
   * DB::IntValue() - make the given value integer
   *
   * @param mixed $value
   * @return integer
   */
	function IntValue($value) {
		if (is_int($value))
			return $value;
		$value = intval($value);
		return $value;
	}
	
  /**
   * DB::GetId() - you may need to get the id of the last inserted record
   *
   * @return integer
   */
	function GetId() {
		$id = mysqli_insert_id($this->link);
		if (is_numeric($id))
			return $this->IntValue($id);
		else
			return false;
	}
	
  /**
   * DB::AddSlashes() - make string save to use
   *
   * @param string $str
   * @return string
   */
	function AddSlashes($str) {
		if (!get_magic_Quotes_gpc()) {
	    	$str = addslashes(strip_tags($str));
		} else {
		    $str = strip_tags($str);
		}
		return $str;
	}
	
  /**
   * DB::Paging() - you cann't call this function outsite but it uesd to generate the pagination html code
   *
   * @param integer $perpage - the number records to show per page
   * @param integer $count - total recordes to show
   * @param integer $mode - you can choose between the tow conectants PAGING_NEXT_PREV_ONLY or PAGING_NEXT_PREV_NUM
   * @param string $uri - if your page have some get vars assign them here
   * @param integer $pages - if you choose PAGING_NEXT_PREV_NUM in $mode you may need to specify the number of pages to show before and after the current page
   * @return string
   */

#################################################################################################################################
###################################################    Paging
#################################################################################################################################
    private function Paging($perpage=10,$count = null,$mode=4,$pages=10,$uri='',$nxtbtn='التالى',$prevbtn='السابق',$lstbtn='الصفحة الاخيرة',$frstbrn='الصفحة الاولى') {
        global $WebSiteLang ;
        $current= "";
        $pager="";
        $link1="";

        if($WebSiteLang == 'En' or ADMIN_WEB_LANG == 'En'){
            $nxtbtn = 'Next';
            $prevbtn = 'First page';
            $lstbtn ='Last Page';
            $frstbrn ='Previous';
        }

        if(!empty($_GET['page'])) {
            $current = $this->IntValue($_GET['page']);
        }
        if(is_array($uri)) {
            $link = $uri[0];
            $link1 = $uri[1];
        }elseif($uri != '') {
            $link = "?".$uri."&page=";
        } else {
            $link = "?page=";
        }
        $totalpages = ceil($count/$perpage);
        if($current > $totalpages) {
            $current = 1;
        }
        $current = intval($current);
        switch ($mode) {
            case PAGING_NEXT_PREV_NUM:
                $pager .= '<div id="paging">';
                if(($current == 0) || ($current == 1)) {
                    $current = 1;
                    if(($totalpages - $pages) <= 0){
                        $myloop = $totalpages;
                        $havelast = true;
                    } else {
                        $myloop = $pages;
                    }
                    for($i=1;$i<=$myloop;$i++) {
                        if($i==$current) {
                            $pager .= '<div class="pager-current">'.$i.'</div>';
                        } else {
                            $pager .= '<div class="pager-link"><a href="'.$link.$i.$link1.'" class="nav_links">'.$i.'</a></div>';
                        }
                    }
                    if($totalpages > 1) {
                        $pager .= '<div class="pager-np"><a href="'.$link.($current+1).$link1.'" class="nav_links">'.$nxtbtn.'</a></div>';
                    }
                    if($totalpages > $pages) {
                        $pager .= '<div class="pager-fl"><a href="'.$link.$totalpages.$link1.'" class="nav_links">'.$lstbtn.'</a></div>';
                    }
                } else {
                    if(($current - ($pages +1) > 0)) {
                        $pager .= '<div class="pager-fl"><a href="'.$link.'1'.$link1.'" class="nav_links">'.$frstbrn.'</a></div>';
                    }
                    $pager .= '<div class="pager-np"><a href="'.$link.($current-1).$link1.'" class="nav_links">'.$prevbtn.'</a></div>';
                    if(($current - $pages) > 0) {
                        for($i=($current - $pages);$i<=$current;$i++) {
                            if($i==$current) {
                                $pager .= '<div class="pager-current">'.$i.'</div>';
                            } else {
                                $pager .= '<div class="pager-link"><a href="'.$link.$i.$link1.'" class="nav_links">'.$i.'</a></div>';
                            }
                        }
                    } else {
                        for($i=1;$i<=$current;$i++) {
                            if($i==$current) {
                                $pager .= '<div class="pager-current">'.$i.'</div>';
                            } else {
                                $pager .= '<div class="pager-link"><a href="'.$link.$i.$link1.'" class="nav_links">'.$i.'</a></div>';
                            }
                        }
                    }
                    if((($totalpages - $current) > 0) && (($totalpages - $current) <= $pages)) {
                        for($i=$current+1;$i<=$totalpages;$i++) {
                            if($i==$current) {
                                $pager .= '<div class="pager-current">'.$i.'</div>';
                            } else {
                                $pager .= '<div class="pager-link"><a href="'.$link.$i.$link1.'" class="nav_links">'.$i.'</a></div>';
                            }
                        }
                    } elseif(($totalpages - $current) > $pages) {
                        for($i=$current+1;$i<=($current+$pages);$i++) {
                            if($i==$current) {
                                $pager .= '<div class="pager-current">'.$i.'</div>';
                            } else {
                                $pager .= '<div class="pager-link"><a href="'.$link.$i.$link1.'" class="nav_links">'.$i.'</a></div>';
                            }
                        }
                    }
                    if($current < $totalpages) {
                        $pager .= '<div class="pager-np"><a href="'.$link.($current+1).$link1.'" class="nav_links">'.$nxtbtn.'</a></div>';
                    }
                    if($totalpages > ($pages+$current)) {
                        $pager .= '<div class="pager-fl"><a href="'.$link.$totalpages.$link1.'" class="nav_links">'.$lstbtn.'</a></div>';
                    }
                }
                break;
            case PAGING_NEXT_PREV_ONLY:
                if($current > 1) {
                    $pager .= '<div class="pager-np"><a href="'.$link.($current-1).$link1.'">'.$prevbtn.'</a></div>';
                } else {
                    $pager .= '<div class="pager-np">'.$prevbtn.'</div>';
                }
                if(($totalpages - $current) > 0) {
                    $pager .='<div class="pager-np"><a href="'.$link.($current+1).$link1.'">'.$nxtbtn.'</a></div>';
                } else {
                    $pager .= '<div class="pager-np">'.$nxtbtn.'</div>';
                }
                break;
        }
        $pager .= '</div>';
        $this->pager = $pager;
        return $pager;
    }




#################################################################################################################################
###################################################    Paging_Home
#################################################################################################################################
 

    private function Paging_Home($perpage=10,$count = null,$mode=4,$pages=10,$uri='',$nxtbtn='التالى',$prevbtn='السابق',$lstbtn='الصفحة الاخيرة',$frstbrn='الصفحة الاولى') {
        global $WebSiteLang ;
        $current= "";
        $pager_Home="";
        $link1="";
       # echo "hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh".$WebSiteLang;
        
        if($WebSiteLang == "Ar"){
            
        }elseif($WebSiteLang == "En"){
            
        }
     
      
/*
        if($WebSiteLang == 'En' or ADMIN_WEB_LANG == 'En'){
            $nxtbtn = 'Next';
            $prevbtn = 
            $lstbtn = 'First page';
            $frstbrn ='Previous';
        }
*/
        if(!empty($_GET['page'])) {
            $current = $this->IntValue($_GET['page']);
        }
        if(is_array($uri)) {
            $link = $uri[0];
            $link1 = $uri[1];
        }elseif($uri != '') {
            $link = "?".$uri."&page=";
        } else {
            $link = "?page=";
        }
        $totalpages = ceil($count/$perpage);
        if($current > $totalpages) {
            $current = 1;
        }
        $current = intval($current);
        switch ($mode) {
            case PAGING_NEXT_PREV_NUM:
                $pager_Home .= '<ul class="pagination Pagination_Dir float-left">';
                if(($current == 0) || ($current == 1)) {
                    $current = 1;
                    if(($totalpages - $pages) <= 0){
                        $myloop = $totalpages;
                        $havelast = true;
                    } else {
                        $myloop = $pages;
                    }
                    for($i=1;$i<=$myloop;$i++) {
                        if($i==$current) {
                            $pager_Home .= '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
                        } else {
                            $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.$i.$link1.'">'.$i.'</a></li>';
                        }
                    }
                    if($totalpages > 1) {
                        $pager_Home .='<li class="page-item"><a class="page-link" href="'.$link.($current+1).$link1.'"><i class="fa fa-angle-right"></i></a></li>';
                    }
                    if($totalpages > $pages) {
                       $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.$totalpages.$link1.'"><i class="fa fa-angle-double-right"></i></a></li>';
                    }
                } else {
                
                    if(($current - ($pages +1) > 0)) {
                         $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.'1'.$link1.'"><i class="fa fa-angle-double-left"></i></a></li>';
                    }
          
                    $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.($current-1).$link1.'"><i class="fa fa-angle-left"></i></a></li>';
                     
                    if(($current - $pages) > 0) {
                        for($i=($current - $pages);$i<=$current;$i++) {
                            if($i==$current) {
                                $pager_Home .= '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
                            } else {
                                
                               $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.$i.$link1.'">'.$i.'</a></li>';
                            }
                        }
                    } else {
                        for($i=1;$i<=$current;$i++) {
                            if($i==$current) {
                                $pager_Home .= '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
                            } else {
                                $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.$i.$link1.'">'.$i.'</a></li>';
                            }
                        }
                    }
                    if((($totalpages - $current) > 0) && (($totalpages - $current) <= $pages)) {
                        for($i=$current+1;$i<=$totalpages;$i++) {
                            if($i==$current) {
                                 $pager_Home .= '<div class="pager-current">'.$i.'</div>';
                                 
                            } else {
                                $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.$i.$link1.'">'.$i.'</a></li>';
                            }
                        }
                    } elseif(($totalpages - $current) > $pages) {
                        for($i=$current+1;$i<=($current+$pages);$i++) {
                            if($i==$current) {
                                 $pager_Home .= '<div class="pager-current">'.$i.'</div>';
                                 
                            } else {
                                $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.$i.$link1.'">'.$i.'</a></li>';
                               
                            }
                        }
                    }
                    if($current < $totalpages) {
                       $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.($current+1).$link1.'"><i class="fa fa-angle-right"></i></a></li>';
                    }
                    if($totalpages > ($pages+$current)) {
                       $pager_Home .= '<li class="page-item"><a class="page-link" href="'.$link.$totalpages.$link1.'"><i class="fa fa-angle-double-right"></i></a></li>';
                    }
                    
                }
                break;
            case PAGING_NEXT_PREV_ONLY:
                if($current > 1) {
                    $pager_Home .= '<div class="pager-np"><a href="'.$link.($current-1).$link1.'">'.$prevbtn.'</a></div>';
                } else {
                    $pager_Home .= '<div class="pager-np">'.$prevbtn.'</div>';
                }
                if(($totalpages - $current) > 0) {
                     $pager_Home .='<div class="pager-np"><a href="'.$link.($current+1).$link1.'">'.$nxtbtn.'</a></div>';
                } else {
                    $pager_Home .= '<div class="pager-np">'.$nxtbtn.'</div>';
                }
                break;
        }
        $pager_Home .= '</ul>';
        $this->pager_Home = $pager_Home;
        return $pager_Home;
    }
 


#################################################################################################################################
###################################################    
#################################################################################################################################
    function H_SelectOneRow($sql) {
        $res = $this->Query($sql);
        $rs = mysqli_fetch_assoc($res);
        return $rs;
    }

#################################################################################################################################
###################################################    
#################################################################################################################################
    function H_CheckTheGet($GetValue,$FiledName,$TabelName,$SelType="1",$Mass1 = "Error",$Mass2 = "Error") {

        if(!isset($_GET[$GetValue])) {
            redirect_to2("index.php",$Mass1);
        } else {
            $GOODGetValue = $_GET[$GetValue];
        }

        if(!is_numeric($_GET[$GetValue])) {
            redirect_to2("index.php",$Mass1);
            exit;
        }else{
            $GOODGetValue = intval($_GET[$GetValue]);
        }

        $SQLLine = "SELECT '$FiledName' FROM $TabelName WHERE $FiledName = $GOODGetValue" ;

        $already = mysqli_num_rows(mysqli_query($this->link, $SQLLine ));
        if($already <= 0) {
            redirect_to2("index.php",$Mass2);
        } else {

            if($SelType == '1'){

                return $GOODGetValue;

            }elseif($SelType == '2'){
                $SQLLine = "SELECT * FROM $TabelName WHERE $FiledName = $GOODGetValue" ;
                $sendRow =  $this->H_SelectOneRow($SQLLine);
                return $sendRow ;
            }

        }
    }
#################################################################################################################################
###################################################
#################################################################################################################################
    function H_Total_Count($SQLLine){
        $already = mysqli_num_rows(mysqli_query($this->link, $SQLLine ));
        return $already ;
    }
#################################################################################################################################
###################################################
#################################################################################################################################
    function H_DELETE_Filte_With_Filde($Tabel,$Filde,$ID){
        $sql = "DELETE FROM $Tabel WHERE $Filde = '$ID' ";
        $res = $this->Query($sql);
    }
#################################################################################################################################
###################################################
#################################################################################################################################
    function H_DELETE_FromId($Tabel,$ID){
        $sql = "DELETE FROM $Tabel WHERE id ='$ID'";
        $res = $this->Query($sql);
    }
#################################################################################################################################
###################################################
#################################################################################################################################
    function H_DELETE($SQL_LINE){
        $res = $this->Query($SQL_LINE);
    }
#################################################################################################################################
###################################################
#################################################################################################################################
    function H_EmptyTabel($Tabel){
        $sql = "TRUNCATE TABLE $Tabel " ;
        $res = $this->Query($sql);
    }
#################################################################################################################################
###################################################
#################################################################################################################################
    function H_EmptyTabel_DROP($Tabel){
        $sql = "DROP TABLE $Tabel " ;
        $res = $this->Query($sql);
    }
#################################################################################################################################
###################################################
#################################################################################################################################
    function H_Filde_DROP($Tabel,$Filde){
        $sql = "ALTER TABLE $Tabel DROP COLUMN $Filde";
        $res = $this->Query($sql);
    }

}

?>