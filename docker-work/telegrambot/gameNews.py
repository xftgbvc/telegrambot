import urllib.request
from bs4 import BeautifulSoup

class News:

    url = 'http://gamemag.ru/'
    start = 0
    stop = 23
    page = 1

    def __init__(self, url, start, stop, page):
        self.url = url
        self.start = start
        self.stop = stop
        self.page = page


    def get_html(self, url):
        response = urllib.request.urlopen(url)
        return response.read()


    def parse(self):
        html = self.get_html(self.url + 'news/page/' + str(self.page))
        soup = BeautifulSoup(html)
        pageContent = soup.find('div', id = 'pageContent')
        newsBlock = pageContent.find_all('div', class_ = 'newsblock')
        news = []

        for row in newsBlock[self.start:self.stop]:
            newsHeaders = row.find('div', class_= 'newsheader')
            newsDescription = row.find('div', class_='description')
            try:
                newsDescription = newsDescription.text.strip()
                newsDescription = newsDescription[0:newsDescription.find('\r')]
                newsTitle = newsHeaders.h2.a.text.strip()
                newsTitleLink = newsHeaders.h2.find('a', href=True)
                news.append({
                    'title' : newsTitle,
                    'url' : newsTitleLink['href'],
                    'description': newsDescription
                })
            except Exception:
                pass

        return news
