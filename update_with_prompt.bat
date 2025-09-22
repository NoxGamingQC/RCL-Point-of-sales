@echo on

echo Mise a jour des fichiers du site...
git pull origin master
echo Mise a jour des fichiers du site complete.

echo Generation du design du site à partir des fichiers mis à jour...
@echo off
npm run dev
echo Generation complete.
@echo on

pause