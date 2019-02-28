#/bin/sh
instance=$1
sstatus=`cat /var/www/html/SO/SO/ToolOpsDashBoard/RETINS/MQ_scripts/DCS_UN_DASH/DCSBufferCheck/DCS_output_status.txt | grep $instance | cut -d ":" -f3 | uniq`
if [ -z "$sstatus" ];then
echo "NA"
else
echo "$sstatus";
fi


