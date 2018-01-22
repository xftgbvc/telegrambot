# -*- coding: utf-8 -*-
from pycbrf.toolbox import ExchangeRates
import dbPostgres
from time import gmtime, strftime

class Currency:

    currencyDict = {'Доллар': 'USD', 'Евро': 'EUR', 'Фунт': 'GBP', 'Йена': 'JPY', 'Юань': 'CNY'}

    #Взять статистику валют по текущей дате
    rates = ExchangeRates(strftime("%Y-%m-%d", gmtime()), locale_en=True)

    # Метод - Отправить валюту
    def send_currency(self, bot, message, state):
        currency = self.rates[self.currencyDict[message.text]]
        answer = message.text + ' : ' + str(currency.value) + ' руб'
        dbPostgres.insertUserMessage(message, answer)  # добавляем запись в БД
        bot.send_message(message.chat.id, answer, reply_markup=state.keyboard)
