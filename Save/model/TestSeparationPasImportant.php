
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<LINK rel="stylesheet" type="text/css" href="style/style.css">
<title>Résumer du texte</title>
</head>

<body>
<table width="100%" height="100%" border="0">
  <tbody><tr align="center">
    <td height="90" colspan="3" bgcolor="#000000"><img src="image/resumeur.png" width="352" height="69"></td>
  </tr>
  <tr>
    <form action="" method="post">
      <td width="16%"> </td>
      <td width="66%" align="center"> <strong>Saisissez/collez le texte à résumer
        dans le champs si dessous puis </strong>
        <input type="submit" name="validez" value="Validez">
        <br>
        <textarea name="resumer" rows="15" cols="110"><?php if (isset($_POST['resumer'])) echo $_POST['resumer'] ; ?>
        </textarea>
        <br>
        <input name="ok" type="submit" value="Valider"> </td>
      <td width="18%" align="center"><table width="100%" border="0">
          <tbody><tr>
            <td align="center"><font size="1"><a href="www.3wmedia.ma">-aide-</a></font></td>
          </tr>
          <tr>
            <td> </td>
          </tr>
        </tbody></table>
        <table width="100%" border="0">
          <tbody><tr>
            <td align="center" bgcolor="#000000"><strong><font color="#FFFFFF">Options</font></strong></td>
          </tr>
          <tr>
            <td><select name="langue">
       <option value="en">Arabe</option>
    <option value="fr">Français</option>
                <option value="en">English</option>
              </select>
              Langue </td>
          </tr>
          <tr>
            <td><select name="compress">
   <option value="30">30%</option>                <option value="10">10%</option>
                <option value="20">20%</option>
                <option value="30">30%</option>
                <option value="40">40%</option>
                <option value="50">50%</option>
                <option value="60">60%</option>
                <option value="70">70%</option>
              </select>
              Compression</td>
          </tr>
          <tr>
            <td>
<input name="html" type="checkbox" value="checked">
              afficher la source</td>
          </tr>
        </tbody></table></td>
    </form>
  </tr>
  <tr>
    <td height="91"> </td>
    <td valign="top"> <table width="80%" border="1" align="center" cellspacing="0" bordercolor="#000000">
        <tbody><tr>
          <td align="center" bgcolor="#000000"><font color="#FFFFFF"><strong>Résumé</strong></font></td>
        </tr>
        <tr>
          <td>
<p align="center"><font color='#000000' face="Trebuchet MS" size="3"><strong>Sujet :</strong></font>
<?php
$chaine="";
if (isset($_POST['resumer'])){
$chaine=$_POST['resumer']; // récuperation de la chaine de caractere par la méthode post
$decoupage= explode(".", $chaine);// decoupage de la chaine en phrase par le séparateur .
$sujet= substr($chaine, 0, 20);
$resumer= substr($chaine,0, 200);
echo "<b>$sujet</b><br/>";
//echo "<br/><div class=\"stl_chaine\"> $resumer</div>";
//***** résumeur de texte -> paraghraphes -> phrases -> mots *****
function character_limiter($str, $n = 500, $end_char = '?')
{
    if (strlen($str) < $n)
    {
        return $str;
    }

    $str = preg_replace("/s+/", ' ', str_replace(array("rn", "r", "n"), ' ', $str));

    if (strlen($str) <= $n)
    {
        return $str;
    }

    $out = "";
    foreach (explode(' ', trim($str)) as $val)
    {
        $out .= $val.' ';

        if (strlen($out) >= $n)
        {
            $out = trim($out);
            return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
        }
    }
 }


echo character_limiter($chaine, 300);// affichage du résultat

/*$delimitParagraphe = "rr"; // et r si windows
$paragraphes= explode ( $delimitParagraphe , $chaine );
foreach ($paragraphes as $kye=>$paragraphe) {
   $phrases= explode ( "." , $paragraphe );
   foreach ($phrases as $kye1=>$phrase) {
      $mots= explode ( " " , $phrase );
   }

}*/
//echo ''.$kye.' | '.$paragraphe.'<br />';
//echo ''.$kye1.' | '.$phrase.'<br />';
//echo $mots;
//****************************fin***********************************



}
?></p>
<p align="center"><strong><font size="2">
<?php


// Longueurs de chaînes

$longueur = strlen($chaine);
$count_word = str_word_count($chaine);
//affichage de la Longueur du chaîne
echo "<br /><br /><font color='#000938' face='arial' size='2'>Votre texte contient</font> <font color='#B9121B' face='verdana' size='2'>$longueur </font> <font color='#000938' face='arial' size='2'>caractères.</font><br />";
echo "<font color='#000938' face='arial' size='2'>Votre texte contient</font> <font color='#B9121B' face='verdana' size='2'>$count_word </font> <font color='#000938' face='arial' size='2'>Mots.</font><br /><br /><br />";

// teste des occurences dans un texte données
$tab = str_word_count($chaine, 2); // $chaine represente la chaine de caractére et 2 retourne un tableau associatif,où la clé indique la position                                        //numérique du mot à l'intérieur de string et la valeur est le mot actuel
$occ = array(); // récuper un tableau

foreach ($tab as $word)
{
   if (!isset($occ[$word]))
      $occ[$word] = 0;
   $occ[$word]++;
}



//******** fin teste ***************************


?>
</font></strong></p>
<br>
          <table width="450" border="0" align="center">
            <tr bgcolor="#324800" height="30px">
              <td align="center"><b><font color='#F8FAF4' face="arial" size="2">Mots</font></b></td>
              <td align="center"><b><font color="#F8FAF4" face="arial" size="2">Nombre d'occurence</font></b></td>
            </tr>
<?php
foreach($occ as $cle=>$valeur)
    {
 echo "<tr> 
    <td bgcolor='#90CE00' ><b><font color='#000938' face='arial' size='2'>$cle</font></b></td> 
                <td bgcolor='#DFFAA0' align='center'><b><font color='#000938' face='arial' size='2'>$valeur</font></b></td> 
      </tr>";

    }
?>

          </table></td>
        </tr>
      </tbody></table>
      <br>
    </td>
    <td> </td>
  </tr>
  <tr align="center" valign="bottom" bgcolor="#000000">
    <td height="90" colspan="3"><font color="#FFFFFF" size="1">GPL 2013, Roy2rai @taoufik.rai@gmail.com
      -<a href="http://3wmedia.ma"> <font color="#FFFFFF">informations légales </font></a></font></td>
  </tr>
</tbody></table>

</body>
</html>