<?php
$s_path='/var/www/html/SO/SO/ToolOpsDashBoard/RETINS/MQ_scripts/DCS_UN_DASH/dinesh_test';
chdir('..');
$old_path=getcwd();
#echo $old_path;
$ip=$_REQUEST['ip'];
$port=$_REQUEST['port'];
#$ip=$argv[1];
#$port=$argv[2];
#echo "\nip".$ip;
#echo "\nport".$port;
$filename=$ip.'_'.$port.'.out';
#echo "\nfilename".$filename;
$outfile=fopen($filename,'w');
chdir($s_path);
chdir('..');
$output=shell_exec('sh /var/www/html/SO/SO/ToolOpsDashBoard/RETINS/MQ_scripts/DCS_UN_DASH/Main_DCS.sh '.$ip.' '.$port);
//ell_exec("sudo echo $output > ./dinesh_test/$filename");
#echo "<p>$output</p>";
$outfile=fopen('/var/www/html/SO/SO/ToolOpsDashBoard/RETINS/MQ_scripts/DCS_UN_DASH/dinesh_test/'.$filename,'w');
fwrite($outfile,$output);
fclose($filename);
chdir($s_path);
$output1=shell_exec('sh format_output_new.sh '.$filename);
echo "<p>$output1<p>";
?>

