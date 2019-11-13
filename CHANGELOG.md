# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [v2.10.0] - 2019/11/13
### Changed
- Change Pagination arguments for better accessibility.
- Margins on recent notifications to be a bit cleaner on desktop

### Fixed
- Fixed double scrollbar bug on IE11
- Fixed whitespace overflow on footer for IE11

### Removed
- Bottom part of recent notifications block, tentatively reworked in future feature release

## [v2.9.0] - 2019/09/23
### Added
- This changelog :)

### Changed
- Reworked banner header rendering to reduce max width on desktops and large screens
- Updated npm packages for webpacker and dependencies

### Fixed
- Fixed column block spacing for middle children

## [v2.8] - 2019/09/13
### Added
- Vimeo link and SVG in the social media section of the footer
### Fixed
- Fixed theme package versions to align with semantic versioning

## [v2.7] - 2019/09/12
### Added
- Formatted date published section to post-excerpt and search-excerpt
- Additional logic to control rendering on front page only
- New contact acf field to footer rendering with URI for toll free

### Changed
- Theme metadata updated
- Moved notifications-bar back to theme
- Moved php code in functions.php to setup function
- Updated npm packages used by webpacker
- changed php code to use short array syntax
- Used colour variable set, overwrote `<a>` for news-card__headline
- Changed conditional statement order in footer needed to move the if statement checking for the
  field to be outside the div html statement.

### Fixed
- Vertical centering for buttons on recent-notifications now works

### Removed
- Remove functions, assets, and templates and moved core website functionality out of the theme and
  into the plugin.  This gives more flexibility in the future, and content will still be visible if
  the theme is changed

## [v2.6.0] - 2019/08/21
### Added
- Add additional ACF fields for user customisation
- Add ability for user to change heading level
- Added styling for copyright notice in footer

### Changed
- Code cleanup, formatting, and refactoring
- Modularized code utilizing template_parts

### Removed
- Removed unnecessary code

## [v2.5.0] - 2019/08/12
### Changed
- Code cleanup
- Changed how .svg files are used.  Now using get_template_part() to load inline svg templates.

### Fixed
- Fixed search behaviour dealing with null input and queries

## [v2.4.0] - 2019/08/09

## [v2.3.6] - 2019/08/08

## [v2.3.5] - 2019/08/07

## [v2.3.4] - 2019/08/07

## [v2.3.3] - 2019/08/07

## [v2.3.2] - 2019/08/07

## [v2.3.1] - 2019/08/07

## [v2.3.0] - 2019/08/07

## [v2.2.0] - 2019/08/06

## [v2.1.0] - 2019/08/06

## [v2.0.0] - 2019/08/06

## [v1.4.7] - 2019/08/02

## [v1.4.6] - 2019/07/22

## [v1.4.5] - 2019/07/22

## [v1.4.4] - 2019/07/21

## [v1.4.3] - 2019/07/21

## [v1.4.2] - 2019/07/20

## [v1.4.1] - 2019/07/20

## [v1.4.0] - 2019/07/19

## [v1.3.0] - 2019/07/19

## [v1.2.1] - 2019/07/18

## [v1.2.0] - 2019/07/18

## [v1.1.0] - 2019/07/16

## [v1.0.0] - 2019/07/15

## [v1.0.0-beta11] - 2019/04/22

## [v1.0.0-beta10] - 2019/03/29
### Added
- Added version information and tagged releases for deployment process

[Unreleased]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/master...HEAD
[v2.10.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.9.0...v2.10.0
[v2.9.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.8...v2.9.0
[v2.8]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.7...v2.8
[v2.7]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.6.0...v2.7
[v2.6.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.5.0...v2.6.0
[v2.5.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.4.0...v2.5.0
[v2.4.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.3.6...v2.4.0
[v2.3.6]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.3.5...v2.3.6
[v2.3.5]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.3.4...v2.3.5
[v2.3.4]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.3.3...v2.3.4
[v2.3.3]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.3.2...v2.3.3
[v2.3.2]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.3.1...v2.3.2
[v2.3.1]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.3.0...v2.3.1
[v2.3.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.2.0...v2.3.0
[v2.2.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.1.0...v2.2.0
[v2.1.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v2.0.0...v2.1.0
[v2.0.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.4.7...v2.0.0
[v1.4.7]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.4.6...v1.4.7
[v1.4.6]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.4.5...v1.4.6
[v1.4.5]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.4.4...v1.4.5
[v1.4.4]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.4.3...v1.4.4
[v1.4.3]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.4.2...v1.4.3
[v1.4.2]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.4.1...v1.4.2
[v1.4.1]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.4.0...v1.4.1
[v1.4.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.3.0...v1.4.0
[v1.3.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.2.1...v1.3.0
[v1.2.1]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.2.0...v1.2.1
[v1.2.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.1.0...v1.2.0
[v1.1.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.0.0...v1.1.0
[v1.0.0]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.0.0-beta11...v1.0.0
[v1.0.0-beta11]: https://github.com/CityOfSarnia/sarnia.ca-theme/compare/v1.0.0-beta10...v1.0.0-beta11
[v1.0.0-beta10]: https://github.com/CityOfSarnia/sarnia.ca-theme/releases/tag/v1.0.0-beta10
