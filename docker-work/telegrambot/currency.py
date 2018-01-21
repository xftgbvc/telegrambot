# -*- coding: utf-8 -*-
from pycbrf.toolbox import ExchangeRates
import dbPostgres

class Currency:

    currencyDict = {'Доллар': 'USD', 'Евро': 'EUR', 'Фунт': 'GBP', 'Йена': 'JPY', 'Юань': 'CNY'}

    rates = ExchangeRates('2016-06-27', locale_en=True)

    # Метод - отправить валюту
    def send_currency(self, bot, message, state):
        currency = self.rates[self.currencyDict[message.text]]
        answer = message.text + ' : ' + str(currency.value) + ' руб'
        dbPostgres.insertUserMessage(message, answer)  # добавляем запись в БД
        bot.send_message(message.chat.id, answer, reply_markup=state.keyboard)