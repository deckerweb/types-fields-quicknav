# Provider und Navigationsziele

[Dokumentation](README-de.md) · [English](PROVIDERS.md)

Alle Ziele setzen aktive Funktionen und ausreichende native Berechtigungen voraus. Die folgende Übersicht ist kein Versprechen, dass jede Edition jede Funktion enthält.

| Provider | Mögliche Ziele |
|---|---|
| ACF Free / Pro | Feldgruppen, Inhaltstypen, Taxonomien und Optionsseiten-Verwaltung, soweit vorhanden. |
| Meta Box | Feldgruppen, Inhaltstypen, Taxonomien, Optionsseiten, Beziehungen, Modelle, Views, Templates, Werkzeuge und relevante Erweiterungs-/Einstellungsseiten, soweit tatsächlich vorhanden. |
| JetEngine | Meta-Boxen, Inhaltstypen, Taxonomien, Optionsseiten und Provider-Einstellungen. |
| ACPT Free / Pro | Verfügbare Feld-, Inhaltstyp-, Taxonomie- und Optionsdefinitionen sowie Provider-Einstellungen. |
| Pods | Pod- und Feldverwaltung sowie verfügbare Provider-Einstellungen. |
| Toolset suite | Types-Feldgruppen, Inhaltstypen, Taxonomien und Beziehungen; Views-/Blocks-Templates und Archive; Forms; Layouts; Access; Module Manager; Maps; bedingt verfügbare Commerce-/WooCommerce-Einstellungen; Import/Export. |
| Secure Custom Fields | Verfügbare ACF-kompatible Definitionsseiten; getrennte Erkennung gegenüber ACF. |

## Meta Box

Free, Lite, All-in-One und Einzelmodule werden anhand ihrer tatsächlichen Funktionen behandelt. Ein erkanntes Paket schaltet keine pauschalen Premium-Links frei. Offizielle Meta-Box-Erweiterungen ohne eigene relevante Verwaltungsseite erhalten keinen künstlichen Toolbar-Eintrag. Template-Verwaltung erscheint nur bei vorhandener Oberfläche.

## Toolset

Toolset ist die Suite; Types selbst verwaltet bereits Inhaltstypen und Felder. QuickNav fasst die verfügbaren Suite-Module in einem Zweig zusammen. Views und Blocks werden als alternative Laufzeitvarianten behandelt. Maps und WooCommerce Blocks können Tabs der Toolset-Einstellungen sein. Forms Commerce registriert seine Seite bedingt. QuickNav prüft die zugehörigen Laufzeitmerkmale und Berechtigungen. Das alte Paket Layouts Migration 1.0 enthält mit PHP 8 unvereinbare Twig-Syntax; sein Link wird deshalb auf der benötigten PHP-Version nicht angeboten.

## Ausgewählte ACF-Erweiterungen

- **ACF Extended (Basic):** verfügbare Verwaltungsziele; benötigt in der geprüften aktuellen Variante ACF Pro. Keine pauschale Freigabe für Extended Pro.
- **ACF: Better Search:** eigene Einstellungsseite.
- **ACF Font Awesome Field:** vorhandene Einstellungsseite.

Jede Erweiterung hat einen eigenen, standardmäßig ausgeschalteten Schalter. Keine allgemeine Kompatibilitätszusage dieser Add-ons mit Secure Custom Fields.

## Grenzen

Provider bleiben für Lizenzen, Daten, Editor-Funktionen und Abhängigkeiten zuständig. Die Prüfung der QuickNav-Navigation bescheinigt keine vollständige Funktion von Zahlungsabläufen, Karten, Migrationen oder sämtlichen Hersteller-Editoren. Unbekannte zukünftige Menüänderungen können Adapter-Anpassungen erfordern. ACF und Secure Custom Fields teilen APIs und sollten nicht gleichzeitig geladen werden.
