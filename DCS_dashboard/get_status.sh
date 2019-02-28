#/bin/sh
instance=$1
env=$2
sstatus=`cat /var/www/html/SO/SO/ToolOpsDashBoard/RETINS/MQ_scripts/DCS_UN_DASH//DCS_instance_status_${env}.txt | grep $instance | cut -d "," -f2 | uniq`
if [ -z "$sstatus" ];then
echo "NA"
else
echo "$sstatus";
fi


