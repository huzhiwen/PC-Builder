import math

class inverted_index:
	def __init__(self):
		# input file
		file_name = '../data/voca_all.txt'
		# bm_25 parameters
		self.k = 1.2
		self.b = 0.75

		self.N = 0
		self.avdl = 0.0
		self.main_index = dict()
		self.type_index = dict()
		self.doc_length = dict()
		self.doc_index = dict()
		
		doc_id = 1

		in_file = open(file_name, 'r')
		for line in in_file:
			doc = line.lower().rstrip().split("	")
			words = doc[0].rstrip().split(" ")
			for word in words:
				self.add(word, doc_id)
				self.doc_length[doc_id] = len(words)
			self.doc_index[doc_id] = doc[0].rstrip()
			self.avdl += len(words)
			self.type_index[doc_id] = doc[1]
			self.N += 1
			doc_id += 1

		in_file.close()
		self.avdl = self.avdl / self.N

	def add(self, word, doc_id):
		if word in self.main_index:
			if doc_id in self.main_index[word]:
				self.main_index[word][doc_id] += 1
			else:
				self.main_index[word][doc_id] = 1
		else:
			self.main_index[word] = dict()
			self.main_index[word][doc_id] = 1

	def doc_set(self, word):
		doc_set = set()
		if word in self.main_index:
			for key in self.main_index[word]:
				doc_set.add(key)
		return doc_set

	def if_indexed(self, word):
		return word in self.main_index

	def pro_name(self, doc_id):
		return self.doc_index[doc_id]

	def pro_type(self, doc_id):
		if (doc_id in self.type_index):
			return self.type_index[doc_id]
		else:
			return 'NON'

	def bm_25(self, word, doc_id):
		num = len(self.main_index[word])
		dl = self.doc_length[doc_id]
		score = math.log((self.N - num + 0.5)/(num + 0.5))
		score = score*(self.k + 1.0)
		score = score / (1.0 + self.k*(1 - self.b + self.b * dl/self.avdl))
		return score