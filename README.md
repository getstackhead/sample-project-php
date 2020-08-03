# PHP sample project

This is a sample repository for deploying a PHP application and serving it on a domain using [StackHead, the Open-Source Web Server management](https://github.com/getstackhead/deployment).

It provides examples for deploying a single and multi container applications.

## Requirements

In order to try out this sample project, you'll need the following:

* [Ansible](https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html)
* a web server with root SSH access (we recommend renting a [pay-per-use VPS at Hetzner. Get 20€ cloud balance for free](https://hetzner.cloud/?ref=n7H3qhWcZ2QS))
* a top level (sub) domain with A record pointing to your server IP
* [Composer](https://getcomposer.org) as this project requires StackHead deployment files that way

Also make sure to install StackHead via Composer:
```shell script
composer install
```

and the required Ansible files via Ansible Galaxy:
```shell script
ansible-galaxy install -r vendor/getstackhead/stackhead/ansible/requirements/requirements.yml
```

## How to use

### Configuration

The following sections describe how to configure the samples for your server and domain.
The provisioning and deployment part is the same regardless of the example you want to use.

#### Single container application

1. Adjust your inventory configuration in `.stackhead/inventory.yml`
   1. Change the IP address in `ansible_host` to your own servers IP in `.stackhead/inventory.yml`
   2. Uncomment the line "- example_container_single" in `applications` section

2. Adjust the project settings in `.stackhead/project/example_container_single.yml`
   1. Set your own domain in `domain`

3. Validate your project file using the `project-validator` binary:
   ```shell script
   ./vendor/getstackhead/stackhead/validation/bin/project-validator .stackhead/project/example_container_single.yml
   ```

#### Multi container application

1. Adjust your inventory configuration in `.stackhead/inventory.yml`
   1. Change the IP address in `ansible_host` to your own servers IP in `.stackhead/inventory.yml`
   2. Uncomment the line "- example_container_multi" in `applications` section

2. Adjust the project settings in `.stackhead/project/example_container_multi.yml`
   1. Set your own domain in `domain`

3. Validate your project file using the `project-validator` binary:
   ```shell script
   ./vendor/getstackhead/stackhead/validation/bin/project-validator .stackhead/project/example_container_multi.yml
   ```

### Server provisioning

```shell script
ansible-playbook vendor/getstackhead/stackhead/ansible/server-provision.yml
```

After provisioning completed, you should see the Nginx default page when opening your domain in your browser.

### Application deployment

```shell script
ansible-playbook vendor/getstackhead/stackhead/ansible/application-deploy.yml
```

After deployment, open the domain in your web browser.

If you deployed a container-typed project, you should see a page that prints "Hello world!" alongside the PHP version and successful database connection.
If you deployed the `example_container_multi` project you can access PhpMyAdmin on port 81 (no HTTPS).

### Remove application

If you want to remove your application, run the following playbook.
Make sure to replace `PROJECTNAME` with the name of the project you set up (i.e. example_container_multi or example_container_single).

```shell script
ansible-playbook vendor/getstackhead/stackhead/ansible/application-destroy.yml --extra-vars "project_name=PROJECTNAME"
```