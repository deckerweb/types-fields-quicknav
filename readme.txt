=== Types & Fields QuickNav ===
Contributors: daveshine
Tags: toolbar, custom fields, custom post types, navigation
Requires at least: 7.1.2
Tested up to: 7.1.2
Requires PHP: 8.2
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Quick toolbar access to content type and custom field administration.

== Description ==

Types & Fields QuickNav brings the administration of your content types and custom fields into the WordPress toolbar. Reach field groups, post type definitions, taxonomies and available provider settings from one familiar place.

It is part of the **deckerweb QuickNav series**: small, focused tools that make everyday WordPress administration easier. Each QuickNav plugin shortens the path to existing tools while respecting their own interfaces and permissions.

Whether you maintain your own projects or move between client websites, Types & Fields QuickNav adapts to the providers that are actually available. Configure the navigation for each website and decide who sees it.

Availability depends on the active provider, enabled modules, native administration menus and the current user’s permissions. ACF and Secure Custom Fields share runtime identifiers; only the implementation actually loaded gets a branch. Menu-based destinations, including Toolset pages, are administration-only. ACF add-on navigation is limited to ACF. ACF Extended Basic is checked; its Pro edition is not verified. QuickNav links to existing administration pages and does not migrate data or configure the providers. Full editor, map service, licensing, checkout and migration workflows are outside the navigation test scope. [Provider coverage and test boundaries](docs/PROVIDERS.md).

== Installation ==

Download the installable plugin ZIP from [Releases](https://github.com/deckerweb/types-fields-quicknav/releases). In WordPress, open Plugins → Add Plugin → Upload Plugin, upload the ZIP and activate it. Then open Settings → Types & Fields QuickNav. Select the provider menus for this website. Add-on links, frontend navigation and content lists are optional and initially off.

== Frequently Asked Questions ==

= Which providers are supported? =

ACF Free/Pro, Meta Box with available extensions, JetEngine, ACPT Free/Pro and Pods. Toolset and Secure Custom Fields are also supported. Several compatible providers can appear together.

= Does QuickNav replace or modify my providers? =

It opens existing administration pages. Field definitions, content, roles and provider configuration remain under the provider’s control.

= Why is a toolbar entry missing? =

The required provider or module may be inactive, its admin menu unavailable, or the current user may lack permission. Check the provider, destination and add-on switches, as well as role and user exclusions for this website.

= How do I enable ACF add-ons? =

Open Settings → Types & Fields QuickNav → Add-ons → Extensions for ACF. Enable the desired add-on. ACF Extended requires ACF Pro. An active add-on and its QuickNav visibility are independent states.

= Can I hide the menu from client roles or individual users? =

Yes. Under General, select excluded roles or enter exact WordPress usernames. Any matching role or user exclusion hides the complete QuickNav toolbar entry in the administration area and frontend. Authorized administrators retain access through the WordPress Settings menu.

= What is available in the frontend and on multisite? =

Frontend navigation is off by default. When enabled, it includes verified definition post types and optional content lists; menu-based provider screens remain administration-only. Each multisite website keeps its own settings and exclusions.

= What happens on deactivation or uninstall? =

Settings are retained by default. Each website may opt in to deleting its own QuickNav settings on uninstall. Provider content and data are never removed. Shared Library cleanup follows its own settings and last-host rules.

== Changelog ==

= 1.0.1 =
* Improved: Updated the bundled Library and GitHub updater for shared installations.
* Fixed: Strengthened update package validation and refined administration output.

= 1.0.0 =
* New: Configurable toolbar navigation for ACF, Meta Box, JetEngine, ACPT and Pods, with additional Toolset and Secure Custom Fields support.
* New: Selected ACF add-on navigation, separate optional content lists and an optional frontend toolbar.
* New: Website-specific provider switches, role and user exclusions, accessible settings cards and local release history.
