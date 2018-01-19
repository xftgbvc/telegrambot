# -*- coding: utf-8 -*-
import telebot #telegramp api
import random
import os
import youtube
from constants import *
import gameNews #игровые новости
from log import log #логи в консоль
import dbPostgres #БД постгрис
import pyowm #погода
import dbworker
import config

bot = telebot.TeleBot(BOT_TOKEN)
news = gameNews.News('http://gamemag.ru/',0, 23, 1)
youtubeplaylist = youtube.YouTubePlayList('PL3485902CC4FB6C67', '50')


owm = pyowm.OWM('ff79e09fdcbbc3e4d6c6a744b0a11f2b')


print('Бот запущен')

#Логика бота
@bot.message_handler(commands=['start'])
def cmd_start(message):
    answer = "Добро Пожаловать " + message.chat.first_name + ' ' + message.chat.last_name + \
             ".Чем могу помочь? Для получения информации воспользутесь коммандой /help"
    bot.send_message(message.chat.id, answer)
    dbworker.set_state(message.chat.id, config.States.S_ENTER_SERVICES.value)


@bot.message_handler(commands=['reset'])
def cmd_reset(message):
    user_markup = telebot.types.ReplyKeyboardMarkup(True, True)
    user_markup.row('/start', '/reset', '/help', '/services')
    bot.send_message(message.chat.id, 'Что ж, начнём по-новой.', reply_markup=user_markup)
    dbworker.set_state(message.chat.id, config.States.S_ENTER_SERVICES.value)


@bot.message_handler(commands=['help'])
def handle_command(message):
    answer = HELP
    log(message, answer)
    bot.send_message(message.chat.id, answer)

@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == config.States.S_ENTER_SERVICES.value)
def user_start(message):
    user_markup = telebot.types.ReplyKeyboardMarkup(True, True)
    user_markup.row('погода', 'фото', 'новости', 'аудио', 'видео', '/reset')
    bot.send_message(message.chat.id, 'Отлично. Выберите, что вас интересует!')
    dbworker.set_state(message.chat.id, config.States.S_WEATHER)



@bot.message_handler(content_types=['text'])
def handle_command(message):
    answer = "Неизветно. Для помощи воспользуйтесь командой /help"
    if message.text == "фото":
        answer = "Выберете категорию фото"
        keyboard = telebot.types.InlineKeyboardMarkup()
        keyboard.add(*[telebot.types.InlineKeyboardButton(text=name, callback_data=name) for name in ['Кот','Собака','Лошадь']])
        log(message, answer)
        bot.send_message(message.chat.id, answer, parse_mode='Markdown', reply_markup=keyboard)

    elif message.text == "новости":
        send_news(message, 1)

    elif message.text == "видео":
        send_video(message)

    elif message.text == "аудио":
        audioItems = os.listdir(MUSIC_DIRECTORY)
        randomAudio = random.choice(audioItems)
        answer = randomAudio
        log(message, answer) #логируем
        dbPostgres.insertUserMessage(message, answer)  # добавляем запись в БД
        audio = open(MUSIC_DIRECTORY + '/' + randomAudio, 'rb')
        bot.send_voice(message.chat.id, audio, caption=randomAudio, timeout=20)


    elif message.text == "локация":
        bot.send_chat_action(message.from_user.id, 'find_location')
        answer = (54.545454, 53.545454)
        log(message, answer) #логируем
        dbPostgres.insertUserMessage(message, answer)  # добавляем запись в БД
        bot.send_location(message.chat.id, *answer)

    elif message.text == "погода":
        answer = 'Выберите город:'
        keyboard = telebot.types.InlineKeyboardMarkup()
        keyboard.add(*[telebot.types.InlineKeyboardButton(text=city, callback_data=city) for city in ['Тверь', 'Москва', 'Санкт-Петербург']])
        log(message, answer)
        bot.send_message(message.chat.id, answer, parse_mode='Markdown', reply_markup=keyboard)



    #неизвестная команда
    else:
        log(message,answer)
        bot.send_message(message.chat.id, answer)




@bot.callback_query_handler(func=lambda c:True)
def handle_command(c):
    if c.data == 'Кошак':
        directory = IMAGES_CATS_DIRECTORY
        send_photo(directory, c)
    elif c.data == 'Собака':
        directory = IMAGES_DOGS_DIRECTORY
        send_photo(directory, c)
    elif c.data == 'Лошадь':
        directory = IMAGES_HORSES_DIRECTORY
        send_photo(directory, c)
    elif c.data == 'moreNews':
        send_news(c.message, news.page + 1)
    elif c.data == 'Тверь':
        cityName = 'Tver,RU'
        send_weather(cityName, c)
    elif c.data == 'Москва':
        cityName = 'Moscow,RU'
        send_weather(cityName, c)
    elif c.data == 'Санкт-Петербург':
        cityName = 'Saint Petersburg,RU'
        send_weather(cityName, c)
    else:
        bot.send_message(c.message.chat.id, "Ошибка. Не найдено")


# функция - отправить погоду
def send_weather(cityName, c):
    observation = owm.weather_at_place(cityName)
    w = observation.get_weather()
    temperature = w.get_temperature('celsius')
    answer = 'Температура: ' + str(temperature['temp']) + ' Максимальная температура: ' + str(temperature['temp_max']) + ' Минимальная температура: ' + str(temperature['temp_min'])
    dbPostgres.insertUserMessage(c.message, answer)  # добавляем запись в БД
    bot.send_message(c.message.chat.id, answer)

#функция - отправить фото
def send_photo(directory, c):
    images = os.listdir(directory)
    randomPhoto = random.choice(images)
    answer = randomPhoto
    log(c.message, answer) # логируем
    dbPostgres.insertUserMessage(c.message, answer)  # добавляем запись в БД
    img = open(directory + '/' + randomPhoto, 'rb')
    bot.send_photo(c.message.chat.id, img)
    img.close()

#функция - отправить новости
def send_news(message, page):
    news.page = page
    newsTitlesDb = '' #заголовки новостей для бд
    newsItems = news.parse()
    for newsItem in newsItems:
        newsUrl = newsItem['url']
        newsTitle = newsItem['title']
        newsTitlesDb += newsTitle + '\n'
        log(message, newsTitle) # логируем
        bot.send_message(message.chat.id, newsUrl)
    dbPostgres.insertUserMessage(message, newsTitlesDb)  # добавляем запись в БД
    keyboard = telebot.types.InlineKeyboardMarkup()
    keyboard.add(telebot.types.InlineKeyboardButton(text='+', callback_data='moreNews'))
    bot.send_message(message.chat.id, '<pre>---------- Загрузить больше новостей ----------</pre>', parse_mode='HTML', reply_markup=keyboard)

#функция - отправить видео
def send_video(message):
    videos = youtubeplaylist.parse()
    randomVideo = random.choice(videos)
    answer = 'https://www.youtube.com/watch?v=' + randomVideo['id']
    logAnswer = randomVideo['title'] + " " + answer
    log(message, logAnswer)  # логируем
    dbPostgres.insertUserMessage(message, logAnswer)  # добавляем запись в БД
    bot.send_message(message.from_user.id, answer) # отпрвляем сообещние в телеграм


bot.polling(none_stop=True, interval=0)