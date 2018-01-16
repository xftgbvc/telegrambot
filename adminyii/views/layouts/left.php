<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Сообщения Телеграм', 'icon' => 'envelope-o', 'url' => ['/user-messages']],

                ],
            ]
        ) ?>

    </section>

</aside>
