<?php
    error_log("test start");
    $path = "test.sock";
    $socket = socket_create(AF_UNIX, SOCK_DGRAM, 0);
    $ok = socket_set_nonblock($socket);
    if (!$ok) {
        error_log("faled to make socket non bloking");
    }


    $ok = socket_connect($socket, $path, 0);
    if (!$ok) {
      $error_code    = socket_last_error($sock);
      $error_message = socket_strerror($error_code);
      error_log("failed to connect $error_message (code $error_code)");
    }

    $success = 0;
    $fail = 0;
    for ($i = 1; $i <= 50_000_000; $i++) {
        $data = "some data $i";
        $ok = socket_send($socket, $data, strlen($data), 0);
        if (!$ok) {
            $fail += 1;
            $error_code    = socket_last_error($socket);
            $error_message = socket_strerror($error_code);
            socket_clear_error($socket);
            error_log("failed to write package $error_message (code $error_code)");
        } else {
            $success += 1;
        }
    }
    $perc = $fail / ($fail + $success) * 100;
    error_log("test end success $success fail $fail ($perc%)");
?>
