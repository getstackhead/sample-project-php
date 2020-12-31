# PHP sample project

This is a sample repository for deploying a PHP application and serving it on a domain using [StackHead, the Open-Source Web Server management](https://github.com/getstackhead/deployment).

It provides examples for deploying a single and multi container applications.

## Requirements

In order to try out this sample project, you'll need the following:

* [StackHead CLI binary file](https://github.com/getstackhead/stackhead-cli/releases)
* [Ansible 2.10 or later](https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html)
* a web server with root SSH access (we recommend renting a [pay-per-use VPS at Hetzner. Get 20€ cloud balance for free](https://hetzner.cloud/?ref=n7H3qhWcZ2QS))
* a top level (sub) domain with A record pointing to your server IP

Initialize StackHead by running the command below.
This will install all dependencies required.

```shell script
stackhead-cli init
```

## How to use

### Server provisioning

```bash
stackhead-cli setup 159.69.20.148
```

After provisioning completed, you should see the Nginx default page when opening your domain in your browser.

### Application deployment

The following sections describe how to configure the samples for your server and domain.
There are two differently sized projects, consisting of one single container and multiple containers.

#### Single container application

1. Adjust the project settings in `.stackhead/project/single-container.stackhead.yml`
   1. Set your own domain in `domain`

2. Validate your project file using the `validate` command:
   ```shell script
   stackhead-cli project validate ./.stackhead/project/single-container.stackhead.yml
   ```

3. Deploy the application. Make sure to replace `159.69.20.148` with your servers IP address.
    ```shell script
    stackhead-cli project deploy ./.stackhead/project/single-container.stackhead.yml 159.69.20.148
    ```

4. After deployment, open the domain in your web browser. You should see a page that prints "Hello world!" alongside the PHP version and successful database connection.

5. Remove the application:

```shell script
stackhead-cli project destroy ./.stackhead/project/single-container.stackhead.yml
```

#### Multi container application

1. Adjust the project settings in `.stackhead/project/multi-container.stackhead.yml`
   1. Set your own domain in `domain`

3. Validate your project file using the `validate` command:
   ```shell script
   stackhead-cli project validate ./.stackhead/project/multi-container.stackhead.yml
   ```

3. Deploy the application. Make sure to replace `159.69.20.148` with your servers IP address.
    ```shell script
    stackhead-cli project deploy ./.stackhead/project/multi-container.stackhead.yml 159.69.20.148
    ```

4. After deployment, open the domain in your web browser.
You should see a page that prints "Hello world!" alongside the PHP version and successful database connection.

    You can access PhpMyAdmin on port 81 (no HTTPS).

5. Remove the application:

```shell script
stackhead-cli project destroy ./.stackhead/project/multi-container.stackhead.yml
```
