# Einstellungen und täglicher Einsatz

[Dokumentation](README-de.md) · [English](SETTINGS.md)

## Erste Schritte

1. Einen unterstützten Provider und Types & Fields QuickNav aktivieren.
2. **Einstellungen → Types & Fields QuickNav** öffnen. Der Toolbar-Link heißt **QuickNav Einstellungen**.
3. Über die Sprunglinks zu Provider und Navigation, Add-ons oder Allgemein wechseln.
4. Provider und einzelne Ziele auswählen und speichern.

Die Status-Blase „Aktiv“ beschreibt das erkannte Plugin. Die Verfügbarkeit beschreibt zugängliche Navigationsziele. Ein Plugin kann aktiv sein, ohne ein zugängliches Ziel bereitzustellen. Mögliche Gründe sind fehlende Module, fehlende Verwaltungsseiten oder unzureichende Berechtigungen. Gespeicherte Einstellungen bleiben erhalten, wenn ein Modul vorübergehend fehlt.

## Provider-Karten und Add-ons

Der Provider-Schalter steuert den jeweiligen Toolbar-Zweig. Unter „Menüpunkte“ lassen sich einzelne Ziele wählen. Nicht verfügbare Ziele erzeugen keine ungültigen Links.

Der eigene Add-on-Bereich zeigt den zugehörigen Provider und den Status jeder Erweiterung. Die ausgewählten ACF-Add-ons sind standardmäßig ausgeschaltet. Ihre Links setzen den Add-on-Schalter, den Provider-Schalter, einen aktiven kompatiblen Provider und ausreichende Berechtigungen voraus. Die Schalter aktivieren oder konfigurieren die Erweiterung selbst nicht.

## Allgemein

Die Frontend-Toolbar-Navigation ist standardmäßig ausgeschaltet. Ziele aus registrierten Admin-Menüs stehen im Verwaltungsbereich zur Verfügung; im Frontend erscheinen geprüfte Definitions-Inhaltstypen und optionale Inhaltslisten.

Inhaltslisten sind ein eigener, standardmäßig ausgeschalteter Bereich. Sie öffnen Inhalte registrierter eigener Inhaltstypen statt ihrer Provider-Definitionen. Interne Definitions-Inhaltstypen werden ausgeschlossen.

## Rollen oder einzelne Benutzer ausschließen

Unter Allgemein Rollen auswählen und/oder exakte WordPress-Benutzernamen mit Komma oder Zeilenumbruch getrennt eingeben. Eine passende Rolle oder ein ausgewählter Benutzer blendet den gesamten QuickNav-Toolbar-Eintrag einschließlich Einstellungslink aus. Für Administratoren gibt es keine Ausnahme. Bei mehreren Rollen genügt eine ausgeschlossene Rolle.

Diese Sperren betreffen nur die Navigation dieses Plugins. Sie entziehen keine Provider-Berechtigungen und verbergen keine anderen WordPress-Menüs. Die Einstellungsseite bleibt für Konten mit `manage_options` erreichbar, damit sich Sperren korrigieren lassen. Unbekannte Benutzernamen erzeugen eine Fehlermeldung; die bisherige Benutzerauswahl bleibt erhalten. In Multisite gelten Einstellungen und Sperren je Website.

## Deinstallation

Standardmäßig bleiben Einstellungen erhalten. Wer die QuickNav-Option dieser Website löschen möchte, aktiviert vor der Deinstallation die ausdrückliche Löschoption. Provider-Daten und Inhalte werden niemals gelöscht. Für gemeinsame Daten der deckerweb Library gelten deren eigene Einstellungen.
