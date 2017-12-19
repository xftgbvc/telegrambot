<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Сообщения Телеграм', 'icon' => 'envelope-o', 'url' => ['/user-messages']],
                    ['label' => 'Фильмы', 'icon' => 'film', 'url' => ['/film']],
                    ['label' => 'Персоны', 'icon' => 'group', 'url' => ['/person']],
                    ['label' => 'Города', 'icon' => 'home', 'url' => ['/city']],
                    ['label' => 'Страны', 'icon' => 'globe', 'url' => ['/country']],
                    ['label' => 'Жанры', 'icon' => 'bars', 'url' => ['/genre']],
                    ['label' => 'Типы Персон', 'icon' => 'reorder', 'url' => ['/person-type']],
                ],
            ]
        ) ?>

    </section>

</aside>
