@echo on

echo Mise à jour des fichiers du site...
git pull origin master
echo Mise à jour des fichiers du site complété.

echo Mise à jour des dépendance NPM
yarn install
echo Mise à jour des dépendance NPM complété.

echo Génération du désign du site à partir des fichiers mis à jour...
npm run dev
echo Génération complété.

pause