package main

import (
	"errors"
	"fmt"
	"math"
	"net"
	"os"
)

const path = "test.sock"

func serve(c net.Conn) {
	data := make([]byte, math.MaxUint16)
	for {
		pktLen, readErr := c.Read(data)
		if readErr != nil {
			if errors.Is(readErr, net.ErrClosed) {
				fmt.Println("error connection closed")
				break
			}
			fmt.Println("error:", readErr)
		}
		fmt.Println("message:", string(data[:pktLen]))
	}
}

func main() {
	packetConn, err := net.ListenPacket("unixgram", path)
	if err != nil {
		fmt.Println("listen error", err)
		return
	}
	conn := packetConn.(net.Conn)
	defer func() {
        conn.Close()
		os.Remove(path)
	}()

	serve(conn)
}
