## Running tests

Each test can be run inside a Docker container with PHP.

Install dependecies via Composer container:

```bash
    docker run --rm -it -v $PWD:/app -u (id -u):(id -g) composer install
```

We just need to specify our code as a volume for the Docker container

```bash
    docker run -it --volume=<project_dir>:/usr/src/ --rm php:7.2-cli bash
```

Inside the docker container we can run PHPUnit or another testing tool:

```bash
    cd /usr/src
    php ./vendor/phpunit
```
