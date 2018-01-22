# -*- coding: utf-8 -*-
import telebot #telegramp api
from youtube import YouTube
from photo import Photo
from audio import Audio
from weather import Weather
from currency import Currency
from constants import *
import gameNews #игровые новости
import dbworker
from statesData import States, db_file
from  statesData import StatesData

bot = telebot.TeleBot(BOT_TOKEN)

news = gameNews.News('http://gamemag.ru/', 1)
youtube = YouTube('PL3485902CC4FB6C67', '50')
photo = Photo()
audio = Audio()
weather = Weather()
currency = Currency()
state = StatesData()
name = ''
print('Бот запущен')

#Логика бота
@bot.message_handler(commands=['start'])
def cmd_start(message):
    state.setEnterName(message.chat.id)
    bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)

@bot.message_handler(commands=['reset'])
def cmd_reset(message):
    state.setEnterName(message.chat.id)
    bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)


@bot.message_handler(commands=['help'])
def handle_command(message):
    answer = HELP
    bot.send_message(message.chat.id, answer)


# Состояние - Знакомство
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_ENTER_NAME.value)
def user_entering_name(message):
    state.setEnterServices(message.chat.id)
    bot.send_message(message.chat.id, message.text + '. ' + state.message, reply_markup=state.keyboard)


# Состояние - Сервисы
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_ENTER_SERVICES.value)
def user_choose_service(message):
    if message.text == 'Погода':
        state.setWeatherRegion(message.chat.id)
    elif message.text == 'Валюта':
        state.setCurrency(message.chat.id)
    elif message.text == 'Фото':
        state.setPhoto(message.chat.id)
    elif message.text == 'Новости':
        state.setNews(message.chat.id)
    elif message.text == 'Аудио':
        state.setAudio(message.chat.id)
    elif message.text == 'Видео':
        state.setYouTube(message.chat.id)

    bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)

# Состояние - Погода/Регион
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_WEATHER_REGION.value)
def user_choose_region(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        state.setWeatherInformation(message.chat.id)
        weather.setCity(message.text)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)

# Состояние - Погода/Информация
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_WEATHER_INFORMATION.value)
def user_choose_weather_information(message):
    if message.text == '⬅':
        state.setWeatherRegion(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    elif message.text == 'Максимальная Температура' or message.text == 'Температура' or message.text == 'Минимальная Температура':
        weather.sendTemperature(bot, message, state)
    elif message.text == 'Влажность':
        weather.sendHumidity(bot, message, state)
    elif message.text == 'Давление':
        weather.sendPressure(bot, message, state)
    elif message.text == 'Ветер':
        weather.sendWind(bot, message, state)

# Состояние - Фото
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_PHOTO.value)
def user_choose_photo(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        photo.send_photo(bot, message, state)

# Состояние - Аудио
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_AUDIO.value)
def user_choose_audio(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        audio.send_audio(bot, message, state)

# Состояние - Видео(YouTube)
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_YOUTUBE.value)
def user_choose_playlist(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        youtube.send_video(bot, message, state)

# Состояние - Новости
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_NEWS.value)
def user_choose_playlist(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        news.set_stop(message.text)
        news.send_news(bot, message, state)


# Состояние - Валюты
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_CURRENCY.value)
def user_choose_currency(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        currency.send_currency(bot, message, state)



bot.polling(none_stop=True, interval=0)