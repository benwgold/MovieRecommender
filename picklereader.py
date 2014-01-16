import pprint, pickle

pkl_file = open('./badlists.txt', 'rb')
data1 = pickle.load(pkl_file)
print('BADLISTS')
pprint.pprint(data1)
pkl_file.close()

pkl_file = open('./toolonglists.txt', 'rb')
data2 = pickle.load(pkl_file)
print('LONG LISTS')
pprint.pprint(data2)
pkl_file.close()