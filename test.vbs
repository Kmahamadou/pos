Dim WinScriptHost
Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "pointDeVent.bat" & Chr(34), 0
WScript.Sleep 5000
WinScriptHost.Run Chr(34) & "lanceur.bat" & Chr(34), 0
Set WinScriptHost = Nothing