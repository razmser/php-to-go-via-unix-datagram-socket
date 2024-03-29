# About
Small test that checks connection between PHP and Go via non-blocking unix datagarm socket.

# How to run
Run Go part that is listening:
```
go run listen_unix_socket.go
```

Run PHP part that sends data
```
php write_to_socket.php
```

Comment logs to reach maximum performance.

## Tested with
```
~> php -v
PHP 8.1.2-1ubuntu2.14 (cli) (built: Aug 18 2023 11:41:11) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.2, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.2-1ubuntu2.14, Copyright (c), by Zend Technologies

~> go version
go version go1.22.1 linux/amd64

```

## Results
On my laptop so they are not representative.
When PHP and Go each take 100% of single core I get around 0.5% of fails with "Resource temporarily unavailable (code 11)"
