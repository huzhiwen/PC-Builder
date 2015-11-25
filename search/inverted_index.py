import numpy

class inverted_index:

	def __init__(self, file_name):
		# bm_25 parameters
		self.k = 1.2
		self.b = 0.75

		self.N = 0
		self.avdl = 0.0
		self.main_index = dict()
		self.doc_length = dict()

		doc_id = 1

		in_file = open(file_name, 'r')
		for doc in in_file:
			words = doc.lower().rstrip().split(" ")
			for word in words:
				self.add(word, doc_id)
				self.doc_length[doc_id] = len(words)
			doc_id += 1
			self.N += 1
			self.avdl += len(words)

		in_file.close()
		self.avdl = self.avdl / self.N

	def add(self, word, doc):
		if word in self.main_index:
			if doc in self.main_index[word]:
				self.main_index[word][doc] += 1
			else:
				self.main_index[word][doc] = 1
		else:
			self.main_index[word] = dict()
			self.main_index[word][doc] = 1

	def doc_set(self, word):
		doc_set = set()
		if word in self.main_index:
			for key in self.main_index[word]:
				doc_set.add(key)
		return doc_set

	def if_indexed(self, word):
		return word in self.main_index

	def bm_25(self, word, doc_id):
		num = len(self.main_index[word])
		dl = self.doc_length[doc_id]
		score = numpy.log((self.N - num + 0.5)/(num + 0.5))
		score = score*(self.k + 1.0)
		score = score / (1.0 + self.k*(1 - self.b + self.b * dl/self.avdl))
		return score
