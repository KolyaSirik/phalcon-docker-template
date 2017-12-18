#!/usr/bin/env bash
export COMPOSE_PROJECT_NAME='example_project'
export MY_IP_ADDR=`hostname -I | sed 's/ .*//'`
export USER_ID="`id -u`"

while [[ $# -gt 1 ]]; do
key="$1"

case ${key} in
    -e|--environment)
    ENV="$2"
    shift # past argument
    ;;

    *)
    # unknown option
    ;;
esac
shift # past argument or value
done

if [ -z ${ENV} ]; then
    ENV='local'
fi

if [ ${ENV} == 'local' ]; then
    FILE='docker/docker-compose-local.yml'
elif [ ${ENV} == 'dev' ]; then
    FILE='docker/docker-compose-dev.yml'
elif [ ${ENV} == 'prod' ]; then
    FILE='docker/docker-compose-prod.yml'
elif [ ${ENV} == 'test' ]; then
    FILE='docker/docker-compose-tests.yml'
else
    echo 'Environment not found.'
    exit 1
fi
