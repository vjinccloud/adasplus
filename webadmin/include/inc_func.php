<?php
function myStripslashes($value)
{

    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
function replaceImgtag($str)
{
    $startindex = strpos($str, '<img');
    if ($startindex === false) {
        return $str;
    }
    $returnstr="";
    $firststr = substr($str, 0, $startindex);
    $returnstr.=$firststr;
    $tempstr=substr($str,$startindex);
    $startindex=strpos($tempstr,'>');
    $returnstr.=substr($tempstr,$startindex+1);
    return replaceImgtag($returnstr);

}
