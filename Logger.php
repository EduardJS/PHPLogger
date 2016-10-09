<?php

    class Logger
    {
        private $file;

        public function __construct($file)
        {
            $this->file = $file;

            if (!file_exists($file)) {
                touch($file);
            }

            if (!(is_writable($file) || $this->win_is_writable($file))) {
                throw new Exception("LOGGER ERROR: Can't write to log", 1);
            }
        }

        public function debug($message)
        {
            $this->writeToLog('DEBUG', $message);
        }

        public function error($message)
        {
            $this->writeToLog('ERROR', $message);
        }

        public function warning($message)
        {
            $this->writeToLog('WARNING', $message);
        }

        public function info($message)
        {
            $this->writeToLog('INFO', $message);
        }

        private function writeToLog($status, $message)
        {
            $message = (is_array($message) ? print_r($message, true) : $message);

            $date = date('[Y-m-d H:i:s]');
            $msg = "$date: [$status] - $message".PHP_EOL;
            file_put_contents($this->file, $msg, FILE_APPEND);
        }

        private function win_is_writable($path)
        {
            if ($path[strlen($path) - 1] == '/') {
                return win_is_writable($path.uniqid(mt_rand()).'.tmp');
            } elseif (is_dir($path)) {
                return win_is_writable($path.'/'.uniqid(mt_rand()).'.tmp');
            }

            $should_delete_tmp_file = !file_exists($path);
            $f = @fopen($path, 'a');
            if ($f === false) {
                return false;
            }

            fclose($f);

            if ($should_delete_tmp_file) {
                unlink($path);
            }

            return true;
        }
    }
