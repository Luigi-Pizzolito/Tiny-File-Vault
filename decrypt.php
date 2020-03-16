<?php
    //requires password and file path
    if (!isset($_GET["param"])) {
        // header("Location: http://www.luigipizzolito.com/vault/content/", true, 403);
        header("", true, 403);
        die();
    }
    $param = $_GET["param"];
    $param_arr = explode("!", $param);
    $file = urldecode($param_arr[0]);
    $password = urldecode($param_arr[1]);
    require 'mime-types.php';
    $encrypted_file = './content/' . $file;

    if (!file_exists($encrypted_file)) {
        // header("Location: http://www.luigipizzolito.com/vault/content/", true, 404);
        header("", true, 404);
    }

    $chunk_size = 4096;

    $cipher = atbash(strtolower(substr($file, strlen($file) - 3)));
    $mime = substr($file, 0, -3) . "." . $cipher;
    header('Content-Type: ' . getMimeType($mime));

    $fd_in = fopen($encrypted_file, 'rb');
    // $fd_out = fopen($decrypted_file, 'wb');
    $fd_out = "";

    $alg = unpack('C', fread($fd_in, 1))[1];
    $opslimit = unpack('P', fread($fd_in, 8))[1];
    $memlimit = unpack('P', fread($fd_in, 8))[1];
    $salt = fread($fd_in, SODIUM_CRYPTO_PWHASH_SALTBYTES);

    $header = fread($fd_in, SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_HEADERBYTES);

    $secret_key = sodium_crypto_pwhash(SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_KEYBYTES, $password, $salt, $opslimit, $memlimit, $alg);

    $stream = sodium_crypto_secretstream_xchacha20poly1305_init_pull($header, $secret_key);
    do {
        $chunk = fread($fd_in, $chunk_size + SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_ABYTES);
        $res = sodium_crypto_secretstream_xchacha20poly1305_pull($stream, $chunk);
        if ($res === FALSE) {
        break;
        }
        list($decrypted_chunk, $tag) = $res;
        // fwrite($fd_out, $decrypted_chunk);
        echo $decrypted_chunk;
    } while (!feof($fd_in) && $tag !== SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_FINAL);
    $ok = feof($fd_in);

    // fclose($fd_out);
    // echo $fd_out;
    fclose($fd_in);

    if (!$ok) {
        // header("Location: http://www.luigipizzolito.com/vault/content/", true, 403);
        header("", true, 403);
        die();
    }

    //clear vars
    $param = $param_arr = $file = $password = $encrypted_file = $alg  = $opslimit = $memlimit = $salt = $header = $secret_key = $stream = $chunk = $res = $decrypted_chunk = $tag = $fd_in = $fd_out = $ok = $_GET["param"] = null;
    unset($param, $param_arr, $file, $password, $encrypted_file, $alg, $opslimit, $memlimit, $salt, $header, $secret_key, $stream, $chunk, $res, $decrypted_chunk, $tag, $fd_in, $fd_out, $ok, $_GET["param"]);

    function atbash($text) {

        $text = preg_replace('/[^a-z0-9]/', '', strtolower($text));
      
        $keys = range('a', 'z');
        $values = range('z', 'a');
        $replace_pairs = array_combine($keys, $values);
      
        $translation = strtr($text, $replace_pairs);
        $formatted = trim(chunk_split($translation, 5, ' '));
      
        return $formatted;
      
      }
?>