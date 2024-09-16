<?php
include('connect.php');

/****************************************************************************************************************************/					      									    
/* PHP4WX 9.2.0.15   du 25/06/2019
/* Createur : EMPRIN Frederic @ 2003
/* email : emprin.frederic@emidev.fr
/* www.emidev.fr / www.SQLManagerX.com                                                                                          
/****************************************************************************************************************************/

$filename	= tempnam('/tmp', 'ZIP_RES_');
$ScriptVersion 	= "PHP4WX 9.2.0.15 du 25/06/2019";

//***************************************************************************************************************************
// deactivation et choix des erreur ou infos renvoyer par php
//***************************************************************************************************************************
$e = error_reporting();
error_reporting($e & (E_ALL -E_DEPRECATED -E_WARNING -E_NOTICE));
ini_set('MAX_EXECUTION_TIME', -1);

//***************************************************************************************************************************
// analyse de la demande et recuperation des requetes et variables pour les procedures stockees
//***************************************************************************************************************************

$cmds 						=str_replace(';','',$_POST['requete']);
$CrypteReq 					=$_POST['CrypteReq'];
$methode 					=$_POST['methode'];
$typeBase					=$_POST['typeBase'];
$charSet					=$_POST['charset'];
$dataHexa					=$_POST['dataHexa'];
$crypteretour 				=$_POST['crypteretour'];
$modeUTF8Sortie 			=$_POST['modeUTF8Sortie'];

if ($charSet=='') $charSet='UTF-8';
if ($CrypteReq=='') $CrypteReq='OUI';

echo '<!DOCTYPE html>';
header ('Content-type:text/html; charset='.$charSet); 

//***************************************************************************************************************************
// retour cryptee
//***************************************************************************************************************************
if ($crypteretour =="") 	$crypteretour	='NON';
//***************************************************************************************************************************

if ($_POST['tNomBase'] != "") 	$base		=$_POST['tNomBase'];
 
$bind    	=$_POST['bind'];
$bindLen 	=$_POST['bindLen'];
$bindVal 	=$_POST['bindVal'];
$bindType	=$_POST['bindType'];

$bind     	= Decoupe_chaine($bind);
$bindLen  	= Decoupe_chaine($bindLen);
$bindVal  	= Decoupe_chaine($bindVal);
$bindType 	= Decoupe_chaine($bindType);

//***************************************************************************************************************************
// decryptage de la requetes : le cryptage a l'envoi est obligatoire pour eviter les injections SQL
//***************************************************************************************************************************
$bindRes  	= array();
echo '<meta http-equiv="Content-Type" content="text/html; charset='.$charSet.'" />';
if ($CrypteReq=='OUI') $cmds = URLDecrypt($cmds,$PublicKey,$charSet);
$cmds 	  	= Decoupe_chaine($cmds);

/***********************************************************************************************/
/* pour test du fichier en ligne de commande a mettre en commentaire avant passage a windev    */
/***********************************************************************************************/
if($_GET['test']=='OUI'){ 
	error_reporting($e & (E_ALL -E_WARNING -E_NOTICE));
	$typeBase	= 'PDOMySQL';
 	
	//***************************************************************************************
	// requete test Pour afficher en mode navigateur et voir le test
	//***************************************************************************************
	//$cmds[] 	= "select nom,prenom,dateNaissance,adresse  from contacts WHERE  adresse like '%وادي ليون%' ";
	$cmds[] 	= "select nom,prenom,dateNaissance,adresse  from contacts ";
		
	echo "version script : <b>".$ScriptVersion."</b><br>";
	echo "version php : <b>".phpversion()."</b><br><br>";
}
/***********************************************************************************************/

//***************************************************************************************************************************
// Securité au cas ou les requetes ne sont pas cryptée il faut verifier si c'est bien le programme windev
// qui est la source avec la cle il a crypté une chaine qui doit etre identique a celle du script
//***************************************************************************************************************************
$IDPHP4WX = $_POST['IDPHP4WX'];
$IDPHP4WX = URLDecrypt($IDPHP4WX,$PublicKey,$charSet);
if ($IDPHP4WX != "PHP4WX_SQLMANAGERX_SCRIPT" && $_GET['test']!='OUI') die("version script : <b>".$ScriptVersion."</b><br>Source non identifiée, acces refusée");

//***************************************************************************************************************************
// definition des fonctions suivant le type de base
// attention envoyee le script directement par le navigateur va cree des erreur le nom de la fonction doit etre renseigne
// le script ne fonctionnera que connecte a la classe windev sinon on aura des erreur php possible suivant la config du php
// sur le serveur apache ou IIS
//***************************************************************************************************************************

