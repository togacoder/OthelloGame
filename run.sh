#!/bin/bash

TAG=$1;
if [ -z "$TAG" ]; then
    TAG="app"
fi
export tag=$TAG
docker build -t $TAG app/.
IMAGE=`docker images | perl -wnale '/$ENV{tag}/ and print $F[2]'`
docker run -u admin --rm -it $IMAGE /bin/bash

#export image=$IMAGE
#CONTAINER=`docker ps | perl -wnale '/$ENV{image}/ and print $F[0]'`
#docker exec -it $CONTAINER /bin/bash
