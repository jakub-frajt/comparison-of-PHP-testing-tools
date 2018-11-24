## Requirements
* Linux, tested on Ubuntu 18.10.
* Docker (>= 18.09) and Docker Compose (>= 1.23.1)

## Setup
For running tests in PHP, we need to setup Apache server with PHP, MySQL for an integration and acceptance tests.
So after clone or download this repository, run a bash script *setup.sh* that handle installation of dependencies and set up a server with MySQL:

```bash
    ./setup.sh
```

## Running tests
After that we can run tests for a specific testing tool:

```bash
    ./run_tests.sh phpunit
```

Currently supported options/tools are *phpunit*, *mockery*, *codeception*
