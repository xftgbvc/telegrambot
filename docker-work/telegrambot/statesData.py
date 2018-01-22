# -*- coding: utf-8 -*-
import telebot
import dbworker
from enum import Enum

db_file = "database.vdb"

# Перечисление возможных состояний
class States(Enum):
    S_START = "0"  # Начало нового диалога
    S_ENTER_NAME = "1"
    S_ENTER_SERVICES = "2"
    S_WEATHER_REGION = "3"
    S_WEATHER_INFORMATION = "4"
    S_YOUTUBE = "5"
    S_NEWS = "6"
    S_PHOTO = "7"
    S_AUDIO = "8"
    S_CURRENCY = "9"


# Класс - Состояния
class StatesData:
    message = ''
    keyboard = ''
    db = ''
    userID = ''

    # Конструктор
    def __init__(self):
        self.db = dbworker


    # Метод - Установить состояние - Ввод имени
    def setEnterName(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_ENTER_NAME.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('/start', '/reset')
        self.message = 'Добро Пожаловать! Как я могу к тебе обращаться?'

    # Метод - Установить состояние - Выбор сервисов
    def setEnterServices(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_ENTER_SERVICES.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Валюта', 'Погода', 'Фото', 'Новости')
        self.keyboard.row('Видео', 'Аудио', '/help', '/reset')
        self.message = 'Выберите что вас интересует.'

    # Метод - Установить состояние - Погода/Регион
    def setWeatherRegion(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_WEATHER_REGION.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Тверь', 'Москва', 'Санкт-Петербург', '⬅', '/reset')
        self.message = 'Выберите регион.'

    # Метод - Установить состояние - Погода/Информация
    def setWeatherInformation(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_WEATHER_INFORMATION.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Температура', 'Максимальная Температура', 'Минимальная Температура')
        self.keyboard.row('Влажность', 'Давление', 'Ветер', '⬅', '/reset')
        self.message = 'Что вы хотите узнать?'

    # Метод - Установить состояние - Фото
    def setPhoto(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_PHOTO.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Кошки', 'Собаки', 'Лошади', '⬅', '/reset')
        self.message = 'Выберите категорию фото.'

    # Метод - Установить состояние - Аудио
    def setAudio(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_AUDIO.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Рок', 'Электронная', 'Классическая', '⬅', '/reset')
        self.message = 'Выберите тип музыки.'

    # Метод - Установить состояние - Видео(Youtube)
    def setYouTube(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_YOUTUBE.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Рок', 'Электронная', 'Классическая', '⬅', '/reset')
        self.message = 'Выберите плейлист.'

    # Метод - Установить состояние - Новости
    def setNews(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_NEWS.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('5', '10', '15', '20', '⬅', '/reset')
        self.message = 'Выберите желаемое количество новостей.'

    # Метод - Установить состояние - Валюты
    def setCurrency(self, userID):
        self.userID = userID
        self.db.set_state(self.userID, States.S_CURRENCY.value)
        self.keyboard = telebot.types.ReplyKeyboardMarkup(True, True)
        self.keyboard.row('Доллар', 'Евро', 'Фунт', 'Йена', 'Юань', '⬅', '/reset')
        self.message = 'Выберите валюту.'