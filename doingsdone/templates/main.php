<?php
// показывать или нет выполненные задачи
$category = array();
foreach ($proectL as $list) {
    $category[] = $list['name'];
}
$tableTask = array();
foreach ($taskL as $list) {
    $tableTask[] = Array
    (
        "Задача" => $list['name'],
        "Дата выполнения" => $list['date'],
        "Категория" => $list['category'],
        "Выполнен" => $list['done']
    );
}
$show_complete_tasks = rand(0, 1);
$dateNow = strtotime("now");

function taskCount(array $tasks, $category)
{

    $coun = 0;

    foreach ($tasks as $key => $value) {
        if($value["Категория"]==$category)
        {
            $coun+=1;
        }
    }

    return $coun;
}

function filterText($str) 
{
    $text = htmlspecialchars($str);
    return $text;
}

?>
<div class="content">
            <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list">
                        <?php foreach ($category as $value):?>
                            <li class="main-navigation__list-item">
                            <a class="main-navigation__list-item-link" href="#"><?=filterText($value); ?></a>
                            <span class="main-navigation__list-item-count"><?php print(taskCount($tableTask, $value)); ?></span>
                        </li>
                        <?php endforeach; ?>
                        <!--<li class="main-navigation__list-item">
                            <a class="main-navigation__list-item-link" href="#">Название проекта</a>
                            <span class="main-navigation__list-item-count">0</span>
                        </li>-->
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="pages/form-project.html" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if ($show_complete_tasks == 1):?> checked <?php endif;?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
                    <?php if ($show_complete_tasks == 1):?>
                        <?php foreach ($tableTask as $value):?>
                            <?php if($value['Дата выполнения']!=null) 
                                {
                                    $taskDate = strtotime($value['Дата выполнения']);
                                }   
                            ?>
                            <tr class="tasks__item task <?php if(($taskDate - $dateNow)/86400<=1): ?> task--important <?php endif; ?>">
                                <td class="task__select">
                                    <label class="checkbox task__checkbox">
                                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                                        <span class="checkbox__text"><?=filterText($value["Задача"]);?></span>
                                    </label>
                                </td>

                                <td class="task__file">
                                    <a class="download-link" href="#">Home.psd</a>
                                </td>

                                <td class="task__date">
                                    <?php if ($value["Дата выполнения"] != null):?>
                                        <?=filterText($value["Дата выполнения"]);?>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                    <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
                </table>
            </main>
        </div>