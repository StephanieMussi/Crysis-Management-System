@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop


"C:\New folder\mysql\bin\mysqld" --defaults-file="C:\New folder\mysql\bin\my.ini" --standalone --console
if errorlevel 1 goto error
goto finish

:stop
cmd.exe /C start "" /MIN call "C:\New folder\killprocess.bat" "mysqld.exe"

if not exist "C:\New folder\mysql\data\%computername%.pid" goto finish
echo Delete %computername%.pid ...
del "C:\New folder\mysql\data\%computername%.pid"
goto finish


:error
echo MySQL could not be started

:finish
exit
