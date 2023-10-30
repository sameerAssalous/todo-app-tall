
## Todo App TALL Stack
video show
https://www.loom.com/share/4073ba0e0a1f4e349f6a318d37a79af8

## How to run the app 
`./vendor/bin/sail up` to create docker containers

`./vendor/bin/sail php artisan migrate` to run DB migrations 

`./vendor/bin/sail php artisan db:seed --class=MailProviderSeeder` to seed mail_providers table default records in the DB

update `.env` file with mail driver configs and redis config to be connection queue


`php artisan queue:work --tries=3`  to start queue working

- Inorder to parse huge numbers of email queued notifications 
you should install `supervisor` and update its configurations to run multiple workers .
`sudo apt-get install supervisor`

create file `/etc/supervisor/laravel-worker.conf`
[program:laravel-worker]
`process_name=%(program_name)s_%(process_num)02d
command=php /home/forge/app.com/artisan queue:work sqs --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/home/forge/app.com/worker.log
stopwaitsecs=3600`

- `numprocs=8` will create 8 workers , you might need to decrease/increase depend on load you might have and max time of every job

- You might need to use autoscaling service like AWS autoscaling group service to deal with queues load on memory or CPU 


