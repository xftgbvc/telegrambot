# -*- coding: utf-8 -*-

from enum import Enum

db_file = "database.vdb"

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
