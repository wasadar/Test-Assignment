<?php
    function url_request($url){
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $data = curl_exec($ch);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error != ""){
            return $error;
        } else {
            return json_decode($data);
        }
    }

    function echo_table_row($first,$second,$third,$fourth){
        echo "<div class=\"table-row\">
            <div class=\"table-cell\">$first</div>
            <div class=\"table-cell\">$second</div>
            <div class=\"table-cell\">$third</div>
            <div class=\"table-cell\">$fourth</div>
        </div>";
    }
?>