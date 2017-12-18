#!/usr/bin/env bash
echo 'Enter project name: '
read PROJECT_NAME
echo 'Which port should be exposed: '
read PORT

if [ -z ${PROJECT_NAME} ] || [ -z ${PORT} ] ; then
    echo 'Invalid arguments!'
    exit 1
fi

find app/apps/config -type f -exec sed -i "s/example_project/$PROJECT_NAME/g" {} +
find docker/common-compose.yml -exec sed -i "s/12421/$PORT/g" {} +
find Readme.md -exec sed -i "s/12421/$PORT/g" {} +
find Readme.md -exec sed -i "s/example_project/$PROJECT_NAME/g" {} +
find Readme.md -exec sed -i "s/#### RUN \`.\/install-once.sh\` !!!//g" {} +
find tests -exec sed -i "s/example_project/$PROJECT_NAME/g" {} +
rm -rf .git
rm install-once.sh

echo 'Done! Please init git and Go-Go-Go!'
echo 'Have a nice day!'