import sys

file_name = sys.argv[1]
raw_file = open(file_name, 'r')

# query generator

for data_line in raw_file:
    data_tuple = data_line.rstrip().split("\t")
    idx = data_tuple[0].find(' ')
    print 'INSERT INTO CASE_ VALUES(',
    if data_tuple[0][0:idx] == 'Cooler':
        print "'" + data_tuple[0][14:] + "',",
        print "'" + "Cooler Master" + "',",
    elif data_tuple[0][0:idx] == 'Fractal':
        print "'" + data_tuple[0][15:] + "',",
        print "'" + "Fractal Design" + "',",
    elif data_tuple[0][0:idx] == 'Athena':
        print "'" + data_tuple[0][13:] + "',",
        print "'" + "Athena Power" + "',",
    else:
        print "'" + data_tuple[0][idx+1:] + "',",
        print "'" + data_tuple[0][0:idx] + "',",
    try:
        print "'" + data_tuple[7][1:] + "',",
    except IndexError:
        print "'0',",
    print "'" + data_tuple[1] + "');"
    # try:
    #     print "'" + data_tuple[5] + "')"
    # except IndexError:
    #     print "'$0')"

raw_file.close()