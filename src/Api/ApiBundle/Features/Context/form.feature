# language: ru
Функционал: Регистрация

Сценарий: Регистрация
Если я на странице "/login"
То я должен видеть "username:"
И я должен видеть "Password:"
Если я заполняю поле "Username" значением "admin"
И я заполняю поле "Password" значением "admin"
И я нажимаю "Login"
То я должен быть на странице "/"