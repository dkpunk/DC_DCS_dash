<?php
$s_path=getcwd();
chdir('..');
$old_path=getcwd();
#echo $old_path;
print "<!doctype html><html><head><title>DC Details</title></head><body>";
print <<< HERE
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="75%">
<thead>
  <tr>
   <th>Region</th>
   <th>DC Health Status</th>
  </tr>
</thead>
<tbody>
HERE;
$region=$_REQUEST['region'];
#print $region;
#$ip=$argv[1];
#$port=$argv[2];
#echo "\nip".$ip;
#echo "\nport".$port;
$path='/var/www/html/SO/SO/ToolOpsDashBoard/RETINS/MQ_scripts/DCS_UN_DASH/';
$filename=$path.'node_details_DC_'.$region.'.txt';
$statusfilename=$path.'DC_instance_status_'.$region.'.txt';
#print $filename;
$tmpup="";
$tmpdown="";
#echo "\nfilename".$filename;
$data=file($filename);
$status_contents=file_get_contents($statusfilename);
foreach ($data as $line){
$lineArray=explode(";",$line);
$tmpsock='<table id="example" class="table table-striped table-bordered" cellspacing="0" width="50%">';
$downinst="";
$upinst="";
#$tmpstatus="<ul >";
list($cob,$dcs)=$lineArray;
$instArray=explode(",",$dcs);
foreach ($instArray as $instance){
list($ip,$port)=explode(":",$instance);
$instance=trim($instance);
#$tmpsock.="<tr><td><a target = '_blank' href=\"DCStrigger.php?ip=$ip&port=$port\">$instance</a></td>";
#### add status fetch logic here#################

$output1=shell_exec("sh /var/www/html//SO/SO/ToolOpsDashBoard/RETINS/MQ_scripts/DCS_UN_DASH/get_status_DC.sh $instance $region");
#print "strcase";
#print strcasecmp($output1,'down');
	if(strcasecmp($output1,'down') == 1)
	{
	$bgcolor="#f4241d";
	$downinst.="<tr><td><a target = '_blank' href=\"DCtrigger.php?ip=$ip&port=$port\">$instance</a></td><td bgcolor=\"$bgcolor\" >$output1</td></tr>";
	}
	else
	{
		$bgcolor="#eff0f2";
		$upinst.="<tr><td><a target = '_blank' href=\"DCtrigger.php?ip=$ip&port=$port\">$instance</a></td><td bgcolor=\"$bgcolor\" >$output1&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
	}
//$tmpsock.="<tr><td  bgcolor=\"$bgcolor\"><a target = '_blank' href=\"DCtrigger.php?ip=$ip&port=$port\">$instance</a></td>"; 
//$tmpsock.="<td bgcolor=\"$bgcolor\" >$output1</td></tr>";
}
$tmpsock=$tmpsock.$downinst.$upinst."</table>";
        if(strpos($tmpsock,'#f4241d') !== false)
        {
        $tmpdown=$tmpdown."
   <tr>
   <td>$cob</td>
   <td colspan=\"2\">$tmpsock</td>
   </tr>";
        }
        else
        {
        $tmpup=$tmpup."
   <tr>
   <td>$cob</td>
   <td colspan=\"2\">$tmpsock</td>
   </tr>";
        }
}
print $tmpdown;
print $tmpup;
print <<< HERE
</tbody>
</table>
<script src="jquery-1.12.4.js"></script>
     <script src="jquery.dataTables.min.js"></script>
     <script src="dataTables.bootstrap.min.js"></script>
      <link href="bootstrap.min.css" rel="stylesheet">
      <link href="dataTables.bootstrap.min.css" rel="stylesheet">
      <script>
$(document).ready(function() {
$('#example').DataTable({
"ordering": false // false to disable sorting (or any other option)
});
     $('#example1').DataTable({
"ordering": false // false to disable sorting (or any other option)
});
} );
</script>
HERE
?>
<style>
ul {list-style-type: none;}
</style>
