# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## [Unreleased]

## [1.6.0] - 2019-10-21
### Added
- Ansible logging, helpful for provision and deploy troubleshooting
- nginx-include for nginx_status location block (needed for check_mk plugin)
- Location Block for excluding logging of health checks from Application Load Balancer
- Destination port settings to allow Check_MK logging
- Common SSH key for admin_user and web_user (ubuntu.pub it@sarnia.ca), shared in Keepass
- MYSQL Encryption flag for production environment

### Removed
- Redundant variable definitions in environment config files

### Changed
- Hosts are now defined using CNAMES making then easier to read/understand
- admin_user is now 'ubuntu' globally rather than 'cosadmin'
- ntp_servers is now '169.254.169.123' (Amazon Time Sync Service)

### Updated
- roots/wordpress (5.2.3 => 5.2.4)
- koodimonni-language/en_ca (5.2.3 => 5.2.4)
- koodimonni-language/fr_ca (5.2.3 => 5.2.4)
- wpackagist-plugin/luckywp-table-of-contents (1.9.4 => 1.9.7)
- wpackagist-plugin/query-monitor (3.3.7 => 3.4.0)
- wpackagist-plugin/elasticpress (3.1.4 => 3.2.1)
- koodimonni-plugin-language/woocommerce-en_ca (3.7.0 => 3.7.1)
- koodimonni-plugin-language/woocommerce-fr_ca (3.7.0 => 3.7.1)
- squizlabs/php_codesniffer (3.5.0 => 3.5.1)

### Fixed
- Include changes from upstream trellis project, that fix self-signed certs for Ansible 2.8

## [1.5.0] - 2019-10-07
### Added
- Added http2 support to nginx templates
- Added backup environment to sync script
- Added support for MySQL client connections using SSL

### Changed
- Moved production environment to AWS
- Removed edit environment
- Updated cos/gravityforms (2.4.12 => 2.4.14)
- Updated squizlabs/php_codesniffer (3.4.2 => 3.5.0)
- Change logic to always include transport-security
- Update README
- Upgrade bedrock to 1.12.8
- Updated wpackagist-plugin/stream (3.4.1 => 3.4.2)  
- Updated roave/security-advisories (dev-master 99b60dd => dev-master 3a9ab64)
- Version bumps for ansible-galaxy roles
- Upgrade Trellis to v1.1.0
- Updated staging and develop environments for hosting at AWS
- Updated cos/sarnia.ca-theme (v2.8 => v2.9.0):
- Updated cos/sarnia.ca-plugin (v2.0 => v2.1.1): 

## [1.4.2] - 2019-10-01
### Hotfix
- Theme Hotfix and Composer Update

## [1.4.1] - 2019-09-18
### Fixed
- updated mysql server location for backup environment

## [1.4] - 2019-09-18
### Added
- add CHANGELOG to project

### Changed
- change repository urls for sarnia.ca project and gravityforms plugin
- update backup environment hosts

## [1.3] - 2019-09-16
### Changed
- Change branched used for development environment
- Update sarnia.ca-theme to 2.8
- Update gravityforms to 2.4.12.4
- regenerate composer.lock

## [1.2] - 2019-09-12
### Changed
- Update sarnia.ca-theme to 2.7

## [1.1] - 2019-09-12
### Changed
- Update sarnia.ca-plugin to 2.0

## [1.0] - 2019-09-12
### Added
- Version tracking begins (albeit a bit late in the process)

[Unreleased]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.6.0...develop
[1.6.0]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.5.0...v1.6.0
[1.5.0]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.4.2...v1.5.0
[1.4.2]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.4.1...v1.4.2
[1.4.1]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.4...v1.4.1
[1.4]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.3...v1.4
[1.3]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.2...v1.3
[1.2]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.1...v1.2
[1.1]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/compare/v1.0...v1.1
[1.0]: https://cos-gitlab-prod/sarnia-website/sarnia.ca/-/tags/v1.0
