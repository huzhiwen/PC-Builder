import signal
import sys
import socket
import threading
import operator

from inverted_index import *

def direct_process(query_list):
	result_set = dict()

	for query in query_list:
		if (index.if_indexed(query)):
			result_set[query] = 1

	return accumlate_score(result_set)

def modified_process(query_list):
	# editing distance 1
	result_set = dict()
	mutate_list_1 = []

	for query in query_list:	
		remove_char(query, mutate_list_1)
		reverse_char(query, mutate_list_1)
		insert_char(query, mutate_list_1)
		replace_char(query, mutate_list_1)

	for trial in mutate_list_1:
		if (index.if_indexed(trial)):
			result_set[trial] = 1

	return accumlate_score(result_set)

def accumlate_score(result_set):
	doc_score = dict()

	for word, num in result_set.iteritems():
		doc_set = index.doc_set(word)
		for doc in doc_set: 
			if doc in doc_score:
				doc_score[doc] += index.bm_25(word, doc)
			else:
				doc_score[doc] = index.bm_25(word, doc)

	sorted_score = sorted(doc_score.items(), key=operator.itemgetter(1))
	return sorted_score

def replace_char(query, mutate_list):
	for i in range (0, len(query)):
		if (query[i] == ' '):
			continue
		left, right = query[0:i], query[i+1:len(query)]
		for c in chars:
			trial = left + c + right
			mutate_list.append(trial)

def insert_char(query, mutate_list):
	for i in range (0, len(query) + 1):
		left, right = query[0:i], query[i:len(query)]
		for c in chars:
			trial = left + c + right
			mutate_list.append(trial)

def remove_char(query, mutate_list):
	for i in range (1, len(query)):
		if (query[i] == ' '):
			continue		
		left, right = query[0:i], query[i+1:len(query)]
		trial = left + right
		mutate_list.append(trial)

def reverse_char(query, mutate_list):
	for i in range (0, len(query)-1):
		if (query[i] == ' '):
			continue	
		chars = list(query)
		chars[i], chars[i+1] = chars[i+1], chars[i]
		trial = ''.join(chars)
		mutate_list.append(trial)

def split_str(query, cur_dict):
	for i in range (1, len(query)):
		left, right = query[0:i], query[i:len(query)]
		if (left in cur_dict):
			result_set[left] = cur_dict[left]
		if (right in cur_dict):
			result_set[right] = cur_dict[right]

def data_init():
	signal.signal(signal.SIGINT, signal_handler)

	for i in range(10):
		chars.append(str(i))		

	for i in range (26):
		chars.append(chr(i + ord('a')))

	data_file = open('data/manu_dict', 'r')

	for data_line in data_file:
		manu = data_line.lower().rstrip()
		voca_dict[manu] = -1

	data_file.close()

def handle_client(client_socket):
	request = raw_input().lower()
	# request = client_socket.recv(1024).lower()
	query_list = request.split()
	query_list = [query for query in query_list]

	dirct_result = direct_process(query_list)
	modified_result = modified_process(query_list)

	print dirct_result
	print modified_result

	# client_socket.send("ACK!")
	# client_socket.close()

def server_start():
	bind_ip = "127.0.0.1"
	bind_port = 9998
	server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	server.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
	server.bind((bind_ip,bind_port))
	server.listen(10)

	while True:
		client,addr = server.accept()
		client_handler = threading.Thread(target=handle_client, args=(client,))
		client_handler.start()

def signal_handler(signal, frame):
	print('Exit')
	sys.exit(0)

chars = []
cur_dict = dict()
voca_dict = dict()

index = inverted_index('data/type_dict')

data_init()
# server_start()
while True:
	handle_client(1)