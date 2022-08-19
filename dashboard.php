<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Dashboard</title>
</head>
<body>
<?php
require "functions.php";

$users_list = url_request('https://user-transaction-fetch-api.herokuapp.com/user');

echo "<div class=\"table\">";
echo_table_row("Name","Email","Status","Transactions");

foreach ($users_list as $user){
        echo_table_row($user->name,$user->email,$user->status,"<input type=\"button\" value=\"$user->name's transactions\" onClick='location.href=\"#$user->id\"'>");

        echo "<div id=\"$user->id\" class=\"modal\">
            <div class=\"modal-body\">
                <div class=\"modal-content\">
                    <div class=\"close\"><input type=\"button\" value=\"Close\" onClick='location.href=\"#close\"'></div>
                    <div class=\"modal-title\">
                        $user->name's transactions
                    </div>
                    <div class=\"modal-table\">";

        $transactions_list = url_request('https://user-transaction-fetch-api.herokuapp.com/transaction/user/' . $user->id);

        if (empty($transactions_list)){
            echo "<div class=\"empty-message\">This user has no transactions.</div>";
        } else {
            echo_table_row("Product","Date","Quantity","Price");

            foreach ($transactions_list as $transaction) {
                $product = $transaction->line;
                echo_table_row($product->product_name,date("Y-m-d H:i:s",$transaction->timestamp),$product->quantity,$product->price);
            }
        }
                        
        echo "</div>
                </div>
            </div>
        </div>";
}

echo "</div>";
?>
</body>
</html>