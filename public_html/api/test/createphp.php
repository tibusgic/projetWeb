<?php
$opts = array(
           'http'=>array(
                   'method'=>'POST',
                   'header'=>'Content-type: application/x-www-form-urlencoded',
                )
);
$opts['http']['content'] = json_encode(
                                       array( 'firstname' => 'John',
						'lastname' => 'Happy',
						'login'=> 'jhappy',
                                             'pass'=> 'john'
                                             ));
$context = stream_context_create($opts);
 
$st = file_get_contents('https://devbox.u-angers.fr/~agodon/api/student/create.php', false, $context);

