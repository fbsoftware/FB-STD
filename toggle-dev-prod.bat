@echo off
setlocal EnableDelayedExpansion

:: === CONFIGURAZIONE ===
set PROJECT=C:\xampp\htdocs\FB-STD
set DEV=%PROJECT%\user.dev.ini
set PROD=%PROJECT%\user.prod.ini
set ACTIVE=%PROJECT%\user.ini

:: === CONTROLLO FILE ===
if not exist "%DEV%" (
    echo ERRORE: File user.dev.ini non trovato!
    pause
    exit /b
)

if not exist "%PROD%" (
    echo ERRORE: File user.prod.ini non trovato!
    pause
    exit /b
)

echo -----------------------------------------------------
echo Seleziona la modalita':
echo 1 = SVILUPPO (user.dev.ini)
echo 2 = PRODUZIONE (user.prod.ini)
echo -----------------------------------------------------
echo.

set /P choice=Inserisci 1 o 2: 

if "%choice%"=="1" goto dev
if "%choice%"=="2" goto prod

echo Scelta non valida.
pause
exit /b

:dev
echo -----------------------------------------------------
echo Modalita' attuale: SVILUPPO
echo Passaggio a SVILUPPO...
echo -----------------------------------------------------
copy /Y "%DEV%" "%ACTIVE%" >nul
goto done

:prod
echo -----------------------------------------------------
echo Modalita' attuale: PRODUZIONE
echo Passaggio a PRODUZIONE...
echo -----------------------------------------------------
copy /Y "%PROD%" "%ACTIVE%" >nul
goto done

:done
echo.
echo Operazione completata.
echo.
pause
exit /b
