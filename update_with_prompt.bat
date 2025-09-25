@echo off

echo Mise a jour des fichiers du site...
git pull origin master
echo Mise a jour des fichiers du site complete.



echo Installations des dependances...
start /wait cmd /c "composer install"
start /wait cmd /c "yarn install"
echo Dependances intalles


echo Generation du design du site a partir des fichiers mis a jour...
start /wait cmd /c "yarn run dev"
echo Generation complete.


echo Mise a jour complete.
pause