<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('mc-link');

$entities = [
    'projects' => [
        'image' => 'img/cards/agenda_bg.png',
        'title' => 'Agenda',
        'route' => 'search/events',
        'description' => 'Aqui você pode acompanhar as ações da Rede das Artes: apresentações artísticas, ações de pesquisa, reflexão, intercâmbios, criação, oficinas, cursos, entre outras. Uma agenda cultural que integra iniciativas artísticas de todo o Brasil.',
    ],
    'opportunities' => [
        'image' => 'img/cards/oportunidades_bg.png',
        'title' => 'Oportunidades',
        'route' => 'search/opportunities',
        'description' => 'Acesso a inúmeras possibilidades de conexão com a Rede das Artes. Aqui você encontra atividades com inscrições abertas, como convocatórias, oficinas, intercâmbios e residências artísticas, editais, eventos e demais oportunidades acessíveis. Você também pode criar e ofertar oportunidades para outros agentes da Rede.',
    ],
    'agents' => [
        'image' => 'img/cards/agentes_bg.png',
        'title' => 'Agentes',
        'route' => 'search/agents',
        'description' => 'Acesso a inúmeras possibilidades de conexão com a Rede das Artes. Aqui você encontra atividades com inscrições abertas, como convocatórias, oficinas, intercâmbios e residências artísticas, editais, eventos e demais oportunidades acessíveis. Você também pode criar e ofertar oportunidades para outros agentes da Rede.',
    ],
    'spaces' => [
        'image' => 'img/cards/espacos_bg.png',
        'title' => 'Espaços',
        'route' => 'search/spaces',
        'description' => 'Aqui você encontra espaços culturais e artísticos situados no território nacional que atuam de forma contínua e estruturada e conheça as ações ofertadas e possibilidades de parcerias. São casas de espetáculos e shows, galpões, centros coreográficos, salas de concertos, centros de referência, teatros, lonas circenses e centros culturais. Cadastre também os espaços onde desenvolve suas atividades.',
    ]
];
?>

<div class="home-entities">
  <div class="home-entities__content">
    <div class="home-entities__cards">
      <?php foreach ($entities as $key => $entity): ?>
        <?php $imageUrl = $app->view->asset($entity['image'], false); ?>
        <div v-if="global.enabledEntities.<?= $key ?>" class="card">
          <div class="card__image" style="background-image: url('<?= $imageUrl ?>');">
            <h3><?= i::__($entity['title']) ?></h3>
          </div>
          <div class="card__body">
            <p><?= i::__($entity['description']) ?></p>
            <mc-link route="<?= $entity['route'] ?>">
              <?= i::__('Ver todos') ?>
            </mc-link>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
