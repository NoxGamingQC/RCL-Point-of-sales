@echo off

REM if [%1]==[] (
REM     goto PreSilentCall
REM ) else (
REM     goto SilentCall
REM )

REM :PreSilentCall
REM Insert code here you want to have happen BEFORE this same .bat file is called silently
REM such as setting paths like the below two lines

REM set WorkingDirWithSlash=%~dp0
REM set WorkingDirectory=%WorkingDirWithSlash:~0,-1%

REM below code will run this same file silently, but will go to the SilentCall section
REM cd C:\Windows\System32
REM if exist C:\Windows\Temp\invis.vbs ( del C:\Windows\Temp\invis.vbs /f /q )
REM echo CreateObject("Wscript.Shell").Run "C:\POS\start.bat " ^& WScript.Arguments(0), 0, False > C:\Windows\Temp\invis.vbs
REM wscript.exe C:\Windows\Temp\invis.vbs Initialized
REM if %ERRORLEVEL%==0 (
REM     echo Successfully started SilentCall code. This command prompt can now be exited.
REM     goto Exit
REM )


REM :SilentCall
cd %WorkingDirectory%
REM start cmd /c "php artisan schedule:work"
REM net stop http /y
taskkill /IM php.exe /F >nul 2>&1
php artisan serve --host 192.168.2.13 --port 80

:EXIT
