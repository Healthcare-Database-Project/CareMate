<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel & MySQL Connection Status</title>
</head>
<body>
    <div>
        <?php
            use Illuminate\Support\Facades\DB;
            if(DB::connection()->getPdo()){
                echo "Successfully Connected to DB, DB name is ".DB::connection()->getDatabaseName();
            }
        ?>
    </div>
</body>
</html>