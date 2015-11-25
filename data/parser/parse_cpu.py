import sys

file_name = sys.argv[1]
raw_file = open(file_name, 'r')

# query generator

for data_line in raw_file:
	data_tuple = data_line.rstrip().split("	")
	idx = data_tuple[0].find(' ')
	print 'INSERT INTO CPU VALUES(',
	print "'" + data_tuple[0][idx+1:] + "',", # model_name
	print "'" + data_tuple[0][0:idx] + "',", # manu
	try:
	    print "'" + data_tuple[5] + "',",
	except IndexError:
		print "'0',",
	print "'" + data_tuple[2] + "',",
	print "'" + data_tuple[1] + "');"

print max_len
raw_file.close()