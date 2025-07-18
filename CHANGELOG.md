# Changelog

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