$indiceDebut = 0;
switch ($typeBase) {

case "MYSQL":
    $func_connect 	= 'func_connect_mysql';
    $func_query 	= 'func_mysql_query';
    $func_num_rows 	= 'mysql_num_rows';
    $func_fetch_array 	= 'mysql_fetch_array';
    $func_error		= 'mysql_error';
    $func_close		= 'mysql_close';
    $func_num_cols 	= 'mysql_num_fields';
    $func_get_col_name 	= 'mysql_field_name';
    $indiceFin = 0;
    break;

case "MYSQLI":
    $func_connect 	= 'func_connect_mysqli';
    $func_query 	= 'func_mysqli_query';
    $func_num_rows 	= 'mysqli_num_rows';
    $func_fetch_array 	= 'mysqli_fetch_array';
    $func_error 	= 'mysqli_error';
    $func_close 	= 'mysqli_close';
    $func_num_cols 	= 'mysqli_num_fields';    
    $func_get_col_name 	= 'func_get_field_name_mysqli';
    $indiceFin 		= 0;
    break;

case "PDOMySQL":
    $func_connect 	= 'func_pdoconnect_mysql';
    $func_query 	= 'func_pdo_query';
    $func_num_rows 	= 'func_pdo_getNumRow';
    $func_fetch_array 	= 'func_pdo_fetch';
    $func_error		= '$session->errorInfo';
    $func_close		= 'func_pdo_close';
    $func_num_cols 	= 'func_pdo_getNumCol';
    $func_get_col_name 	= 'func_pdo_ColName';
    $indiceFin 		= 0;
    break;

case "PDOSQLSRV":
    $func_connect 	= 'func_pdoconnect_sqlsrv';
    $func_query 	= 'func_pdo_query';
    $func_num_rows 	= 'func_pdo_getNumRow';
    $func_fetch_array 	= 'func_pdo_fetch';
    $func_error		= '$session->errorInfo';
    $func_close		= 'func_pdo_close';
    $func_num_cols 	= 'func_pdo_getNumCol';
    $func_get_col_name 	= 'func_pdo_ColName';
    $indiceFin 		= 0;
    break;

case "POSTGRESQL":
    $func_connect 	= 'func_connect_postgre';
    $func_query 	= 'func_pg_query';
    $func_num_rows 	= 'pg_NumRows';
    $func_fetch_array 	= 'pg_Fetch_Array';
    $func_error 	= 'pg_ErrorMessage';
    $func_close		= 'pg_Close';
    $func_num_cols 	= 'pg_Numfields';
    $func_get_col_name 	= 'pg_FieldName';
    $indiceFin 		= 0;
   break;

case "SQLITE":
    $func_connect 	= 'func_connect_sqlite';
    $func_query 	= 'func_sqlite_query';
    $func_num_rows 	= 'sqlite_num_rows';
    $func_fetch_array 	= 'sqlite_fetch_array';
    $func_error		= 'sqlite_error';
    $func_close		= 'sqlite_close';
    $func_num_cols 	= 'sqlite_num_fields';
    $func_get_col_name 	= 'sqlite_field_name';
    $indiceFin 		= 0;
   break;

case "MSSQL":
    $func_connect 	= 'func_connect_mssql';
    $func_query 	= 'func_mssql_query';
    $func_num_rows 	= 'mssql_num_rows';
    $func_fetch_array 	= 'mssql_fetch_array';
    $func_error 	= 'mssql_get_last_message';
    $func_close		= 'mssql_close';
    $func_num_cols 	= 'mssql_num_fields';
    $func_get_col_name 	= 'mssql_field_name';
    $indiceFin 		= 0;
   break;

case "FB":
    $func_connect 	= 'func_connect_firebird';
    $func_query 	= 'func_fbsql_query';
    $func_num_rows 	= 'ibase_num_rows';
    $func_fetch_array 	= 'ibase_fetch_row';
    $func_error 	= 'ibase_errmsg';
    $func_close		= 'ibase_close';
    $func_num_cols 	= 'ibase_num_fields';
    $func_get_col_name 	= 'func_fbsql_num_fields';
    $indiceFin 		= 0;
   break;

case "ORACLE":
    $func_connect 	= 'func_connect_oracle';
    $func_query 	= 'func_oracle_query';
    $func_num_rows 	= 'oci_num_rows';
    $func_fetch_array 	= 'func_fetch_row';
    $func_error 	= 'oci_error';
    $func_close		= 'oci_close';
    $func_num_cols 	= 'oci_num_fields';
    $func_get_col_name 	= 'oci_field_name';
    $indiceFin 		= 1;
    $indiceDebut	= 0;
   break;

case "ODBC":
    $func_connect 	= 'func_connect_odbc';
    $func_query 	= 'func_odbc_query';
    $func_num_rows 	= 'odbc_num_rows';
    $func_fetch_array 	= 'odbc_fetch_array';
    $func_error 	= 'odbc_errorMsg';
    $func_close		= 'odbc_close';
    $func_num_cols 	= 'odbc_num_fields';
    $func_get_col_name 	= 'odbc_field_name';
    $indiceFin 		= 1;
    $indiceDebut	= 1;
   break;

case "ADO":
    $func_connect 	= 'func_connect_ADO';
    $func_query 	= 'func_odbc_query';
    $func_num_rows 	= 'odbc_num_rows';
    $func_fetch_array 	= 'odbc_fetch_array';
    $func_error 	= 'odbc_errorMsg';
    $func_close		= 'odbc_close';
    $func_num_cols 	= 'odbc_num_fields';
    $func_get_col_name 	= 'odbc_field_name';
    $indiceFin 		= 1;
    $indiceDebut	= 1;
   break;
}
//***************************************************************************************************************************
// debut traitement du retour
//***************************************************************************************************************************
$value='--DEBUTSQL--'.'PHP4WDSEP';

