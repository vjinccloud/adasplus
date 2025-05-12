echo '開始編譯前端'
echo "#######################################################"
echo '上傳資源檔案到正式機...'
scp -r ./* vic@ap-bravo:/var/vhost/adasplus/.
echo '完成.'
