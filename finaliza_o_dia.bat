echo "Finalizando o git...Boa tarde !!!"
git add -A
git commit -m "Atualizacao $(date +"%d-%m-%y-%H-%M")"
git push origin master
sleep 10
