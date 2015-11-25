import sys

file_name = sys.argv[1]
raw_file = open(file_name, 'r')

# query generator
max_length = 0

for data_line in raw_file:
    data_tuple = data_line.rstrip().split("\t")
    idx = data_tuple[0].find(' ')
    print 'INSERT INTO HARD_DRIVE VALUES(',
    if data_tuple[0][0:idx] == 'Western':
        if (len(data_tuple[0][16:]) > max_length):
            max_length = data_tuple[0][16:]
        print "'" + data_tuple[0][16:] + "',",
        print "'" + "Western Digital" + "',",
    else:
        print "'" + data_tuple[0][idx+1:] + "',",
        print "'" + data_tuple[0][0:idx] + "',",
    try:
        print "'" + data_tuple[9][1:] + "',",
    except IndexError:
        print "'0',",
    print "'" + data_tuple[5] + "',",
    print "'" + data_tuple[3] + "',",
    print "'" + data_tuple[4] + "');"

print max_length
raw_file.close()