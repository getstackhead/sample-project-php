# PHP sample project

This is a sample repository for deploying a PHP application and serving it on a domain using [Mackerel, the Open-Source Web Server management](https://github.com/mackerelserver/deployment).

## How to use

### Requirements

* Ansible
* web server with root SSH access (we recommend renting a pay-per-use VPS at Hetzner)
* top level domain with A record pointing to your server IP

### Preparation

1. Install Composer dependencies:
    ```shell script
    composer install
    ```
2. Install Ansible dependencies
    ```shell script
    ansible-galaxy install -r vendor/mackerel/deployment/requirements/requirements.yml
    ```
3. Change the IP address `1.2.3.4` to your own servers IP in `.mackerel/inventory.yml`

4. Replace `mydomain.com` with your own domain in `mackerel/example_docker.yaml`

### Server provisioning

```shell script
ansible-playbook vendor/mackerel/deployment/server-provision.yml
```

After provisioning completed, you should see the Nginx default page when opening your domain in your browser.

### Application deployment

```shell script
ansible-playbook vendor/mackerel/deployment/application-deploy.yml
```

After deployment you should see a page that prints "Hello world!" alongside the PHP version and successful database connection.
