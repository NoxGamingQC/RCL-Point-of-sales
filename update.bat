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
git pull origin master


:Exit