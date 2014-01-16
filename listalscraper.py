from urllib.request import urlopen
from bs4 import BeautifulSoup
import pickle
import mysql.connector
from twisted.internet import reactor
import twisted.internet.defer
import twisted.web.client
import time

class List(object):
	"""docstring for ClassName"""
	#Constructer
	def __init__(self, movies, url, name, author = "", authorurl = ""):
		super(List, self).__init__()
		self.movies = movies
		self.name = name
		self.author = author
		self.url = url
		self.authorurl = authorurl


def db_conn():
	 conn = mysql.connector.connect(host= "localhost",
                  user="root",
                  passwd="YOURPASSWORD",
                  db="YOURMOVIEDATABASE",
                  use_unicode=True,
                  charset="utf8")
	 return conn

def getListLinks(startPage, endPage):
	urllist = []
	for i in range(startPage, endPage):
		url = "http://www.listal.com/lists/movies/2/" + str(i)
		r = urlopen(url)
		soup = BeautifulSoup(r)
		r.close()
		tabledata = soup.find('table').find_all('td')[0]
		children = tabledata.find_all(recursive=False)
		i = 0
		for child in children:
			if child.name == 'div':
				if i>0:
					a = child.find('a')
					link = a.get('href')
					urllist.append(link)
			i = i+1
	return urllist

def process_lists(urlList):
	validlists = []
	toolongurls  = []
	badorderurls = []
	def handle_one_response(r):
		print("DOWNLOADED PARSING STARTED")
		soup = BeautifulSoup(r)
		#USE IF ISSUES targetdiv = soup.select("#listwrapper")
		#USE IF ISSUES moviedivs = targetdiv.find_all(class_="notesrow")
		listname = soup.find(class_="contentheading").get_text()
		namelink = soup.find(class_="maincontent").find_all("a", limit=2)[1]
		authorurl = namelink.get('href')
		author = namelink.get_text()
		moviedivs = soup.find_all(class_="notesrow")
		i = len(moviedivs)
		movielist = []
		spans = soup.find_all('span')
		j = 1
		valid = True
		for span in spans:
			if i>=50:
				#print("LIST TOO LONG FOR CURRENT SCRAPER")
				toolongurls.append(url)
				valid = False
			if j > i:
				break
			if valid == False:
				break
			parent = span.find_parent()
			string = parent.get_text()
			stringlist = string.split("\t\t\t")
			if len(stringlist) == 4:
				# Otherwise probably a blockquote, indicating this is probably a random span tag that shouldnt be there, maybe a description
				numberandname = stringlist[-2].strip().split(" ", 1)
				number = numberandname[0].split(".", 1)[0]
				name = numberandname[1].strip()
				if str(j) != number:
						#print("LIST NOT ORDERED CORRECTLY (BACKWARDS?)")
						badorderurls.append(url)
						valid = False
				movielist.append(name)
				j = j+1
			else:
				pass
		if valid == True:
			validlist = List(movielist, url, listname, author, authorurl)
			validlists.append(validlist)
	semaphore = twisted.internet.defer.DeferredSemaphore(4)
	dl = twisted.internet.defer.DeferredList([
		semaphore.run(twisted.web.client.getPage, url).addBoth(handle_one_response)
		for url in urlList])
	dl.addBoth(lambda x: reactor.stop())
	reactor.run()

	#dump the urls of lists that were too long or badly formatted to files to view later
	pickle.dump(toolongurls, open('./toolonglists.txt', 'wb'))
	pickle.dump(badorderurls, open('./badlists.txt', 'wb'))
	return validlists

def export_to_db(lists, conn):
	x = conn.cursor()
	x.execute('SET NAMES utf8;')
	x.execute('SET CHARACTER SET utf8;')
	x.execute('SET character_set_connection=utf8;')
	string = """SELECT MAX(list_id) as list_id FROM movieLists"""
	x.execute(string)
	row = x.fetchone()
	print(not row[0])
	if not row[0]:
		listid = 0
	else:
		maxid = row[0]
		listid = int(maxid)+1
	print(listid)
	x.close()
	x = conn.cursor()
	for list in lists:
		for movie in list.movies:
			try:
				print(list.movies)
				sqlstring = """INSERT INTO movieLists (list_id, listname, moviename, list_url, author_name, author_url, category, source) \
							VALUES ("%d", "%s", "%s", "%s", "%s", "%s", "%s", "%s")""" % (listid, list.name, movie, list.url, list.author, list.authorurl, "assorted", "listal")
				#print(sqlstring)
				x.execute(sqlstring)
				conn.commit()
			except:
				print("INSERTION ERROR")
				conn.rollback()
		listid = listid + 1
	conn.close


def startScrape(numberOfPages):
	t0 = time.clock()
	conn = db_conn()
	urls2Download = getListLinks(0, numberOfPages)
	lists = process_lists(urls2Download)
	export_to_db(lists, conn)
	print(time.clock() - t0, "seconds process time")

#################################################################

#START EVERYTHING

#################################################################

startScrape(10)



