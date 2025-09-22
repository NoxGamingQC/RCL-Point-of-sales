@echo on

echo Mise a jour des fichiers du site...
git pull origin master
echo Mise a jour des fichiers du site complete.

echo Generation du design du site à partir des fichiers mis à jour...
npm run dev
echo Generation complete.

echo Mise à jour des dépendance NPM
yarn install
echo Mise à jour des dépendance NPM complété.

pause