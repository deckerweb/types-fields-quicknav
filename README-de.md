# Types & Fields QuickNav

![Types & Fields QuickNav](assets/brand/github-banner-de-1280x640.png)

[English](README.md)

## Kurzvorstellung

Types & Fields QuickNav bringt die Verwaltung deiner Inhaltstypen und individuellen Felder in die WordPress-Toolbar. Feldgruppen, Inhaltstyp-Definitionen, Taxonomien und verfügbare Provider-Einstellungen sind damit an einem vertrauten Ort erreichbar.

Das Plugin gehört zur **QuickNav-Serie von deckerweb**: kleine, gezielte Werkzeuge, die den WordPress-Alltag erleichtern. Jedes QuickNav-Plugin verkürzt die Wege zu vorhandenen Funktionen und berücksichtigt dabei deren eigene Oberflächen und Berechtigungen.

Ob eigene Projekte oder wechselnde Kunden-Websites: Types & Fields QuickNav passt sich an die tatsächlich verfügbaren Provider an. Die Navigation lässt sich für jede Website konfigurieren – einschließlich der Frage, wer sie sehen darf.

## Version und Voraussetzungen

**1.0.0** · WordPress ab 7.1.2; PHP ab 8.2. Für die Provider-Navigation wird mindestens ein unterstützter Provider benötigt. Die Einstellungen bleiben auch ohne Provider erreichbar.

