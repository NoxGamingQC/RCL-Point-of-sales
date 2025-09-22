@echo on

echo Mise à jour des fichiers du site...
echo:
git pull origin master
echo:
echo Mise à jour des fichiers du site complété.

echo Mise à jour des dépendance NPM
echo:
yarn install
echo:
echo Mise à jour des dépendance NPM complété.

echo Génération du désign du site à partir des fichiers mis à jour...
echo:
npm run dev
echo:
echo Génération complété.
echo:

echo Mise à jour complété. (Si des erreurs sont survenus, merci d'en aviser Service Tech. J.Bédard)

pause