#sonata create super admin
php app/console sonata:admin:generate-object-acl

#load fixtures data
php app/console doctrine:fixtures:load