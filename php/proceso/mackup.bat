@echo off

title Creando BackUp base de datos MySQL
color 0a

set FECHA_ACTUAL=%DATE%
set HORA_ACTUAL=%TIME%

set ANO=%FECHA_ACTUAL:~6,4%
set MES=%FECHA_ACTUAL:~3,2%
set DIA=%FECHA_ACTUAL:~0,2%

set HORA=%HORA_ACTUAL:~0,2%
set MINUTOS=%HORA_ACTUAL:~3,2%
set SEGUNDOS=%HORA_ACTUAL:~6,2%
set CENTESIMAS=%HORA_ACTUAL:~9,2%


rem Si la hora tiene un sólo dígito, reemplazamos el espacio inicial por cero
set HORA=%HORA: =%
if %HORA% LSS 10 set HORA=0%HORA%



rem Selecciona la base de datos
rem VARIALES DEL PROGRAMA

if not exist D:\BACKUP\ (
      mkdir D:\BACKUP\
)

set foolder="D:\BACKUP\"
set db=scistem
set backupDir="D:\BACKUP\%ANO%%MES%%DIA%_%HORA%%MINUTOS%%SEGUNDOS%"
set dbdir="C:\AppServ\MySQL\data\%db%"

mkdir %backupDir%

rem set /p us=Escriba el usuario de mysql:
set us=root
set pa=mysql
rem set /p pa=Escriba la contraseña de mysql:

rem set /p db=”y Ahora el nombre de la base de datos:

echo.
echo ######################################
echo .
echo ##### Cerrando el servicio MySQL #####
echo.
echo ######################################

rem cd C:\AppServ\MySQL\bin\mysqladmin.exe -u root --password=%pa% shutdown

c:\AppServ\MySQL\bin\mysqldump.exe --host=localhost --user=%us% --password=%pa% %db% > %backupDir%\scistem_backup.sql

net stop mysql



ECHO.
echo COPIANDO ARCHIVOS ....
echo.
echo %dbdir% a %backupDir%
ECHO.

xcopy %dbdir% %backupDir%\%db% /E /I


echo.
echo.
echo.
echo ######################################
echo .
echo ##### Abriendo el servicio MySQL #####
echo.
echo ######################################

net start mysql

echo.
echo.
echo.
echo.
echo ##### BACKUP COMPLETADO #####



exit