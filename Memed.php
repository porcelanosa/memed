<?php
/**
 * Memed class
 */

namespace Memed;


class Memed
{
    const BR = "\r\n";
    const OK = "OK";
    const END = "END";
    const NOT_FOUND = "NOT_FOUND";
    const STORED = "STORED";
    const DELETED = "DELETED";

    protected $server = '127.0.0.1'; // default server
    protected $port = '11211'; // default memcached port

    /**
     * Memed constructor.
     *
     * @param null $server string
     * @param null $port
     */
    public function __construct($server = null, $port = null)
    {
        if ($server) {
            $this->server = $server;
        }
        if ($port) {
            $this->port = $port;
        }
    }

    /**
     * Get value by key
     *
     * @param $key string
     *
     * @return string
     */
    public function get($key)
    {
        $cmd_str  = "get " . $key . self::BR;
        $response = $this->sendCommand($cmd_str);

        return $response['VALUE'][$key]['value'];
    }

    /**
     * @param $key string
     * @param $value mixed
     * @param int $flags
     * @param int $exptime
     *
     * @return bool
     */
    public function set($key, $value, $flags = 0, $exptime = 3600)
    {
        $size    = strlen($value);
        $cmd_str = "set " . $key . " " . $flags . " " . $exptime . " " . $size . self::BR . $value . self::BR;

        $response = $this->sendCommand($cmd_str);
        var_dump($response);
        var_dump(self::STORED);
        if ($response == self::STORED) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete value by key
     *
     * @param $key
     *
     * @return bool
     */
    public function delete($key)
    {
        $cmd_str  = "delete " . $key . self::BR;
        $response = $this->sendCommand($cmd_str);

        if ($response == self::DELETED) {
            return true;
        } elseif ($response == self::NOT_FOUND) {
            return false;
        } else {
            return false;
        }
    }

    /**
     * Return items statistics, will display items statistics (count, age, eviction, …) organized by slabs ID
     * @return array
     */
    public function getItemsStats()
    {
        $cmd_str  = "stats items" . self::BR;
        $response = $this->sendCommand($cmd_str);

        return $response;
    }

    /**
     * Return slabs statistics, will display slabs statistics (size, memory usage, commands count, …) organized by slabs ID
     * @return array
     */
    public function getSlabsStats()
    {
        $cmd_str  = "stats slabs" . self::BR;
        $response = $this->sendCommand($cmd_str);

        return $response;
    }

    /**
     * @param $command string
     *
     * @return array
     */
    protected function sendCommand($command)
    {
        $server = $this->server;
        $port   = $this->port;
        $socket = @fsockopen($server, $port);
        if ( ! $socket) {
            die("Can not connect to:<b>" . $server . ' by port ' . $port . "\n");
        }
        if (is_resource($socket)) {
            fwrite($socket, $command);
            $buffer = '';
            while (( ! feof($socket))) {
                $buffer .= fgets($socket, 256);
                if (strpos($buffer, self::STORED . self::BR) !== false
                    || strpos($buffer, self::END . self::BR) !== false
                    || strpos($buffer, self::DELETED . self::BR) !== false
                    || strpos($buffer, self::NOT_FOUND . self::BR) !== false
                    || strpos($buffer, self::OK . self::BR) !== false) {
                    break;
                }
            }
            fclose($socket);
        }

        return $this->parseResponse($buffer);
    }

    /**
     * Parse telnet output
     *
     * @param $output string
     *
     * @return array
     */
    protected function parseResponse($output)
    {
        $returned_array  = [];
        $lines           = explode(self::BR, $output);
        $response_lenght = count($lines);
        for ($i = 0; $i < $response_lenght; $i++) {
            $line = $lines[$i];
            $l    = explode(' ', $line, 3);
            if (count($l) == 3) {
                $returned_array[$l[0]][$l[1]] = $l[2];
                if ($l[0] == 'VALUE') { // next line is the value
                    $returned_array[$l[0]][$l[1]] = [];
                    list ($flag, $size) = explode(' ', $l[2]);
                    $returned_array[$l[0]][$l[1]]['stat']  = ['flag' => $flag, 'size' => $size];
                    $returned_array[$l[0]][$l[1]]['value'] = $lines[++$i];
                }
            } elseif (
                $line == self::DELETED
                || $line == self::NOT_FOUND
                || $line == self::OK
                || $line == self::STORED
            ) {
                return $line;
            }
        }

        return $returned_array;
    }
}