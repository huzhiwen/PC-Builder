import signal
import sys
import socket
import threading
import operator

from inverted_index import *

def process_query(query_list):
	trial_list = dict()

	for query in query_list:
		if (not index.if_indexed(query)):
			mutate_list_1 = []
			remove_char(query, mutate_list_1)
			reverse_char(query, mutate_list_1)
			insert_char(query, mutate_list_1)
			replace_char(query, mutate_list_1)

			mutate_list_2 = []
			for trial in mutate_list_1:
				remove_char(trial, mutate_list_2)
				reverse_char(trial, mutate_list_2)
				insert_char(trial, mutate_list_2)
				replace_char(trial, mutate_list_2)

			find_list = []

			for trial in mutate_list_1:
				if (index.if_indexed(trial) and trial not in find_list):
					find_list.append(trial)

			for trial in mutate_list_2:
				if (index.if_indexed(trial) and trial not in find_list):
					find_list.append(trial)

			for trial in find_list:
					trial_list[trial] = 1.0 / len(find_list)
		else:
			trial_list[query] = 1.0

	doc_score = dict()
	result_list = []

	for word in trial_list:
		doc_set = index.doc_set(word)
		for doc in doc_set: 
			if doc in doc_score:
				doc_score[doc] += index.bm_25(word, doc) * trial_list[word]
			else:
				doc_score[doc] = index.bm_25(word, doc) * trial_list[word]

	sorted_score = sorted(doc_score.items(), key=operator.itemgetter(1), reverse=True)

	return sorted_score[0:20]

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

# def split_str(query, cur_dict):
# 	for i in range (1, len(query)):
# 		left, right = query[0:i], query[i:len(query)]
# 		if (left in cur_dict):
# 			result_set[left] = cur_dict[left]
# 		if (right in cur_dict):
# 			result_set[right] = cur_dict[right]

def data_init():
	signal.signal(signal.SIGINT, signal_handler)

	for i in range(10):
		chars.append(str(i))		

	for i in range (26):
		chars.append(chr(i + ord('a')))

def handle_client(client_socket):
	# request = raw_input().lower()
	request = client_socket.recv(1024).lower()
	query_list = request.split()
	query_list = [query for query in query_list]

	sorted_doc = process_query(query_list)

	result = ''
	for key, value in sorted_doc:
		result += index.pro_name(key) + '	'

	print 'writing back'
	client_socket.send(result)
	client_socket.close()

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

index = inverted_index()

data_init()
server_start()