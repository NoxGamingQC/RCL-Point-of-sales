@echo on

echo Mise a jour des fichiers du site...
git pull origin master
echo Mise a jour des fichiers du site complete.

start cmd /k "yarn install"


echo Generation du design du site à partir des fichiers mis à jour...
@echo off
start cmd /k "yarn run dev"
echo Generation complete.
@echo on

pause