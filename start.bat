@echo off

if [%1]==[] (
    goto PreSilentCall
) else (
    goto SilentCall
)

:PreSilentCall
REM Insert code here you want to have happen BEFORE this same .bat file is called silently
REM such as setting paths like the below two lines

set WorkingDirWithSlash=%~dp0
set WorkingDirectory=%WorkingDirWithSlash:~0,-1%

REM below code will run this same file silently, but will go to the SilentCall section
cd C:\Windows\System32
if exist C:\Windows\Temp\invis.vbs ( del C:\Windows\Temp\invis.vbs /f /q )
echo CreateObject("Wscript.Shell").Run "C:\POS\start.bat " ^& WScript.Arguments(0), 0, False > C:\Windows\Temp\invis.vbs
wscript.exe C:\Windows\Temp\invis.vbs Initialized
if %ERRORLEVEL%==0 (
    echo Successfully started SilentCall code. This command prompt can now be exited.
    goto Exit
)


:SilentCall
cd %WorkingDirectory%
REM start cmd /c "php artisan schedule:work"
:retry
git pull origin master
for /f "tokens=5" %%p in ('netstat -ano ^| findstr ":80"') do (
    taskkill /PID %%p /F >nul 2>&1
)
php artisan serve --host 192.168.2.13 --port 80
timeout /t 3 >nul
netstat -ano | findstr ":80" >nul
if errorlevel 1 (
    echo [Error] Failed to bind port 80. Retrying in 15 seconds...
    timeout /t 15 >nul
    goto retry
)

:EXIT
