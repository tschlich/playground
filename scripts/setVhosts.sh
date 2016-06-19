#!/usr/bin/env bash

# Run this as sudo!
# Do not run this outside the vaprobash vm!

# back up and delete folder "www"
if [ -d "/vagrant/www" ]; then
  tar -czf "backup_www_$(date '+%Y.%m.%d_%H-%M-%S').tar.gz" /vagrant/www
fi

vhost -d /vagrant/www/frontend/htdocs -s frontend.192.168.19.83.xip.io -a frontend.test1.192.168.19.83.xip.io
vhost -d /vagrant/www/backend/htdocs -s backend.192.168.19.83.xip.io -a backend.192.168.19.83.xip.io