[Releases](https://github.com/deckerweb/types-fields-quicknav/releases) · [Docs / Doku](docs/README-de.md)

- [Kurzvorstellung](#kurzvorstellung)
- [Version und Voraussetzungen](#version-und-voraussetzungen)
- [Auf einen Blick](#auf-einen-blick)
- [Installation und erste Schritte](#installation-und-erste-schritte)
- [Funktionen und Grenzen](#funktionen-und-grenzen)
- [FAQ](#faq)
- [Änderungsverlauf](#änderungsverlauf)
- [Autor und Umfang](#autor-und-umfang)
- [Support und Sicherheit](#support-und-sicherheit)
- [Copyright und Lizenz](#copyright-und-lizenz)

## Auf einen Blick

### Featured Highlights

- **Ein Menü für deine Feld- und Inhaltstypen-Werkzeuge.** Feldgruppen, Inhaltstyp-Definitionen, Taxonomien und verfügbare Einstellungen direkt aus der WordPress-Toolbar erreichen.
- **Passt sich deiner Website an.** Erkennt aktive Provider und verfügbare Funktionen – auch bei mehreren kompatiblen Systemen auf derselben Website.
- **Für Kunden gezielt steuerbar.** Den gesamten QuickNav-Eintrag für ausgewählte Rollen oder einzelne Benutzer ausblenden.
- **Definitionen und Inhalte klar getrennt.** Die Verwaltungsnavigation bleibt übersichtlich. Inhaltslisten lassen sich bei Bedarf separat einschalten.
- **So viel Navigation, wie du brauchst.** Provider und einzelne Menüziele wählen; die Frontend-Toolbar optional hinzunehmen.

### Weitere Funktionen

- Navigation für ACF Free/Pro, Meta Box mit verfügbaren Erweiterungen, JetEngine, ACPT Free/Pro und Pods.
- Zusätzliche modulare Navigation für die Toolset-Suite und Unterstützung für Secure Custom Fields.
- Unabhängige Provider-Erkennung; mehrere kompatible Provider können gleichzeitig erscheinen.
- Optionale Links für ACF Extended, Better Search und Font Awesome Field; ACF Extended benötigt ACF Pro.
- Einzelne Schalter für Provider und Menüpunkte, klare Aktivitäts- und Verfügbarkeitsanzeigen.
- Rollen- und Benutzersperren für den gesamten Toolbar-Eintrag auf jeder Website.
- Getrennte Inhaltslisten und Frontend-Toolbar, beide standardmäßig ausgeschaltet.
- Einstellungen je Website, Multisite-Unterstützung und Berechtigungsprüfung für jedes Ziel.

## Installation und erste Schritte

Das installierbare Plugin-ZIP unter [Releases](https://github.com/deckerweb/types-fields-quicknav/releases) herunterladen. In WordPress unter Plugins → Plugin hinzufügen → Plugin hochladen installieren und aktivieren. Anschließend Einstellungen → Types & Fields QuickNav öffnen und die Provider-Menüs für diese Website auswählen. Add-on-Links, Frontend-Navigation und Inhaltslisten sind optional und zunächst ausgeschaltet.

## Funktionen und Grenzen

### Ein vertrauter Ort für unterschiedliche Provider

Feldgruppen, Inhaltstyp-Definitionen, Taxonomien und verfügbare Einstellungen sind in der Toolbar nach Provider gegliedert. Provider-Karten und Statusanzeigen machen die Konfiguration übersichtlich.

### Die Navigation je Website bestimmen

Provider und Menüpunkte einzeln einschalten. Add-ons haben eigene Schalter; Frontend-Toolbar und Inhaltslisten werden ausdrücklich aktiviert. Rollen- und Benutzersperren blenden bei Bedarf das gesamte Menü aus.

### Definitionen und Inhalte haben eigene Wege

Provider-Zweige führen zu Verwaltung und Definitionen. Die optionalen Inhaltslisten öffnen die eigentlichen Inhalte. Interne Feldgruppen, Templates und Formulardefinitionen bleiben aus diesen Inhaltslisten ausgeschlossen.

### Vorhandene Berechtigungen bleiben maßgeblich

Jedes Ziel wird gegen seine registrierte Berechtigung geprüft. Toolset Access und andere Provider-Berechtigungssysteme bestimmen weiterhin den Zugang zu ihren eigenen Seiten.

### Auf Navigation konzentriert

Die Toolbar ergänzt keine eigenen Datenbanktabellen, REST-Endpunkte oder Telemetrie. Das kleine Stylesheet und der Dialog-Controller laden nur auf der QuickNav-Einstellungsseite. Netzwerkaufrufe mitgelieferter Komponenten sind gesondert dokumentiert.

### Website-Zustand: kompakte Diagnose

Unter Werkzeuge → Website-Zustand → Bericht zeigt Types & Fields QuickNav eine kompakte Zusammenfassung: Version, erkannte Provider, eingeschaltete Provider und Add-ons, Frontend-Navigation, Inhaltslisten sowie eingerichtete Rollen- und Benutzersperren als Ja/Nein. Keine Rollennamen, Benutzernamen oder Benutzer-IDs werden ausgegeben. Der Abschnitt erzeugt keine Gesundheitswarnungen und ist nur mit der WordPress-Berechtigung für den Website-Zustand zugänglich.

Die Verfügbarkeit hängt vom aktiven Provider, eingeschalteten Modulen, registrierten Verwaltungsmenüs und den Berechtigungen des aktuellen Benutzers ab. ACF und Secure Custom Fields teilen Laufzeitkennungen; nur die tatsächlich geladene Implementierung erhält einen Zweig. Menübasierte Ziele einschließlich der Toolset-Seiten erscheinen nur im Verwaltungsbereich. Die ACF-Add-on-Navigation ist auf ACF beschränkt. ACF Extended Basic ist geprüft; die Pro-Ausgabe ist nicht verifiziert. QuickNav verlinkt vorhandene Verwaltungsseiten und führt keine Migrationen oder Provider-Konfiguration durch. Vollständige Editor-, Kartendienst-, Lizenz-, Checkout- und Migrationsabläufe gehören nicht zum Navigationstest. [Provider-Abdeckung und Prüfgrenzen](docs/PROVIDERS-de.md).

## FAQ

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

[FAQ by topic / Fragen nach Themen](docs/FAQ-de.md)

## Änderungsverlauf

### 1.0.0 · 2026-10-18

- **Neu:** Konfigurierbare Toolbar-Navigation für ACF, Meta Box, JetEngine, ACPT und Pods sowie zusätzliche Unterstützung für Toolset und Secure Custom Fields.
- **Neu:** Navigation für ausgewählte ACF-Add-ons, getrennte optionale Inhaltslisten und eine optionale Frontend-Toolbar.
- **Neu:** Provider-Schalter je Website, Rollen- und Benutzersperren, zugängliche Einstellungskarten und lokaler Änderungsverlauf.

## Autor und Umfang

David Decker – DECKERWEB · QuickNav. Navigation zu vorhandenen Verwaltungsoberflächen.

## Support und Sicherheit

Sicherheitslücken vertraulich über [GitHub Security Advisories](https://github.com/deckerweb/types-fields-quicknav/security/advisories/new) melden. Plugin-/Provider-Versionen, Schritte zur Reproduktion und Auswirkungen angeben. Keine Zugangsdaten oder Details ungepatchter Sicherheitslücken in öffentlichen Issues veröffentlichen.

[DECKERWEB](https://github.com/deckerweb) · [Ko-fi](https://ko-fi.com/deckerweb)

## Copyright und Lizenz

Copyright © 2026 David Decker – DECKERWEB. GPL-2.0-or-later.

Mitgeliefert: deckerweb Library 1.0.0 ([source](https://github.com/deckerweb/deckerweb-plugin-library)) und deckerweb Updater 2.1.0, David Decker – DECKERWEB, GPL-2.0-or-later. Keine Provider-Quelltexte enthalten.

Footer presentation adapted from deckerweb Admin Footer v1 in [Multisite Toolbar Additions](https://github.com/deckerweb/multisite-toolbar-additions), David Decker – DECKERWEB, GPL-2.0-or-later. / Footer-Gestaltung auf Grundlage derselben Komponente.

Inter lettering is outlined in the artwork / Inter-Schrift als Pfade in den Grafiken: SIL OFL 1.1. [License / Lizenz](assets/brand/Inter-OFL-1.1.txt).
