# Types & Fields QuickNav

![Types & Fields QuickNav](assets/brand/github-banner-en-1280x640.png)

[Deutsch](README-de.md)

## About

Types & Fields QuickNav brings the administration of your content types and custom fields into the WordPress toolbar. Reach field groups, post type definitions, taxonomies and available provider settings from one familiar place.

It is part of the **deckerweb QuickNav series**: small, focused tools that make everyday WordPress administration easier. Each QuickNav plugin shortens the path to existing tools while respecting their own interfaces and permissions.

Whether you maintain your own projects or move between client websites, Types & Fields QuickNav adapts to the providers that are actually available. Configure the navigation for each website and decide who sees it.

## Version and requirements

**1.0.0** · WordPress 7.1.2 or newer; PHP 8.2 or newer. At least one supported provider is needed for provider navigation. Settings remain accessible without a provider.

[Releases](https://github.com/deckerweb/types-fields-quicknav/releases) · [Docs / Doku](docs/README.md)

- [About](#about)
- [Version and requirements](#version-and-requirements)
- [At a glance](#at-a-glance)
- [Installation and first steps](#installation-and-first-steps)
- [Features and limitations](#features-and-limitations)
- [FAQ](#faq)
- [Changelog](#changelog)
- [Author and scope](#author-and-scope)
- [Support and security](#support-and-security)
- [Copyright and license](#copyright-and-license)

## At a glance

### Featured Highlights

- **One menu for your types and fields tools.** Reach field groups, type definitions, taxonomies and available settings directly from the WordPress toolbar.
- **Adapts to your website.** Detects active providers and available features, including several compatible systems on one website.
- **Control visibility for client work.** Hide the entire QuickNav entry from selected roles or individual users.
- **Keep definitions and content separate.** Maintain clear administration navigation; enable a separate content-list branch when needed.
- **Choose the navigation you need.** Select providers and individual destinations; optionally include the frontend toolbar.

### More features

- Navigation for ACF Free/Pro, Meta Box with available extensions, JetEngine, ACPT Free/Pro and Pods.
- Additional modular Toolset suite navigation and Secure Custom Fields support.
- Independent provider detection; several compatible providers can appear together.
- Optional ACF Extended, Better Search and Font Awesome Field links; ACF Extended requires ACF Pro.
- Individual provider and destination switches, clear activity and availability badges.
- Role and individual user exclusions for the complete toolbar entry on each website.
- Separate content lists and frontend toolbar, both off by default.
- Site-scoped settings, multisite support and permission checks for each destination.

## Installation and first steps

Download the installable plugin ZIP from [Releases](https://github.com/deckerweb/types-fields-quicknav/releases). In WordPress, open Plugins → Add Plugin → Upload Plugin, upload the ZIP and activate it. Then open Settings → Types & Fields QuickNav. Select the provider menus for this website. Add-on links, frontend navigation and content lists are optional and initially off.

## Features and limitations

### One familiar place for different providers

Field groups, post type definitions, taxonomies and available settings are grouped by provider in the toolbar. Provider cards and status badges make the configuration easy to scan.

### Choose the navigation for each website

Enable individual providers and menu items. Add-on switches are separate, and the frontend toolbar and content lists are explicit opt-ins. Role and user exclusions hide the complete menu when needed.

### Definitions and content have separate paths

Provider branches lead to administration and definitions. Optional Content lists open the actual content. Internal field groups, templates and form definitions stay out of that content list.

### Works with the permissions you already use

Each destination is checked against its registered capability. Toolset Access and other provider permission systems remain in charge of their own screens.

### Focused on navigation

The toolbar adds no custom database tables, REST endpoints or telemetry. The small stylesheet and dialog controller load only on the QuickNav settings page. Bundled component network requests are documented separately.

Availability depends on the active provider, enabled modules, native administration menus and the current user’s permissions. ACF and Secure Custom Fields share runtime identifiers; only the implementation actually loaded gets a branch. Menu-based destinations, including Toolset pages, are administration-only. ACF add-on navigation is limited to ACF. ACF Extended Basic is checked; its Pro edition is not verified. QuickNav links to existing administration pages and does not migrate data or configure the providers. Full editor, map service, licensing, checkout and migration workflows are outside the navigation test scope. [Provider coverage and test boundaries](docs/PROVIDERS.md).

## FAQ

### Which providers are supported?

ACF Free/Pro, Meta Box with available extensions, JetEngine, ACPT Free/Pro and Pods. Toolset and Secure Custom Fields are also supported. Several compatible providers can appear together.

### Does QuickNav replace or modify my providers?

It opens existing administration pages. Field definitions, content, roles and provider configuration remain under the provider’s control.

### Why is a toolbar entry missing?

The required provider or module may be inactive, its admin menu unavailable, or the current user may lack permission. Check the provider, destination and add-on switches, as well as role and user exclusions for this website.

### How do I enable ACF add-ons?

Open Settings → Types & Fields QuickNav → Add-ons → Extensions for ACF. Enable the desired add-on. ACF Extended requires ACF Pro. An active add-on and its QuickNav visibility are independent states.

### Can I hide the menu from client roles or individual users?

Yes. Under General, select excluded roles or enter exact WordPress usernames. Any matching role or user exclusion hides the complete QuickNav toolbar entry in the administration area and frontend. Authorized administrators retain access through the WordPress Settings menu.

### What is available in the frontend and on multisite?

Frontend navigation is off by default. When enabled, it includes verified definition post types and optional content lists; menu-based provider screens remain administration-only. Each multisite website keeps its own settings and exclusions.

### What happens on deactivation or uninstall?

Settings are retained by default. Each website may opt in to deleting its own QuickNav settings on uninstall. Provider content and data are never removed. Shared Library cleanup follows its own settings and last-host rules.

[FAQ by topic / Fragen nach Themen](docs/FAQ.md)

## Changelog

### 1.0.0 · 2026-10-18

- **New:** Configurable toolbar navigation for ACF, Meta Box, JetEngine, ACPT and Pods, with additional Toolset and Secure Custom Fields support.
- **New:** Selected ACF add-on navigation, separate optional content lists and an optional frontend toolbar.
- **New:** Website-specific provider switches, role and user exclusions, accessible settings cards and local release history.

## Author and scope

David Decker – DECKERWEB · QuickNav. Navigation to existing administration screens.

## Support and security

Report vulnerabilities privately through [GitHub Security Advisories](https://github.com/deckerweb/types-fields-quicknav/security/advisories/new). Include plugin/provider versions, reproduction steps and impact. Do not post credentials or unpatched vulnerability details in public issues.

[DECKERWEB](https://github.com/deckerweb) · [Ko-fi](https://ko-fi.com/deckerweb)

## Copyright and license

Copyright © 2026 David Decker – DECKERWEB. GPL-2.0-or-later.

Bundled: deckerweb Library 1.0.0 ([source](https://github.com/deckerweb/deckerweb-plugin-library)) and deckerweb Updater 2.1.0, David Decker – DECKERWEB, GPL-2.0-or-later. No provider source code is included.

Footer presentation adapted from deckerweb Admin Footer v1 in [Multisite Toolbar Additions](https://github.com/deckerweb/multisite-toolbar-additions), David Decker – DECKERWEB, GPL-2.0-or-later. / Footer-Gestaltung auf Grundlage derselben Komponente.

Inter lettering is outlined in the artwork / Inter-Schrift als Pfade in den Grafiken: SIL OFL 1.1. [License / Lizenz](assets/brand/Inter-OFL-1.1.txt).