//***************************************************************************************************************************
// connexion a la base SQL par php et execution des requetes separee par ;
//***************************************************************************************************************************

$session = $func_connect($serv, $user, $pass, $base) or die("<p class='Perror'>&middot;Failed - err Connect: ".print_r($func_error())."</p>");

//***************************************************************************************************************************
// envoi des commande set pour le mode utf8
//***************************************************************************************************************************
if ($modeUTF8Sortie=="OUI"){
	$func_query("SET CHARACTER SET 'UTF8'",$session,$bind,$bindVal,$bindLen,$bindRes,$bindType);
	$func_query("SET NAMES UTF8",$session,$bind,$bindVal,$bindLen,$bindRes,$bindType);
}

for($n=0; $n<count($cmds); $n++){
	$tcmd = trim($cmds[$n]);
	if($tcmd != '' && strncmp($tcmd, '-', 1) != 0){
		$result = $func_query($tcmd,$session,$bind,$bindVal,$bindLen,$bindRes,$bindType) or die("<p class='Perror'>&middot;Failed - err SQL: ".$func_error()."</p><br>".$tcmd);
		$numcols = $func_num_cols($result);
		if ($numcols > 0) {

			//***************************************************************************************************************************
			// generation des entetes de colonnes
			//***************************************************************************************************************************
			for ($col = $indiceDebut; $col < $numcols+$indiceFin; $col++) {
				$name = $func_get_col_name($result, $col);
 				if ($name != null){
					$UneColonne = $name;
					$value .=($UneColonne).'PHP4WDSEP';
    				}
			}
			
			//***************************************************************************************************************************
			// generation des seprateurs pour resultat
			//***************************************************************************************************************************
			 $value .= '--LIGNES--PHP4WDSEP';
			
			//***************************************************************************************************************************
			// generation des valeurs du resultat 
			//***************************************************************************************************************************
			while ($line = $func_fetch_array($result)) {				
				for ($col = $indiceDebut; $col < $numcols+$indiceFin-($indiceFin-$indiceDebut); $col++) {
					$UneColonne ='';
					if($line[$col]!=null) $UneColonne = trim($line[$col]);
					if ($typeBase=='ADO'||$typeBase=='ODBC') $UneColonne = trim($line[$func_get_col_name($result, $col)]);
					if ($dataHexa=='OUI') $UneColonne = bin2Hex($UneColonne);
					if($crypteretour == 'OUI') $UneColonne = URLCrypt($UneColonne,$PublicKey);
					$value .=$UneColonne.'PHP4WDSEP';
				} 
				unset($line);
			}
		}	 
	}
}

//***************************************************************************************************************************
// Fin de la requete a renvoyer on met les indicateurs de fin et les variables bind pour resultat
//***************************************************************************************************************************
$value .= '--BINDVARIABLE--PHP4WDSEP';
for($i=0;$i<count($bind);$i++){
	$UneColonne =$bindRes[$i];
	if ($dataHexa=='OUI') $UneColonne = bin2Hex($UneColonne);
	if($crypteretour == 'OUI') $UneColonne = URLCrypt($UneColonne,$PublicKey);
	$value .= $UneColonne.'PHP4WDSEP';
}
$value .= '--FINSQL--'.'PHP4WDSEP';

//***************************************************************************************************************************
// Fermeture de la sessions
//***************************************************************************************************************************
$func_close($session);

//***************************************************************************************************************************
// AFFICHAGE RESULTAT A RENVOYER OU FICHIER ZIP
//***************************************************************************************************************************
if ($methode!='zip'){
	header ('Content-type:text/html; charset=$charSet');
}
	
//***************************************************************************************************************************
// Retour en mode ZIP il faut reecrire les entete pour que ce soit un fichier zip envoye
//***************************************************************************************************************************
if ($methode=='zip'){
	$zip = new ZipArchive;
	$zip->open($filename, ZipArchive::CREATE);
	$zip->addFromString('resultat.txt',$value);
	$zip->close();
	$handle = fopen($filename, "rb");
   	$value  = fread($handle, filesize($filename));
	fclose($handle);
	unlink($filename);	
}
//***************************************************************************************************************************
echo $value;
?>