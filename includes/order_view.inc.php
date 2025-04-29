<?php

function order_deleted_successfully(){
    if (isset($_GET['order']) && $_GET['order'] === 'delete'){
        echo'<p>Order Deleted Successfully!</p>';
    }
}