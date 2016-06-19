#!/usr/bin/env bash

# Run this as sudo!
# Do not run this outside the vaprobash vm!

# back up and delete folder "www"
if [ -d "/vagrant/www" ]; then
  tar -czf "backup_www_$(date '+%Y.%m.%d_%H-%M-%S').tar.gz" /vagrant/www
fi

# create vhosts
vhost -d /vagrant/www/frontend/htdocs -s frontend.192.168.19.71.xip.io -a frontend.test1.192.168.19.71.xip.io
vhost -d /vagrant/www/backend/htdocs -s backend.192.168.19.71.xip.io -a backend.192.168.19.71.xip.io

# install node modules and bower packages, run grunt tasks "build" and "watch"
su - vagrant -c 'cd /vagrant/www/frontend; npm install; bower install; grunt build; grunt watch &;'
