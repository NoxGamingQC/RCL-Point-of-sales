@echo on
net stop http /y
php artisan serve --host 192.168.2.13 --port 80

pause