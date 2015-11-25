import sys

file_name = sys.argv[1]
query_file = open(file_name, 'r')

# query generator

max_len = 0

for query in query_file:
	sta_idx = query.find('\'')
	end_idx = query.find(',')
	cur_len = end_idx - sta_idx - 1
	if (cur_len > max_len):
		max_len = cur_len

print max_len
query_file.close()