@echo on


cecho {0A}Mise à jour des fichiers du site...{#}{\n}
git pull origin master
cecho {0A}Mise à jour des fichiers du site complété.{#}{\n}

cecho {0A}Mise à jour des dépendance NPM{#}{\n}
yarn install
cecho {0A}Mise à jour des dépendance NPM complété.{#}{\n}

cecho {0A}Génération du désign du site à partir des fichiers mis à jour...{#}{\n}
npm run dev
cecho {0A}Génération complété.{#}{\n}

cecho {0A}Mise à jour complété. (Si des erreurs sont survenus, merci d'en aviser Service Tech. J.Bédard){#}{\n}

pause

exit