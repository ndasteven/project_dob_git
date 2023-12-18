cd C:\wampnew64\www\laravel\DOB_POWERGRID
Start-Process "php" -ArgumentList "artisan serve --host=192.168.0.155 --port=9090" -NoNewWindow
Start-Process "php" -ArgumentList "artisan queue:work" -NoNewWindow