# -*- coding: utf-8 -*-
import telebot
import config
import dbworker

class StatesData:
    message = ''
    keyboard = ''
    db = ''
    userID = ''


    def __init__(self):
        self.db = dbworker


    def setEnterName(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_ENTER_NAME.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('/start', '/reset')
        self.message = 'Добро Пожаловать! Как я могу к тебе обращаться?'

    def setEnterServices(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_ENTER_SERVICES.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Валюта', 'Погода', 'Фото', 'Новости')
        self.keyboard.row('Видео', 'Аудио', '/help', '/reset')
        self.message = 'Выберите что вас интересует.'

    def setWeatherRegion(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_WEATHER_REGION.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Тверь', 'Москва', 'Санкт-Петербург', '⬅', '/reset')
        self.message = 'Выберите регион.'

    def setWeatherInformation(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_WEATHER_INFORMATION.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Температура', 'Максимальная Температура', 'Минимальная Температура')
        self.keyboard.row('Влажность', 'Давление', 'Ветер', '⬅', '/reset')
        self.message = 'Что вы хотите узнать?'

    def setPhoto(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_PHOTO.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Кошки', 'Собаки', 'Лошади', '⬅', '/reset')
        self.message = 'Выберите категорию фото.'


    def setAudio(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_AUDIO.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Рок', 'Электронная', 'Классическая', '⬅', '/reset')
        self.message = 'Выберите тип музыки.'


    def setYouTube(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_YOUTUBE.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Рок', 'Электронная', 'Классическая', '⬅', '/reset')
        self.message = 'Выберите плейлист.'

    def setNews(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_NEWS.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('5', '10', '15', '20', '⬅', '/reset')
        self.message = 'Выберите желаемое количество новостей.'

    def setCurrency(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, config.States.S_CURRENCY.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Доллар', 'Евро', 'Фунт', 'Йена', 'Юань', '⬅', '/reset')
        self.message = 'Выберите валюту.'