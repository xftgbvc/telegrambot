def log(message,answer):
    print("\n -----")
    from datetime import datetime
    print(datetime.now())

    requestMessage = "Сообщение от {0} {1} (id = {2})\nТекст - {3}".format(str(message.chat.first_name), str(message.chat.last_name),
                                                        str(message.from_user.id),
                                                        message.text)
    responseMessage = "Ответ - {0}".format(answer)

    print(requestMessage)
    print(responseMessage)

