# Providers and navigation destinations

[Documentation](README.md) · [Deutsch](PROVIDERS-de.md)

Every destination requires an active feature and sufficient native permissions. This overview does not imply that every edition includes every feature.

| Provider | Possible destinations |
|---|---|
| ACF Free / Pro | Field groups, post types, taxonomies and options-page management where provided. |
| Meta Box | Field groups, types, taxonomies, options pages, relationships, models, views, templates, tools and relevant extension/settings screens, when actually available. |
| JetEngine | Meta boxes, post types, taxonomies, options pages and provider settings. |
| ACPT Free / Pro | Available field/type/taxonomy/option definitions and provider settings. |
| Pods | Pods and field administration; available provider settings. |
| Toolset suite | Types field groups, types, taxonomies and relationships; Views/Blocks templates and archives; Forms; Layouts; Access; Module Manager; Maps; conditional Commerce/WooCommerce settings; import/export. |
| Secure Custom Fields | Available ACF-compatible definition screens; detected separately from ACF. |

## Meta Box

Free, Lite, All-in-One and individual modules are treated according to actual features. Detecting a package does not unlock assumed premium links. Official Meta Box extensions without a relevant administration screen do not receive artificial toolbar entries. Template navigation requires an available interface.

## Toolset

Toolset is the suite; Types itself already manages both types and fields. QuickNav groups available suite modules in one branch. Views and Blocks are treated as alternative runtimes. Maps and WooCommerce Blocks may be tabs of Toolset settings. Forms Commerce registers its page conditionally. QuickNav checks the associated runtime features and permissions. The old Layouts Migration 1.0 package contains Twig syntax incompatible with PHP 8; its link is therefore omitted on the required PHP baseline.

## Selected ACF extensions

- **ACF Extended (Basic):** available administration destinations; the current reviewed variant requires ACF Pro. No blanket support claim for Extended Pro.
- **ACF: Better Search:** its own settings page.
- **ACF Font Awesome Field:** its available settings page.

Each extension has its own switch, off by default. No general compatibility claim is made for these add-ons with Secure Custom Fields.

## Limits

Providers remain responsible for licenses, data, editors and dependencies. Testing QuickNav navigation does not certify payment flows, maps, migrations or every vendor editor. Future menu changes may require adapter updates. ACF and Secure Custom Fields share APIs and should not be loaded together.
