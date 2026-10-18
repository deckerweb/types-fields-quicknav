# Fragen nach Themen

[Dokumentation](README-de.md) · [English](FAQ.md)

## Häufige Fragen

### Welche Provider werden unterstützt?

ACF Free/Pro, Meta Box mit verfügbaren Erweiterungen, JetEngine, ACPT Free/Pro und Pods. Toolset und Secure Custom Fields werden ebenfalls unterstützt. Mehrere kompatible Provider können gleichzeitig erscheinen.

### Ersetzt oder verändert QuickNav meine Provider?

Das Plugin öffnet vorhandene Verwaltungsseiten. Felddefinitionen, Inhalte, Rollen und Provider-Konfiguration bleiben unter der Kontrolle des jeweiligen Providers.

### Warum fehlt ein Toolbar-Eintrag?

Der benötigte Provider oder ein Modul ist möglicherweise inaktiv, das Verwaltungsmenü fehlt oder der aktuelle Benutzer hat keine ausreichende Berechtigung. Provider-, Menüpunkt- und Add-on-Schalter sowie Rollen- und Benutzersperren dieser Website prüfen.

### Wie aktiviere ich die ACF-Add-ons?

Unter Einstellungen → Types & Fields QuickNav → Add-ons → Erweiterungen für ACF die gewünschte Erweiterung einschalten. ACF Extended benötigt ACF Pro. Die Aktivität eines Add-ons und seine Anzeige durch QuickNav sind unabhängig voneinander.

### Kann ich das Menü für Kundenrollen oder einzelne Benutzer ausblenden?

Ja. Unter Allgemein die gesperrten Rollen auswählen oder die genauen WordPress-Benutzernamen eingeben. Jeder passende Rollen- oder Benutzereintrag blendet das gesamte QuickNav-Toolbar-Menü im Verwaltungsbereich und Frontend aus. Berechtigte Administratoren behalten den Zugang über das WordPress-Menü Einstellungen.

### Was ist im Frontend und in Multisite verfügbar?

Die Frontend-Navigation ist zunächst ausgeschaltet. Nach Aktivierung zeigt sie geprüfte Definitions-Inhaltstypen und optionale Inhaltslisten; menübasierte Provider-Seiten bleiben auf den Verwaltungsbereich beschränkt. Jede Multisite-Website erhält eigene Einstellungen und Sperren.

### Was geschieht bei Deaktivierung oder Deinstallation?

Einstellungen bleiben standardmäßig erhalten. Jede Website kann ihre eigenen QuickNav-Einstellungen bei der Deinstallation ausdrücklich löschen lassen. Inhalte und Daten der Provider werden nicht entfernt. Gemeinsame Library-Daten folgen den eigenen Einstellungen und Letzt-Host-Regeln.

## Einrichtung und Kompatibilität

### Kann ich mehrere Provider nutzen?

Ja, kompatible aktive Provider erhalten eigene Zweige. ACF und den Fork mit gemeinsam genutzter API nicht gleichzeitig laden.

### Bedeutet Meta Box Lite automatisch Premium-Funktionen?

Nein. Jede verfügbare Funktion wird unabhängig geprüft, auch bei Einzelmodulen und All-in-One.

## Navigation und Erweiterungen

### Warum hat ein aktives Add-on keinen Link?

Aktivität und Navigationsverfügbarkeit sind getrennt. Benötigter Provider, Verwaltungsseite und Berechtigung müssen vorhanden sein.

### Startet ein Migrationslink die Migration?

Nein. Er öffnet die Hersteller-Verwaltungsseite. Weitere Aktionen steuert ausschließlich der Provider.

### Wo liegen Toolset Maps und WooCommerce-Einstellungen?

Die geprüften Module verwenden teilweise Tabs der Toolset-Einstellungen. QuickNav verlinkt den verfügbaren Tab, wenn Laufzeit- und native Berechtigungsprüfung erfolgreich sind.

## Zugriff und Website-Geltung

### Was passiert bei einem ausgeschlossenen Administrator?

Sein gesamter QuickNav-Eintrag verschwindet. Über das WordPress-Einstellungsmenü bleibt die Seite für berechtigte Konten mit manage_options erreichbar.

### Kann QuickNav Provider-Zugriff gewähren?

Nein. QuickNav vergibt keine Provider-Berechtigungen. Rollen- und Benutzersperren können nur die eigene Toolbar zusätzlich einschränken.

### Gelten Einstellungen netzwerkweit?

Nein. Jede Website verwaltet eigene Einstellungen einschließlich Rollen- und Benutzersperren.

## Updates und Daten

### Werden automatische Updates aktiviert?

Nein. Der mitgelieferte Updater berücksichtigt veröffentlichte GitHub-Releases im WordPress-Updateablauf. Entwürfe sind ausgeschlossen; die Installation schaltet automatische Updates nicht ein.

### Sind Premium-Pakete enthalten?

Nein. Unterstützte Provider und Lizenzen beziehst du bei ihren Herstellern.

### Wo stehen Datenhaltung und Deinstallationsregeln?

Unter [Daten und Datenschutz](DATA-de.md) und [Einstellungen](SETTINGS-de.md).

