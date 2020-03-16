<!DOCTYPE html>
<html>
<head>
  <!-- <title>Upload your files</title> -->
</head>
<body>
  <form enctype="multipart/form-data" action="encrypt.php" method="POST">
    <label for="username">File:</label><br>
    <input type="file" id="file" name="uploaded_file"></input><br />
    <!-- <label for="pwd">Password:</label><br>
    <input type="password" id="pwd" name="passwd"></input><br /> -->
    <input type="submit" value="Upload"></input>
  </form>
</body>
</html>
<?php
    if(!empty($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['uploaded_file']['tmp_name'])) { 
        //&& isset($_POST["passwd"]) && $_POST["passwd"] !== ""
        // if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
            // encrypt($_POST["passwd"], );
            echo "encoded from " . pathinfo(strtolower(basename( $_FILES['uploaded_file']['name'])), PATHINFO_EXTENSION);
            $cipherText = randomCaps(atbash(pathinfo(strtolower(basename( $_FILES['uploaded_file']['name'])), PATHINFO_EXTENSION)));
            $id = random_str(25) . $cipherText;
            echo " to " . $cipherText . "<br />";
            $key = random_str(15);
            // $orin = "./tmp/" . basename( $_FILES['uploaded_file']['name']);
            $orin = $_FILES['uploaded_file']['tmp_name'] ;
            $link  = "http://" . $_SERVER['HTTP_HOST'] . "/@" . $id . "!" . $key;
            echo "origin: " . $orin . "<br />";
            echo "id: " . $id . "<br />";
            echo "key: " . $key . "<br />";
            echo "link: " . $link . "<br />";
            encrypt( $key, $orin, $id);
            // if (!unlink($orin)) die("There was an error encrypting the file, please try again!");
            echo "The file <a href=" . $link . ">" . basename( $_FILES['uploaded_file']['name']) . "</a> has been uploaded";
        // } else {
        //     die("There was an error uploading the file, please try again!");

            // clear vars
            $orin = $key = $id = $cipherText = $link = $_FILES['uploaded_file'] = null;
            unset($orin, $key, $id, $cipherText, $link, $_FILES['uploaded_file']);

        // }
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            die("Error: No file specified."); //or password
        }
    }
    
    function encrypt( $password, $input_file, $output_file) {
        $encrypted_file = './content/' . $output_file;
        $chunk_size = 4096;
        
        $alg = SODIUM_CRYPTO_PWHASH_ALG_DEFAULT;
        $opslimit = SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE;
        $memlimit = SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE;
        $salt = random_bytes(SODIUM_CRYPTO_PWHASH_SALTBYTES);
        
        $secret_key = sodium_crypto_pwhash(SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_KEYBYTES, $password, $salt, $opslimit, $memlimit, $alg);
        
        $fd_in = fopen($input_file, 'rb');
        // $fd_in = fopen('data://text/plain,' . $input_file,'rb');
        // $fd_in = fopen()
        $fd_out = fopen($encrypted_file, 'wb');
        
        fwrite($fd_out, pack('C', $alg));
        fwrite($fd_out, pack('P', $opslimit));
        fwrite($fd_out, pack('P', $memlimit));
        fwrite($fd_out, $salt);
        
        list($stream, $header) = sodium_crypto_secretstream_xchacha20poly1305_init_push($secret_key);
        
        fwrite($fd_out, $header);
        
        $tag = SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_MESSAGE;
        do {
            $chunk = fread($fd_in, $chunk_size);
            if (feof($fd_in)) {
                $tag = SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_FINAL;
            }
            $encrypted_chunk = sodium_crypto_secretstream_xchacha20poly1305_push($stream, $chunk, '', $tag);
            fwrite($fd_out, $encrypted_chunk);
        } while ($tag !== SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_FINAL);
        
        fclose($fd_out);
        fclose($fd_in);
    }

    function random_str(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

    function atbash($text) {

        $text = preg_replace('/[^a-z0-9]/', '', strtolower($text));
      
        $keys = range('a', 'z');
        $values = range('z', 'a');
        $replace_pairs = array_combine($keys, $values);
      
        $translation = strtr($text, $replace_pairs);
        $formatted = trim(chunk_split($translation, 5, ' '));
      
        return $formatted;
      
      }

    function randomCaps($myString) {
        $i=0;
        while($i<strlen($myString)){
            $tmp=$myString[$i];
            if(rand() % 2 ==0) $tmp=strtoupper($tmp);
            else $tmp=strtolower($tmp);
            $myString[$i]=$tmp;
            $i++;
        }
        return $myString;
    }
?>