<?php

$_lang['quickstartbuttons'] = "Quickstart Buttons";
$_lang['quickstartbuttons.menu_desc'] = "Управление разделами и кнопками виджета";
$_lang['quickstartbuttons.manage'] = "Управление разделами и кнопками виджета Quickstart";
$_lang['quickstartbuttons.search'] = "Поиск…";
$_lang['quickstartbuttons.none'] = "Не назначена";
$_lang['quickstartbuttons.general'] = "Основные";

// sets part
$_lang['quickstartbuttons.sets'] = "Разделы";
$_lang['quickstartbuttons.sets_desc'] = "Список ниже содержит все разделы вашего виджета для главной страницы панели управления MODX. Вы можете настроить кнопки для каждого раздела и назначить для них определённые группы пользователей.";
$_lang['quickstartbuttons.sets.create'] = "Добавить новый раздел";
$_lang['quickstartbuttons.sets.name'] = "Название раздела";
$_lang['quickstartbuttons.sets.description'] = "Описание";
$_lang['quickstartbuttons.sets.btnscount'] = "Номер кнопки";
$_lang['quickstartbuttons.sets.usergroups'] = "Группа пользователей";
$_lang['quickstartbuttons.sets.active'] = "Активна";
$_lang['quickstartbuttons.sets.buttonsperrow'] = "Количество кнопок в ряду";
$_lang['quickstartbuttons.sets.buttonsperrow.one'] = "Одна кнопка";
$_lang['quickstartbuttons.sets.buttonsperrow.two'] = "Две кнопки";
$_lang['quickstartbuttons.sets.buttonsperrow.three'] = "Три кнопки";
$_lang['quickstartbuttons.sets.buttonsperrow.four'] = "Четыре кнопки";
$_lang['quickstartbuttons.sets.buttonsperrow.five'] = "Пять кнопок";

$_lang['quickstartbuttons.sets.update'] = "Обновить раздел";
$_lang['quickstartbuttons.sets.duplicate'] = "Копировать раздел";
$_lang['quickstartbuttons.sets.remove'] = "Удалить раздел";
$_lang['quickstartbuttons.sets.remove_confirm'] = "Вы уверены, что хотите удалить этот раздел с кнопками? Это действие нельзя отменить!";

// buttons part
$_lang['quickstartbuttons.buttons'] = "Кнопки";
$_lang['quickstartbuttons.buttons_desc'] = "Ниже расположены кнопки, настраиваемые в этом разделе.";
$_lang['quickstartbuttons.buttons.create'] = "Добавить новую кнопку";

$_lang['quickstartbuttons.buttons.text'] = "Текст кнопки";
$_lang['quickstartbuttons.buttons.description'] = "Описание";
$_lang['quickstartbuttons.buttons.ranking'] = "Расположение";
$_lang['quickstartbuttons.buttons.active'] = "Активная";

$_lang['quickstartbuttons.buttons.icon'] = "Иконка";
$_lang['quickstartbuttons.buttons.icon.preset'] = "Найти и выбрать предустановленную иконку";
$_lang['quickstartbuttons.buttons.icon.or'] = "Или выбрать собственную иконку из списка ниже";
$_lang['quickstartbuttons.buttons.icon.ms'] = "Источник файлов для поиска иконок";
$_lang['quickstartbuttons.buttons.icon.select'] = "Выбрать иконку из источника файлов";

$_lang['quickstartbuttons.buttons.link'] = "Ссылка";
$_lang['quickstartbuttons.buttons.link_desc'] = "Ниже вы можете настроить действие для кнопки. Приоритет полей распространяется сверху вниз, т. е. если вы укажите системный процессор, то JavaScript обработчик и поле со ссылкой будут проигнорированы. А если вы оставите первое поле пустым и установите значение JavaScript обработчика, оно «перекроет» значение ссылки.";
$_lang['quickstartbuttons.buttons.link.action'] = "Системные процессоры";
$_lang['quickstartbuttons.buttons.link.action_props'] = "Дополнительные настройки системных процессоров";
$_lang['quickstartbuttons.buttons.link.action_props_desc'] = "Дополнительное свойство для системного процессора. Не должно начинаться с символа «?» или «&amp;».<br />Например: parent=10&amp;template=1&amp;class_key=modResource.";
$_lang['quickstartbuttons.buttons.link.handler'] = "Javascript обработчик";
$_lang['quickstartbuttons.buttons.link.handler_desc'] = "Например MODX обработчик очистки кеша: <b>MODx.clearCache();</b>. Этот вызов автоматически добавляет 'return false;' к ссылке.";
$_lang['quickstartbuttons.buttons.link.full'] = "Полная ссылка";
$_lang['quickstartbuttons.buttons.link.newwindow'] = "Открыть в новой вкладке (окне)";

$_lang['quickstartbuttons.buttons.update'] = "Обновить кнопку";
$_lang['quickstartbuttons.buttons.remove'] = "Удалить кнопку";
$_lang['quickstartbuttons.buttons.remove_confirm'] = "Вы уверены, что хотите удалить \"[[+text]]\" из раздела?";

// usergroups part
$_lang['quickstartbuttons.usergroups'] = "Группы пользователей";
$_lang['quickstartbuttons.usergroups_desc'] = "Здесь вы можете назначить группы пользователей, которые будут использовать этот раздел кнопок. Если группа не назначена, все пользователи смогут использовать этот раздел.";
$_lang['quickstartbuttons.usergroups.add'] = "Добавить группу пользователей";
$_lang['quickstartbuttons.usergroups.name'] = "Имя группы пользователей";
$_lang['quickstartbuttons.usergroups.remove'] = "Удалить группу пользователей";
$_lang['quickstartbuttons.usergroups.remove_confirm'] = "Вы уверены, что хотите удалить группу пользователей \"[[+name]]\" из раздела?";