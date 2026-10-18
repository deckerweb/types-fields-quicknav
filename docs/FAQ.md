# FAQ by topic

[Documentation](README.md) · [Deutsch](FAQ-de.md)

## Common questions

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

## Setup and compatibility

### Can I use several providers?

Yes, compatible active providers receive independent branches. Do not load ACF and its API-sharing fork together.

### Does Meta Box Lite imply premium features?

No. Each available feature is checked independently, including individual modules and All-in-One.

## Navigation and add-ons

### Why can an active add-on have no link?

Activation and navigation availability are separate. The required provider, administration screen and permission must all be available.

### Does a migration link start a migration?

No. It opens the vendor administration screen. Only that provider controls subsequent actions.

### Where are Toolset Maps and WooCommerce settings?

Their reviewed modules may use tabs in Toolset settings. QuickNav links to the available tab when its runtime and native permission checks succeed.

## Access and website scope

### What happens if an administrator is excluded?

Their entire QuickNav entry disappears. The WordPress Settings menu still provides access to authorized accounts with manage_options.

### Can I grant provider access with QuickNav?

No. QuickNav never grants provider permissions. Role and user exclusions can only further restrict its own toolbar visibility.

### Are settings network-wide?

No. Each website keeps its own settings, including role and user exclusions.

## Updates and data

### Are automatic updates enabled?

No. The bundled updater uses published GitHub releases in the WordPress update workflow. Draft releases are excluded; automatic updates are not enabled by installing QuickNav.

### Are premium packages bundled?

No. Obtain supported providers and licenses from their vendors.

### Where are data and uninstall rules explained?

See [Data and privacy](DATA.md) and [Settings](SETTINGS.md).

### What QuickNav data does Site Health show?

Tools → Site Health → Info includes a compact Types & Fields QuickNav summary: version, detected providers, enabled provider and add-on switches, frontend navigation, content lists, and whether role or user exclusions are configured. No role names, usernames or user IDs are included. The section adds no health warnings and requires the native WordPress Site Health permission.

