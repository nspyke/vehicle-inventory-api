#!/bin/bash

if [ -f app/cache/test/test_ims_api.db3 ]; then
    php app/console doctrine:database:drop -e test --force
fi

php app/console doctrine:database:create -e test
chmod 777 app/cache/test/test_ims_api.db3