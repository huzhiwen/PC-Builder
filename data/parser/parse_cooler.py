import sys

file_name = sys.argv[1]
raw_file = open(file_name, 'r')

# Arctic Cooling
# be quiet!
# Cooler Master
# Fractal Design
# Gelid Solutions
# Zero Infinity

# query generator

for data_line in raw_file:
	data_tuple = data_line.rstrip().split("\t")
	idx = data_tuple[0].find(' ')
	print 'INSERT INTO COOLING VALUES(',
	if data_tuple[0][0:idx] == 'Arctic':
	    print "'" + data_tuple[0][14:] + "',",
	    print "'" + "Arctic Cooling" + "',",
	elif data_tuple[0][0:idx] == 'be':
	    print "'" + data_tuple[0][9:] + "',",
	    print "'" + "be quiet!" + "',",
	elif data_tuple[0][0:idx] == 'Cooler':
	    print "'" + data_tuple[0][13:] + "',",
	    print "'" + "Cooler Master" + "',",
	elif data_tuple[0][0:idx] == 'Fractal':
	    print "'" + data_tuple[0][13:] + "',",
	    print "'" + "Fractal Design" + "',",
	elif data_tuple[0][0:idx] == 'Gelid':
	    print "'" + data_tuple[0][13:] + "',",
	    print "'" + "Gelid Solutions" + "',",
	elif data_tuple[0][0:idx] == 'Zero':
	    print "'" + data_tuple[0][13:] + "',",
	    print "'" + "Zero Infinity" + "',",
	else:
	    print "'" + data_tuple[0][idx+1:] + "',",
	    print "'" + data_tuple[0][0:idx] + "',",
	try:
	    print "'" + data_tuple[4] + "',",
	except IndexError:
		print "'0',",
	print "'" + data_tuple[1] + "');"

# print max_len
# raw_file.close()