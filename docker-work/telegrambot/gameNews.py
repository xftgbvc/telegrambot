# -*- coding: utf-8 -*-
import urllib.request
import dbPostgres
from bs4 import BeautifulSoup

class News:

    url = 'http://gamemag.ru/'
    start = 0
    stop = 5
    page = 1

    def __init__(self, url, page):
        self.url = url
        self.page = page


    def get_html(self, url):
        response = urllib.request.urlopen(url)
        return response.read()

    # Метод - Парсинг HTML сайта
    def parse(self):
        html = self.get_html(self.url + 'news/page/' + str(self.page))
        soup = BeautifulSoup(html)
        pageContent = soup.find('div', id = 'pageContent')
        newsBlock = pageContent.find_all('div', class_ = 'newsblock')
        news = []
        #for row in newsBlock[self.start:self.stop]:
        i = 0
        while len(news) != self.stop:
            newsHeaders = newsBlock[i].find('div', class_='newsheader')
            newsDescription = newsBlock[i].find('div', class_='description')
            try:
                newsDescription = newsDescription.text.strip()
                newsDescription = newsDescription[0:newsDescription.find('\r')]
                newsTitle = newsHeaders.h2.a.text.strip()
                newsTitleLink = newsHeaders.h2.find('a', href=True)
                news.append({
                    'title': newsTitle,
                    'url': newsTitleLink['href'],
                    'description': newsDescription
                })
            except Exception:
                pass

            i = i + 1

        return news

    # Метод - Установить номер последней новости
    def set_stop(self, stop):
        self.stop = int(stop)

    # Метод - Отправить новости
    def send_news(self, bot, message, state):
        newsTitlesDb = ''  # заголовки новостей для бд
        newsItems = self.parse()
        for newsItem in newsItems:
            newsUrl = newsItem['url']
            newsTitle = newsItem['title']
            newsTitlesDb += newsTitle + '\n'
            bot.send_message(message.chat.id, newsUrl, reply_markup=state.keyboard)

        dbPostgres.insertUserMessage(message, newsTitlesDb)  # добавляем запись в БД

