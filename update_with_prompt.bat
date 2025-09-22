@echo on

SETLOCAL EnableDelayedExpansion
for /F "tokens=1,2 delims=#" %%a in ('"prompt #$H#$E# & echo on & for %%b in (1) do     rem"') do (
  set "DEL=%%a"
)

call :colorEcho 0a "Mise à jour des fichiers du site..."
echo.
echo:
git pull origin master
echo:
call :colorEcho 0a "Mise à jour des fichiers du site complété."
echo.
echo:

call :colorEcho 0a "Mise à jour des dépendance NPM"
echo.
echo:
yarn install
call :colorEcho 0a "Mise à jour des dépendance NPM complété."
echo.
echo:

call :colorEcho 0a "Génération du désign du site à partir des fichiers mis à jour..."
echo.
npm run dev
call :colorEcho 0a "Génération complété."
echo.

echo:
call :colorEcho 0e "Mise à jour complété. (Si des erreurs sont survenus, merci d'en aviser Service Tech. J.Bédard)"
echo.
echo:

pause
