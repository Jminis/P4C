#!/bin/sh
sudo cp -rf * /home/minishell/Desktop/P4C

cd /home/minishell/Desktop/P4C
DATE=$(date +"%Y%m%d")

git add .
git commit -m "$DATE"
git push
