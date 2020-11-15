#!/bin/bash

docker-compose build
docker-compose up -d
docker-compose exec --user admin app /bin/bash