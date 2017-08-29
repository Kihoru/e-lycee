git clone https://github.com/Kihoru/e-lycee.git

cd e-lycee/

composer install

php artisan key:generate

#!/usr/bin/env bash
USERNAME='root'
PASSWORD='root'
DBNAME='e-lycee'
HOST='localhost'

USER_USERNAME='root'
USER_PASSWORD='root'

#GRANT ALL PRIVILEGES ON $DBNAME.* to '$USER_USERNAME'@'$HOST' IDENTIFIED BY '$USER_PASSWORD' WITH GRANT OPTION;


MySQL=$(cat <<EOF
DROP DATABASE IF EXISTS $DBNAME;
CREATE DATABASE $DBNAME DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
DELETE FROM mysql.user WHERE user='$USER_USERNAME' and host='$USER_PASSWORD';
EOF
)

echo $MySQL | mysql --user=$USERNAME --password=$PASSWORD


php artisan migrate --seed

npm install

npm run production
