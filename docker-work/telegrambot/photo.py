# -*- coding: utf-8 -*-
import random
import os
import dbPostgres
from constants import IMAGES_CATS_DIRECTORY, IMAGES_DOGS_DIRECTORY, IMAGES_HORSES_DIRECTORY

class Photo:
    directoryDict = {'Кошки': IMAGES_CATS_DIRECTORY, 'Собаки': IMAGES_DOGS_DIRECTORY,
                    'Лошади': IMAGES_HORSES_DIRECTORY}

    # функция - отправить фото
    def send_photo(self, bot, message, state):
        directory = self.directoryDict[message.text]
        images = os.listdir(directory)
        randomPhoto = random.choice(images)
        logAnswer = randomPhoto
        dbPostgres.insertUserMessage(message, logAnswer)  # добавляем запись в БД
        img = open(directory + '/' + randomPhoto, 'rb')
        bot.send_photo(message.chat.id, img, reply_markup=state.keyboard)
        img.close()
