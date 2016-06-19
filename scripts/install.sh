#!/usr/bin/env bash

# Run this as sudo!
# Do not run this outside the vaprobash vm!

SERVER_NAME="192.168.19.71.xip.io"
PROJECT_ROOT="/vagrant/www"
BACKUP_FILENAME="backup_www_$(date '+%Y.%m.%d_%H-%M-%S').tar.gz"

  echo "+-----------------------------------------------------"
  echo "| Installing your web app (playground) ...            "
  echo "+-----------------------------------------------------"

# back up and delete folder "www"
if [ -d $PROJECT_ROOT ]; then
  echo "+-----------------------------------------------------"
  echo "| backup $PROJECT_ROOT"
  tar -czf "backup_www_$(date '+%Y.%m.%d_%H-%M-%S').tar.gz" /vagrant/www
  echo "| you can find the backup here:"
  echo "| /vagrant/$BACKUP_FILENAME"
fi

echo "+-----------------------------------------------------"
echo "| Create vhosts"
vhost -d $PROJECT_ROOT/frontend/htdocs -s frontend.$SERVER_NAME -a www.frontend.$SERVER_NAME
vhost -d $PROJECT_ROOT/backend/htdocs -s backend.$SERVER_NAME -a www.backend.$SERVER_NAME

echo "+-----------------------------------------------------"
echo "| install node modules and bower packages, "
echo "| run grunt build task"

su - vagrant -c "cd $PROJECT_ROOT/frontend; npm install; bower install; grunt build;"
#su - vagrant -c "cd $PROJECT_ROOT/backend; npm install; bower install; grunt build;"

echo "+-----------------------------------------------------"
echo "| playground installed                                "
echo "+-----------------------------------------------------"
echo "| see the result in your browser:                     "
echo "| http://$SERVER_NAME                         "
echo "+-----------------------------------------------------"
echo "| when working on pug or less files you may want to    "
echo "| start the grunt watch task. so connect via ssh:     "
echo "|   $ vagrant ssh                                     "
echo "|                                                     "
echo "| move to desired Gruntfile.js, and run the task:     "
echo "|   $ cd $PROJECT_ROOT/frontend/                       "
echo "|   $ grunt watch                                     "
echo "+-----------------------------------------------------"
