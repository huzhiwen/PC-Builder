import sys

file_name = sys.argv[1]
raw_file = open(file_name, 'r')

# query generator

for data_line in raw_file:
	data_tuple = data_line.rstrip().split("	")
	idx = data_tuple[0].find(' ')
	print 'NSERT INTO CPU VALUES(',
	print "'" + data_tuple[0][idx+1:] + "',",
	print "'" + data_tuple[0][0:idx] + "',",
	print "'" + data_tuple[2] + "',",
	print "'" + data_tuple[1] + "',",
	try:
	    print "'" + data_tuple[5] + "')"
	except IndexError:
		print "'$0')"

raw_file.close()

# dictionary 

# type_dict = dict()
# out_file = open('type_dict', 'wa')
# raw_file = open(file_name, 'r')
# for data_line in raw_file:
# 	data_tuple = data_line.rstrip().split("	")
# 	idx = data_tuple[0].find(' ')
# 	type_dict[data_tuple[0][0:idx]] = 'manufacture'
# 	type_dict[data_tuple[0][idx + 1:len(data_tuple[0])]] = 'model_name'

# raw_file.close()

# for key, value in type_dict.iteritems():
# 	out_file.write(key + "	" + value + "\n")