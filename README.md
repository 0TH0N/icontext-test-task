Тестовое задание для вакансии в компании iConText.


Задание следующее:

Введение

Есть 36 ячеек (ноль не считаем) и 18 фишек. В одну ячейку можно положить только одну фишку. Пример разложения:

1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20 21 ... 36

$ $ $ $ $ $ $ $ $ $  $  $  $  $  $  $  $  $

Нужно найти и сложить в тестовый файл все возможные варианты таких разложений.

Задача

Вход - два целых числа: fieldsCount - количество ячеек, chipCount - количество фишек (нужен какой-то интерфейс). 
Требуется предоставить все возможные способы расстановки всех фишек по ячейкам. В одну ячейку можно положить только одну фишку.

Выход - текстовый файл, в первой строке указывающий число вариантов, а далее содержащий все подходящие варианты. 
Если вариантов менее 10, файл должен содержать только текст "Менее 10 вариантов". 
Приветствуется самый быстрый и функциональный (протестированный относительно входных данных) вариант.


Пакет опубликован в Composer https://packagist.org/packages/s123/icontexttest . Установка глобально: composer global require s123/icontexttest:dev-master

Программа работает через командную строку. Первым параметром принимает количество ячеек, вторым параметром количество фишек, третий параметр необязательный, имя файла куда необходимо записывать результаты. По-умолчанию записывает в файл "result.txt" в текущей директории.


Задачу решил "в лоб" простым перебором. Возможно и есть какие-то хитрые решения основанные на высшей математике, теории множеств и т.д., но я в этом не силен.


Также учтены варианты на различные окончания слова "вариант" в первой записи файла:

*1 - вариант

*2, *3, *4 - варианта

остальное - вариантов

11, 12, 13, 14 это исключения - вариантов


Операции чтения и записи файлов происходят небольшими кусками во избежании исчерпания ресурсов оперативной памяти и зависания компьютера.