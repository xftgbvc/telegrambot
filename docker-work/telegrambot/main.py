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

#Создание объектов классов
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

#Комманда - /start
@bot.message_handler(commands=['start'])
def cmd_start(message):
    state.setEnterName(message.chat.id)
    bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)

#Комманда - /reset
@bot.message_handler(commands=['reset'])
def cmd_reset(message):
    state.setEnterName(message.chat.id)
    bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)

#Комманда - /help
@bot.message_handler(commands=['help'])
def handle_command(message):
    answer = HELP
    bot.send_message(message.chat.id, answer)


# Состояние - Знакомство
# Если отправлено сообщение и текущее состояние - S_ENTER_NAME, то меняем на S_ENTER_SERVICES
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_ENTER_NAME.value)
def user_entering_name(message):
    state.setEnterServices(message.chat.id)
    bot.send_message(message.chat.id, message.text + '. ' + state.message, reply_markup=state.keyboard)


# Состояние - Сервисы
# Если отправлено сообщение и текущее состояние - S_ENTER_SERVICES,
# то меняем на одно из состояний (S_WEATER_REGION, S_CURRENCY, S_PHOTO, S_AUDIO, S_VIDEO) взависимости от текста сообщения
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
# Если отправлено сообщение и текущее состояние - S_WEATHER_REGION,
# то меняем на одно из состояний (S_ENTER_SERVICES(Назад), S_WEATHER_INFORMATION) взависимости от текста сообщения
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
# Если отправлено сообщение и текущее состояние - S_WEATHER_INFORMATION,
# то меняем на на состояние (S_WEATHER_REGION(Назад)) либо отправляем информацию о погоде(Температура, Влажность, Давление, Ветер)
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
# Если отправлено сообщение и текущее состояние - S_PHOTO,
# то меняем на на состояние (S_ENTER_SERVICES(Назад)) либо отправляем фото
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_PHOTO.value)
def user_choose_photo(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        photo.send_photo(bot, message, state)

# Состояние - Аудио
# Если отправлено сообщение и текущее состояние - S_AUDIO,
# то меняем на на состояние (S_ENTER_SERVICES(Назад)) либо отправляем аудио
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_AUDIO.value)
def user_choose_audio(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        audio.send_audio(bot, message, state)

# Состояние - Видео(YouTube)
# Если отправлено сообщение и текущее состояние - S_YOUTUBE,
# то меняем на на состояние (S_ENTER_SERVICES(Назад)) либо отправляем видео(youtube)
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_YOUTUBE.value)
def user_choose_playlist(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        youtube.send_video(bot, message, state)

# Состояние - Новости
# Если отправлено сообщение и текущее состояние - S_NEWS,
# то меняем на на состояние (S_ENTER_SERVICES(Назад)) либо отправляем видео(youtube)
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_NEWS.value)
def user_choose_playlist(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        news.set_stop(message.text)
        news.send_news(bot, message, state)


# Состояние - Валюты
# Если отправлено сообщение и текущее состояние - S_CURRENCY,
# то меняем на на состояние (S_ENTER_SERVICES(Назад)) либо отправляем информацию о валюте
@bot.message_handler(func=lambda message: dbworker.get_current_state(message.chat.id) == States.S_CURRENCY.value)
def user_choose_currency(message):
    if message.text == '⬅':
        state.setEnterServices(message.chat.id)
        bot.send_message(message.chat.id, state.message, reply_markup=state.keyboard)
    else:
        currency.send_currency(bot, message, state)



bot.polling(none_stop=True, interval=0)