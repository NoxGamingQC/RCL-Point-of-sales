@echo on

cd %WorkingDirectory%
git pull origin master
yarn install
npm run dev

echo Mise à jour du site et de la caisse complété. Si des erreurs apparaisse plus haut, merci de contacter Service Tech. J.Bédard

:Exit