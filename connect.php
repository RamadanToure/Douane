<?php
/****************************************************************************************************************************/					      									    
/* PHP4WX 9.2.0.15   du 25/06/2019
/* Createur : EMPRIN Fredec @ 2003
/* email : emprin.frederic@emidev.fr
/* www.emidev.fr / www.SQLManagerX.com                                                                                          
/****************************************************************************************************************************/

$PublicKey = 'CLE_CRYPTAGE';

/*******************************************************************
* CONNEXION ACTIVE        ------------------------------------------
********************************************************************/
$serv = '127.0.0.1';
$user = 'root';
$pass = '';
$base = 'laravel';

/*********************************************************************			      									    
EXEMPLE DE CONNEXIONS
REPRENEZ EN COPIER/COLLER CELUI NECESSAIRE ET FAITES LES CHANGEMENTS

-----------CONNEXION MYSQL -----------
$serv = '127.0.0.1';
$user = 'root';
$pass = '';
$base = 'tests';

----------- CONNEXION POSTGRESQL -----------
$serv = '192.168.1.20';
$user = 'postgres';
$pass = 'emidev';
$base = 'tests';

----------- CONNEXION ORACLE OCI-----------
$serv = '192.168.1.20';
$user = 'SYSTEM';
$pass = 'emidev';
$base = "(DESCRIPTION =
    		(ADDRESS = (PROTOCOL = TCP)(HOST = ".$serv.")(PORT = 1521))
    		(CONNECT_DATA =	(SERVICE = XEDB))
  	)";

----- CONNEXION SQLSERVER ADO-----------
$serv = 'DRIVER={SQL Server};SERVER=EMIDEV-DEV-PC\EMIDEV_SQLSERVER';
$user = 'sa';
$pass = 'emidev';
$base = 'MSTESTS';
************************************************************************/			      									    

/*******************************************************************
* FONCTION DECOUPE CHAINE ------------------------------------------
********************************************************************/

function Decoupe_chaine( $str, $delim=";" , $qual= "'") 
{
   $insidequotes  = false;
   $returnarray=array();
   $elementcount=0;
   $currentelement = '';
   
   for ($i = 0; $i < strlen($str); $i++)
   {
       $j = $i-1;
       
       if ($str[$i] == $qual && $str[$j] != '\\') {
           $insidequotes =  !$insidequotes;
        }
		if ($str[$i] == $delim && $insidequotes == false){
               $returnarray[$elementcount++] = $currentelement;
               $currentelement = '';
	       $insidequotes = false;
        }else{
            $currentelement .= $str[$i];
        }
   }
   if ($currentelement != '') $returnarray[$elementcount++] = $currentelement;
   return $returnarray;       
}

/*******************************************************************
* FONCTION PDO mySQL        -----------------------------------------
********************************************************************/
function func_pdoconnect_mysql($serv, $user, $pass, $base) {
	try {
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
		$dsn = 'mysql:host='.$serv.';dbname='.$base;
		$session = new PDO( $dsn, $user, $pass ,$pdo_options);
	}
	catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	return $session;
}

/*******************************************************************
* FONCTION PDO SQLServer    -----------------------------------------
********************************************************************/
function func_pdoconnect_sqlsrv($serv, $user, $pass, $base) {
	try {
		$dsn ='sqlsrv:Server='.$serv.';Database='.$base;
		$session = new PDO( $dsn, $user, $pass );
		$session->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
	}
	catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	return $session;
}

/*******************************************************************
* FONCTION PDO COMMUN   -----------------------------------------
********************************************************************/

function func_pdo_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
	try {	
		$res = $sess->prepare($query);
		$res->execute();
	}
	catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
 	return $res;
}

function func_pdo_getNumRow($result){
	return $result->rowCount();
}

function func_pdo_close($result){
	$sresult=null;
	return true;
}

function func_pdo_getNumCol($result){
	return ($result->columnCount());
}

function func_pdo_colName($result,$indexCol){
	$columns_names = $result->getColumnMeta($indexCol);
	$name = $columns_names["name"];
	return $name;
}

function func_pdo_fetch($result){
	return $result->fetch(PDO::FETCH_BOTH);
}

/*******************************************************************
* FONCTION EXEC SQL BDD ------------------------------------------
********************************************************************/

function func_mysql_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
    return mysql_query($query, $sess);
}

