#sonata create super admin
php app/console fos:user:create --super-admin

#load fixtures data
php app/console doctrine:fixtures:load

#DB Update
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force

#clear production version
php app/console cache:clear --env=prod --no-debug

php app/console assetic:dump --env=prod --no-debug