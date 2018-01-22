# -*- coding: utf-8 -*-
import pyowm #погода
import dbPostgres

class Weather:
    owm = pyowm.OWM('ff79e09fdcbbc3e4d6c6a744b0a11f2b')

    cityDict = {'Тверь': 'Tver,RU', 'Москва': 'Moscow,RU',
                    'Санкт-Петербург': 'Saint Petersburg,RU'}
    tempDict = {'Температура' : 'temp', 'Максимальная Температура': 'temp_max', 'Минимальная Температура' : 'temp_min'}
    city = ''
    weather = ''

    # Метод - установить город
    def setCity(self, cityName):
        self.city = self.cityDict[cityName]
        observation = self.owm.weather_at_place(self.city)
        self.weather = observation.get_weather()

    # Метод - отправить температуру
    def sendTemperature(self, bot, message, state):
        temperature = self.weather.get_temperature('celsius')
        answer = message.text + ' : ' + str(temperature[self.tempDict[message.text]])
        dbPostgres.insertUserMessage(message, answer)  # добавляем запись в БД
        bot.send_message(message.chat.id, answer, reply_markup=state.keyboard)

    # Метод - отправить влажность
    def sendHumidity(self, bot, message, state):
        humidity = self.weather.get_humidity()
        answer = message.text + ' : ' + str(humidity)
        dbPostgres.insertUserMessage(message, answer)  # добавляем запись в БД
        bot.send_message(message.chat.id, answer, reply_markup=state.keyboard)

    # Метод - отправить давление
    def sendPressure(self, bot, message, state):
        pressure = self.weather.get_pressure()
        answer = message.text + ' : ' + str(pressure['press'])
        dbPostgres.insertUserMessage(message, answer)  # добавляем запись в БД
        bot.send_message(message.chat.id, answer, reply_markup=state.keyboard)

    # Метод - отправить ветер
    def sendWind(self, bot, message, state):
        wind = self.weather.get_wind()
        answer = message.text + ' : ' + str(wind['speed']) + ' м/с'
        dbPostgres.insertUserMessage(message, answer)  # добавляем запись в БД
        bot.send_message(message.chat.id, answer, reply_markup=state.keyboard)
