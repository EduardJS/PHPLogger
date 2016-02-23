# PHPLogger
Simple and lightweight PHP Logger class

$log = new Logger( ROOT_PATH . '/logs/log.txt' );
$log->info( 'Hello world!' );
$log->debug( array( 'foo' => 'bar' ) );

Make sure you have the `logs` folder writeable and it will output the following:

[2016-02-23 11:15:43]: [INFO] - Hello world!
[2016-02-23 11:15:43]: [DEBUG] - Array
(
    [foo] => bar
)
