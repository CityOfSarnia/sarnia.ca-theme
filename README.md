# Sarnia.ca Project

This repository is used as a storage location for the project, integrating and using the following projects:

* [Bedrock](https://github.com/roots/bedrock)
* [Trellis](https://github.com/roots/trellis)

This project is a complete working website.

You can view it at https://www.sarnia.ca/.

## Requirements

Make sure you have installed all of the dependencies for [Trellis](https://github.com/roots/trellis#requirements) and [Bedrock](https://github.com/roots/bedrock#requirements) before moving on.

At a minimum you need to have:

* [Ansible](http://docs.ansible.com/ansible/intro_installation.html#latest-releases-via-pip) 2.5.3-2.7.5
* [Virtualbox](https://www.virtualbox.org/wiki/Downloads) >= 4.3.10
* [Vagrant](https://www.vagrantup.com/downloads.html) >= 2.1.0

See Roots.io's [Getting Started docs](https://roots.io/getting-started/docs/development-environment-recommendations/):

* [Development Environment Recommendations](https://roots.io/getting-started/docs/development-environment-recommendations/)
* [macOS Basic Setup](https://roots.io/getting-started/docs/macos-basic-setup/)
* [macOS Development Environment: Sage](https://roots.io/getting-started/docs/macos-development-environment-sage/)
* [macOS Development Environment: Trellis](https://roots.io/getting-started/docs/macos-development-environment-trellis/)
* [Ubuntu Linux Basic Setup](https://roots.io/getting-started/docs/ubuntu-linux-basic-setup/)
* [Ubuntu Linux Development Environment: Sage](https://roots.io/getting-started/docs/ubuntu-linux-development-environment-sage/)
* [Ubuntu Linux Development Environment: Trellis](https://roots.io/getting-started/docs/ubuntu-linux-development-environment-trellis/)
* [Windows Basic Setup](https://roots.io/getting-started/docs/windows-basic-setup/)
* [Windows Development Environment: Sage](https://roots.io/getting-started/docs/windows-development-environment-sage/)
* [Windows Development Environment: Trellis](https://roots.io/getting-started/docs/windows-development-environment-trellis/)


## Instructions

Here's how this example project was created:

1. Create a new project directory: `$ mkdir sarnia.ca && cd sarnia.ca`
2. Clone Trellis: `$ git clone --depth=1 git@github.com:roots/trellis.git && rm -rf trellis/.git`
3. Clone Bedrock: `$ composer create-project roots/bedrock site`

```shell
sarnia.ca/      # → Root folder for the project
├── trellis/      # → System management & deployment
└── site/         # → A Bedrock-based WordPress site
    └── web/
        ├── app/  # → WordPress content directory (themes, plugins, etc.)
        └── wp/   # → WordPress core (don't touch!)
```

## Local development setup

1. **Clone this repository** into a working directory (e.g., `~/Sites`)
  ```shell
  $ git clone git@github.com:cityofsarnia/sarnia.ca.git
  ```

2. **Fire up the server** (be patient, but watch the console––it may prompt for your system password)
  ```shell
  # @ sarnia.ca/trellis
  $ vagrant up
  ```
  _Note: to shut down the server:_ `vagrant halt`

3. **Test the install** at [local.sarnia.ca](https://local.sarnia.ca/)

## Remote server setup (staging/production)

### Provision server:
```shell
# @ sarnia.ca/trellis
$ ansible-playbook server.yml -e env=<environment>
```

### Deploy:
```shell
# @ sarnia.ca/trellis
./deploy.sh <environment> sarnia.ca

# OR
ansible-playbook deploy.yml -e "site=sarnia.ca env=<environment>"
```

**To rollback a deploy:**
```shell
ansible-playbook rollback.yml -e "site=sarnia.ca env=<environment>"
```

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](https://github.com/roots/guidelines/blob/master/CONTRIBUTING.md) to help you get started.

## Community

Keep track of development and community news.

* Participate on the [Roots Discourse](https://discourse.roots.io/)
* Follow [@rootswp on Twitter](https://twitter.com/rootswp)
