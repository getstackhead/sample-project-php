# PHP sample project

This is a sample repository for deploying a PHP application and serving it on a domain using [StackHead, the Open-Source Web Server management](https://github.com/getstackhead/deployment).

It provides examples for deploying a single and multi container applications.

## Requirements

In order to try out this sample project, you'll need the following:

* [Ansible](https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html)
* a web server with root SSH access (we recommend renting a [pay-per-use VPS at Hetzner](https://www.hetzner.com/cloud))
* a top level (sub) domain with A record pointing to your server IP
* [Composer]() as this project requires StackHead deployment files that way

Also make sure to install StackHead via Composer:
```shell script
composer install
```

and the required Ansible files via Ansible Galaxy:
```shell script
ansible-galaxy install -r vendor/getstackhead/deployment/requirements/requirements.yml
```

## How to use

### Configuration

The following sections describe how to configure the samples for your server and domain.
The provisioning and deployment part is the same regardless of the example you want to use.

#### Single container application

1. Adjust your inventory configuration in `.stackhead/inventory.yml`
   1. Change the IP address in `ansible_host` to your own servers IP in `.stackhead/inventory.yml`
   2. Uncomment the line "- example_docker_singlecontainer" in `applications` section

2. Adjust the project settings in `.stackhead/project/example_docker_singlecontainer.yml`
   1. Set your own domain in `domain`

3. Validate your project file using the `getstackhead/project-validator` binary: 
   ```shell script
   ./vendor/bin/project-validator .stackhead/project/example_docker_singlecontainer.yml
   ```

#### Multi container application

1. Adjust your inventory configuration in `.stackhead/inventory.yml`
   1. Change the IP address in `ansible_host` to your own servers IP in `.stackhead/inventory.yml`
   2. Uncomment the line "- example_docker_multicontainer" in `applications` section

2. Adjust the project settings in `.stackhead/project/example_docker_multicontainer.yml`
   1. Set your own domain in `domain`

3. Validate your project file using the `getstackhead/project-validator` binary: 
   ```shell script
   ./vendor/bin/project-validator .stackhead/project/example_docker_multicontainer.yml
   ```

### Server provisioning

```shell script
ansible-playbook vendor/getstackhead/deployment/server-provision.yml
```

After provisioning completed, you should see the Nginx default page when opening your domain in your browser.

### Application deployment

```shell script
ansible-playbook vendor/getstackhead/deployment/application-deploy.yml
```

After deployment, open the domain in your web browser.
You should see a page that prints "Hello world!" alongside the PHP version and successful database connection.
