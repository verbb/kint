# Changelog

## 4.0.8 - 2026-11-01

### Fixed
- Fixed the “Display Theme” setting not being applied.
- Fixed `d()`, `s()` and `Kint::dump()` not showing variable names or respecting modifiers.

## 4.0.7 - 2026-10-07

### Changed
- Require Verbb Base 3.0.20 or later so shared control-panel layouts use the current asset bundle namespace. ([verbb-base#3](https://github.com/verbb/verbb-base/issues/3))

## 4.0.6 - 2026-10-02

### Changed
- Updated the required version of `verbb/base` to 3.0.19.

## 4.0.5 - 2026-09-30

### Changed
- Route plugin settings through the plugin’s authorized settings controller.

## 4.0.4 - 2026-09-14

### Changed
- Updated documentation for clearer, more consistent guidance.

## 4.0.3 - 2026-09-13

### Changed
- Normalize plugin settings.

## 4.0.1 - 2024-09-04

### Fixed
- Fix an error when dumping some Craft variables like ElementQueries.

## 4.0.0 - 2024-05-13

### Changed
- Now requires PHP `8.2.0+`.
- Now requires Craft `5.0.0+`.

## 3.1.2 - 2025-07-18

### Changed
- Update English translations.

## 3.1.1 - 2023-09-19

### Changed
- New plugin icon.

## 3.1.0 - 2022-10-26

### Added
- Add the ability to set `kintSettings` and `richRendererSettings` plugin settings to control global Kint settings.

### Deprecated
- Deprecated the `kintDisplayTheme` plugin setting. Use `richRendererSettings['theme']` instead.

## 3.0.0 - 2022-08-22

### Changed
- Now requires PHP `8.0.2+`.
- Now requires Craft `4.0.0+`.

### Removed
- Removed `j()` function.

## 2.0.0 - 2022-08-22

> {note} The plugin’s package name has changed to `verbb/kint`. Kint will need be updated to 2.0 from a terminal, by running `composer require verbb/kint && composer remove mildlygeeky/craft-kint`.

### Changed
- Migration to `verbb/kint`.
- Now requires Craft 3.7+.

## 1.0.0 - 2019-02-05

### Added
- Initial release
