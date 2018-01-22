# -*- coding: utf-8 -*-
import json
from urllib.request import urlopen
from constants import YOUTUBE_API_KEY
import random
import dbPostgres

class YouTube:

    playlistDict = {'Рок': 'PL3485902CC4FB6C67', 'Электронная' : 'PLApUfe4je0BPEjZwUuCgtNHcLrNYSWWf1',
                    'Классическая': 'PLI7WrjTQbM1aNUmDRIx2_eGgVPhKvSOwZ'}
    playlistID = 'PL3485902CC4FB6C67'
    maxresults = '50'

    #  Конструктор
    def __init__(self, playlistID, maxresults):
        if int(maxresults) > 50:
            self.maxresults = '50'
        else:
            self.maxresults = maxresults

        self.playlistID = playlistID


    def setPlaylist(self, category):
        self.playlistID = self.playlistDict[category]

    # Метод - Парсинг ютуб листа
    def parse(self):
        data = urlopen(r'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=' +
                       self.maxresults +'&playlistId=' + self.playlistID + '&key=' + YOUTUBE_API_KEY)

        decoded_response = data.read().decode()
        final_data = json.loads(decoded_response)

        videos = []
        items = final_data['items']

        for item in items:
            videos.append({
                'title': item['snippet']['title'],
                'id' : item['contentDetails']['videoId']
            })

        return videos

    # Метод - отправить видео
    def send_video(self, bot, message, state):
        self.setPlaylist(message.text)
        videos = self.parse()
        randomVideo = random.choice(videos)
        answer = 'https://www.youtube.com/watch?v=' + randomVideo['id']
        logAnswer = randomVideo['title'] + " " + answer
        dbPostgres.insertUserMessage(message, logAnswer)  # добавляем запись в БД
        bot.send_message(message.from_user.id, answer, reply_markup=state.keyboard)  # отпрвляем сообещние в телеграм



