@echo on

echo Mise a jour des fichiers du site...
git pull origin master
echo Mise a jour des fichiers du site complete.



echo Installations des dependances...
start cmd /c "yarn install"
echo Dependances intalles


echo Generation du design du site à partir des fichiers mis à jour...
start cmd /c "yarn run dev"
echo Generation complete.

echo Une fois tout les autres terminals fermés, la mise à jour sera complété.
pause