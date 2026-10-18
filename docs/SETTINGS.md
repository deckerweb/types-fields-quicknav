# Settings and daily use

[Documentation](README.md) · [Deutsch](SETTINGS-de.md)

## First steps

1. Activate a supported provider and Types & Fields QuickNav.
2. Open **Settings → Types & Fields QuickNav**. The toolbar shortcut is **QuickNav Settings**.
3. Use the jump links for Providers and navigation, Add-ons and General.
4. Choose providers and individual destinations, then save.

An active badge describes the detected plugin runtime. Availability describes accessible navigation destinations. A plugin can be active without an accessible destination. Missing modules, absent administration screens or insufficient permissions can cause this. Saved preferences remain available when a module returns.

## Provider cards and add-ons

Provider switches control the corresponding toolbar branch. Expand menu items to choose destinations. Unavailable items do not create broken links.

The separate Add-ons section shows the parent provider and each add-on's status. Selected ACF add-ons are off by default. Their links require the add-on switch, the parent-provider switch, an active compatible provider and sufficient permissions. These switches do not activate or configure the add-on itself.

## General

Frontend toolbar navigation is off by default. Registered administration-menu destinations are available in the administration area; the frontend includes verified definition post types and optional content lists.

Content lists are a separate opt-in, off by default. They open entries of registered custom post types rather than provider definitions. Internal definition types are excluded.

## Exclude roles or users

Under General, select roles and/or enter exact WordPress usernames separated by commas or new lines. A match against any selected role or a selected user hides the entire QuickNav toolbar entry, including its settings shortcut. There is no administrator exception. An account with multiple roles is excluded if any one role matches.

These exclusions only affect this plugin's navigation. They do not revoke provider permissions or hide other WordPress menus. The settings page remains accessible to accounts with `manage_options`, allowing exclusions to be corrected. Unknown usernames produce an error and preserve the previous user selection. On multisite, settings and exclusions apply separately to each website.

## Removal

Settings are preserved by default. Enable the explicit deletion option before uninstalling if you want this website's QuickNav option removed. Provider data and content are never deleted. Shared deckerweb Library data follows the Library's separate settings.

## Site Health: compact diagnostics

Tools → Site Health → Info includes a compact Types & Fields QuickNav summary: version, detected providers, enabled provider and add-on switches, frontend navigation, content lists, and whether role or user exclusions are configured. No role names, usernames or user IDs are included. The section adds no health warnings and requires the native WordPress Site Health permission.
