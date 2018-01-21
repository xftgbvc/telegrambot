# -*- coding: utf-8 -*-
from constants import MUSIC_CLASSIC_DIRECTORY, MUSIC_ELECTRONIC_DIRECTORY, MUSIC_ROCK_DIRECTORY
import os
import random
import dbPostgres

class Audio:

    directoryDict = {'Рок': MUSIC_ROCK_DIRECTORY, 'Электронная': MUSIC_ELECTRONIC_DIRECTORY,
                     'Классическая': MUSIC_CLASSIC_DIRECTORY}

    def send_audio(self, bot, message, state):
        audioItems = os.listdir(self.directoryDict[message.text])
        randomAudio = random.choice(audioItems)
        logAnswer = randomAudio
        dbPostgres.insertUserMessage(message, logAnswer)  # добавляем запись в БД
        audio = open(self.directoryDict[message.text] + '/' + randomAudio, 'rb')
        bot.send_voice(message.chat.id, audio, caption=randomAudio, timeout=20, reply_markup=state.keyboard)