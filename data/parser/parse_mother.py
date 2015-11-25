import sys

file_name = sys.argv[1]
raw_file = open(file_name, 'r')

# query generator

for data_line in raw_file:
    data_tuple = data_line.rstrip().split("\t")
    idx = data_tuple[0].find(' ')
    print 'INSERT INTO MOTHERBOARD VALUES(',
    print "'" + data_tuple[0][idx+1:] + "',",
    print "'" + data_tuple[0][0:idx] + "',",
    try:
        print "'" + data_tuple[7][1:] + "',",
    except IndexError:
        print "'0',",
    print "'" + data_tuple[1] + "',",
    print "'" + data_tuple[2] + "');"
    # try:
    #     print "'" + data_tuple[5] + "')"
    # except IndexError:
    #     print "'$0')"

raw_file.close()