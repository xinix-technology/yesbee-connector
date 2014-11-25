<?php

namespace Test;

header('Content-type: application/json');

$ret = array(
		"refnum" => "xyz:asd420fE",
	    "store_id" => "xyz",
	    "amount" => 123456,
	    "fee" => 12345,
	    "total" => 123456 + 12345
    );

echo json_encode($ret);