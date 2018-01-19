# -*- coding: utf-8 -*-

from enum import Enum

db_file = "database.vdb"


class States(Enum):
    """
    Мы используем БД Vedis, в которой хранимые значения всегда строки,
    поэтому и тут будем использовать тоже строки (str)
    """
    S_START = "0"  # Начало нового диалога
    S_ENTER_SERVICES = "1"
    S_WEATHER = "2"
    S_YOUTUBE = "3"
    S_NEWS = "4"
    S_PHOTO = "5"
    S_AUDIO = "6"
