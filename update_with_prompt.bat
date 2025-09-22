@echo on

color 0A
echo Mise à jour des fichiers du site...
color 0F
echo :
git pull origin master
echo :
color 0A
echo Mise à jour des fichiers du site complété.

echo Mise à jour des dépendance NPM
color 0F
echo :
yarn install
echo :
color 0A
echo Mise à jour des dépendance NPM complété.

echo Génération du désign du site à partir des fichiers mis à jour...
color 0F
echo :
npm run dev
echo :
color 0A
echo Génération complété.
echo :

color 0E
echo Mise à jour complété. (Si des erreurs sont survenus, merci d'en aviser Service Tech. J.Bédard)

pause

exit