function func_mysqli_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
    $Resultat = mysqli_query($sess,$query);
    if (!is_object($Resultat) && $Resultat!=true) die("<p class='Perror'>Failed - err SQL: ".mysqli_error($sess)."</p><br>".$query);
    return $Resultat;
}

function func_get_field_name_mysqli($result, $col){
	$obj_my_col=mysqli_fetch_field_direct($result, $col);
	return $obj_my_col->name;
}

function func_sqlite_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
    return sqlite_query($query, $sess);
}

function func_pg_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
    return pg_query($sess, $query);
}

/*******************************************************************
* FONCTION EXEC SQLServer -----------------------------------------
********************************************************************/
function ErreurExecutionMSSQL(){
	$erreur = mssql_get_last_message();
  die("<p class='Perror'>&middot;Failed - err: ".$erreur."</p>") ;
}

function func_mssql_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
      
    if (count($bin)>=1 ){  
    	$res =  mssql_init($query);
  		for($i=0; $i<count($bin); $i++){	
  			$TypeParam = TRUE;
	  		$biRes[$i] = $biVal[$i];	 
	  		if ($biLen[$i] == -1) $TypeParam = FALSE; 
	  		if ($biType[$i] == 1) $msType = SQLVARCHAR;
	  		if ($biType[$i] == 2) $msType = SQLINT4;
	  		if ($biType[$i] == 3) $msType = SQLFLT8;
	  		if ($biType[$i] == 4) $msType = SQLVARCHAR;
	  		mssql_bind($res,$bin[$i],$biRes[$i], $msType,$TypeParam);
 		 }
     	$resExec = mssql_execute($res);
 		while(mssql_next_result($resExec)){
		}
	  }else{
 			$resExec = mssql_query($query);
 			if (!$resExec) ErreurExecutionMSSQL();
 		}
 		return $resExec;
}
/*******************************************************************
* FONCTION EXEC ODBC-----------------------------------------
********************************************************************/
function func_odbc_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
    $resExec = odbc_exec($sess, $query) or die(odbc_error($sess));
    return $resExec;
}

/*******************************************************************
* FONCTION EXEC FireBird -----------------------------------------
********************************************************************/
function func_fbsql_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
    $resExec = ibase_query($sess, $query) or die(ibase_errmsg());
    return $resExec;
}

function func_fbsql_num_fields($rs,$i){
	$col_info = ibase_field_info($rs, $i);
  return $col_info['name'];
}

/*******************************************************************
* FONCTION EXEC ORACLE  ------------------------------------------
********************************************************************/

function func_fetch_row($res){
    return oci_fetch_array($res, OCI_NUM+OCI_RETURN_NULLS);
}

function ErreurExecutionOracle($contexte){
	$erreur = oci_error($contexte);
  die("<p class='Perror'>&middot;Failed - err: ".$erreur['message']."</p>") ;
}

function func_oracle_query($query, $sess, &$bin, &$biVal, &$biLen, &$biRes,&$biType){
    
    $ExecCurseur = false;
    
    if (count($bin)>=1 ) $query ='BEGIN ' .$query .';END;';
  	$res =  oci_parse($sess, $query);
  	if (!$res) ErreurExecutionOracle($sess);
    
    for($i=0; $i<count($bin); $i++){
    	$biRes[$i] = $biVal[$i];
    	if ($biType[$i]!='4'){
    			oci_bind_by_name($res,$bin[$i],$biRes[$i],$biLen[$i]);
    	}else{
    		  $curs = oci_new_cursor($sess);
    			oci_bind_by_name($res,$bin[$i],$curs, -1, OCI_B_CURSOR);
    			$ExecCurseur = true;
		}
    }
    oci_set_prefetch($res, 5000);    
    $resExec = oci_execute($res); 
 		if (!$resExec)
 					ErreurExecutionOracle($res);
 		if ($ExecCurseur==true){
				$resExec = oci_execute($curs);
				if (!$resExec) ErreurExecutionOracle($res);
				return $curs;  		
    }
    return $res;
}

/*******************************************************************
* FONCTION CONNEXION BDD ------------------------------------------
********************************************************************/

function func_connect_mysql($serv, $user, $pass, $base) {
    $Session = mysql_connect($serv, $user, $pass);
    if ($Session && $base != '') mysql_select_db($base);
    if ($Session && $base != '') mysql_query('SET SESSION SQL_MODE=""', $Session);
    return $Session;
}

