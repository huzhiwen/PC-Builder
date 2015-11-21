
def process_query(query):
	if (split_str(query)):
		return True
	if (remove_char(query) or change_char(query)):
		return True
	if (insert_char(query) or reverse_char(query)):
		return True

	return False

def change_char(query):
	for i in range (0, len(query)):
		left, right = query[0:i], query[i+1:len(query)]
		for c in chars:
			trial = left + c + right
			if (trial in data_set):
				result_set[trial] = data_set[trial]
				return True
	return False

def insert_char(query):
	for i in range (1, len(query) + 1):
		left, right = query[0:i], query[i:len(query)]
		for c in chars:
			trial = left + c + right
			if (trial in data_set):
				result_set[trial] = data_set[trial]
				return True
	return False

def remove_char(query):
	for i in range (1, len(query)):
		left, right = query[0:i], query[i+1:len(query)]
		trial = left + right
		if (trial in data_set):
			result_set[trial] = data_set[trial]
			return True
	return False

def reverse_char(query):
	for i in range (0, len(query)-1):
		 chars = list(query)
		 chars[i], chars[i+1] = chars[i+1], chars[i]
		 trial = ''.join(chars)
		 if (trial in data_set):
			result_set[trial] = data_set[trial]
			return True
	return False

def split_str(query):
	for i in range (1, len(query)):
		left, right = query[0:i], query[i:len(query)]

		if (left in data_set and right in data_set):
			result_set[left] = data_set[left]
			result_set[right] = data_set[right]
			return True

	return False

def data_init():
	
	for i in range (26):
		chars.append(chr(i + ord('a')))

	data_file = open('sample', 'r')

	for data_line in data_file:
		data_pair = data_line.rstrip().split(" ")
		data_set[data_pair[0]] = data_pair[1]

chars = []
query_list = []
data_set = dict()
result_set = dict()

data_init()
query_list = raw_input().split()
query_list = [query.lower() for query in query_list]

for query in query_list:
	if (query not in data_set):
		flag = process_query(query)
	else:
		result_set[query] = data_set[query]

print result_set