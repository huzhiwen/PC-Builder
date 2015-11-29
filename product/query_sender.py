import socket
import sys
target_host = '127.0.0.1'
target_port = 9998

query = ''
for i in range(1, len(sys.argv)):
	query += sys.argv[i] + ' '

client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client.connect((target_host,target_port))
client.send(query)
response = client.recv(4096)

print response