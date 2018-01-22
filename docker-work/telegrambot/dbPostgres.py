import postgresql #импорт библиотекки постгрис
from datetime import datetime

db = postgresql.open('pq://west223:westwest223@dbpostgres:5432/telegram_db')

#Вставить запись в таблицу user_messages
def insertUserMessage(message, answer):
    insertDBUserMessage = db.prepare(
        "INSERT INTO user_messages (request_message, response_message, user_id, user_name, created_at)"
        " VALUES ($1, $2, $3, $4, $5)")


    userName = str(message.chat.first_name) + " " + str(message.chat.last_name)

    insertDBUserMessage(message.text, str(answer), message.from_user.id, userName, datetime.now())  # вставляем в бд