function func_connect_mysqli($serv, $user, $pass, $base) {
	$my_socket=ini_get("mysqli.default_socket"); 
	$my_port=ini_get("mysqli.default_port"); 
	if (strpos($serv, ':') !== false){         
		list($server, $port_et_socket) = explode(':', $serv);         
		$pos_slash_socket = strpos($port_et_socket,'/');  
		if ($pos_slash_socket !==false) {                          
			$my_port=substr($port_et_socket,0,$pos_slash_socket);             
			if($my_port ==''){                 
				$my_port=ini_get("mysqli.default_port");             
			}
			$my_socket=substr($port_et_socket,$pos_slash_socket);             
		}else{             
			$my_port=$port_et_socket;          
		}                           
		if($my_socket <> ''){             
			$Session = mysqli_connect($server, $user, $pass,$base,$my_port,$my_socket);          
		}else{             
			$Session = mysqli_connect($server,$user,$pass,$base,$my_port);          
		}                      
	}else{         
		$Session = @new mysqli($serv,$user,$pass,$base);     
	}          
	if ($Session && $base != '') mysqli_select_db($Session,$base);      
	if ($Session && $base != '') mysqli_query($Session,'SET SESSION SQL_MODE=""');      
	return $Session;       
}

function func_connect_mssql($serv, $user, $pass, $base) {
    $Session = mssql_connect($serv, $user, $pass);
    if ($Session && $base) mssql_select_db($base);
    return $Session;
}

function func_connect_sqlite($serv, $user, $pass, $base) {
    $Session = sqlite_open($base);
    return $Session;
}

function func_connect_postgre($serv, $user, $pass, $base) {
    $conn_str = "host=$serv dbname=$base user=$user password=$pass ";
    return pg_connect($conn_str);
}

function func_connect_firebird($serv, $user, $pass, $base) {
    $Session = ibase_connect($serv, $user, $pass);
    return $Session;
}
function func_connect_oracle($serv, $user, $pass, $base) {
    $Session = oci_connect($user,$pass,$base) ;
    return $Session;
}
function func_connect_odbc($DSN, $user, $pass, $base) {
    $Session = odbc_connect($DSN,$user,$pass,SQL_CUR_USE_ODBC) ;
    return $Session;
}
function func_connect_ADO($DSN, $user, $pass, $base) {
    $Session = odbc_connect($DSN.';DATABASE='.$base,$user,$pass,SQL_CUR_USE_ODBC)or die("ERREUR CONNEXION : ".odbc_errorMsg());
	return $Session;
}

/*******************************************************************
* FONCTION CRYPTAGE ------------------------------------------
********************************************************************/

function AjusteTailleCle($PublicKey,$taille){
	$indice=0;
	$retour= $PublicKey;
	if ($taille > 20)
            $taille = 20;
	while(strlen($retour) < $taille){
		$retour = $retour. $PublicKey[$indice];
		$indice++;
		if($indice > strlen($PublicKey)) $indice = 0; 
	}
	return $retour;
}

function URLDecrypt($ChaineCryptee,$PublicKey,$charSet){

	$i=0;
	$indiceCle=0;

	$ChaineDeCryptee="";
	$CleCrypt = AjusteTailleCle($PublicKey,strlen($ChaineCryptee)/3);
    $tailleCrypt = strlen($CleCrypt);
	$tailleChaineCryptee = strlen($ChaineCryptee);

	while( $i<$tailleChaineCryptee){
		$ChaineDeCryptee .= chr(substr($ChaineCryptee,($i) ,3)-ord($CleCrypt[($indiceCle)]));
		$indiceCle = ($indiceCle + 1) % $tailleCrypt;
		$i=$i+3;
	}
	return $ChaineDeCryptee;
}


function URLCrypt($ChaineAcryptee,$PublicKey){

	$indiceCle=0;
	$ChaineCryptee="";
	$CleCrypt = AjusteTailleCle($PublicKey,strlen($ChaineAcryptee));
        $tailleCrypt = strlen($CleCrypt);
	$tailleChaineAcryptee = strlen($ChaineAcryptee);

	for( $i=0; $i<$tailleChaineAcryptee; $i++){
		$ChaineCryptee .= substr(('000'.(ord($ChaineAcryptee[$i])+ord($CleCrypt[($indiceCle)]))),-3);
                $indiceCle = ($indiceCle + 1) % $tailleCrypt;
	}
	return $ChaineCryptee;
}
//***************************************************************************************************************************
?>