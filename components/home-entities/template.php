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
        'description' => 'Aqui é espaço de agenda! Você pode acompanhar as ações incluídas na Rede das Artes: apresentações artísticas, ações de pesquisa, reflexão, intercâmbios, criação, oficinas, cursos, entre outras. Inclua e divulgue sua atividade nesta agenda cultural que integra iniciativas artísticas de todo o Brasil.',
    ],
    'opportunities' => [
        'image' => 'img/cards/oportunidades_bg.png',
        'title' => 'Oportunidades',
        'route' => 'search/opportunities',
        'description' => 'Aqui você encontra atividades e chamadas com inscrições abertas, como editais, intercâmbios, residências artísticas e outras oportunidades disponíveis. Você também pode criar e divulgar novas oportunidades para outros agentes da Rede.',
    ],
    'agents' => [
        'image' => 'img/cards/agentes_bg.png',
        'title' => 'Agentes',
        'route' => 'search/agents',
        'description' => 'Aqui você conhece participantes da Rede das Artes e pode se inscrever para fazer parte. São agentes das artes, realizadores de festivais, grupos e coletivos de artes visuais, circo, dança, música, teatro e artes integradas. Conheça e se apresente!',
    ],
    'spaces' => [
        'image' => 'img/cards/espacos_bg.png',
        'title' => 'Espaços',
        'route' => 'search/spaces',
        'description' => 'Aqui você pode inscrever o seu espaço artístico-cultural e divulgar suas ações para o público e possíveis parceiros. Também é possível utilizar o mapa e conhecer uma rede de espaços que atuam de forma contínua e estruturante em todo o país — como casas de espetáculos, galpões, centros coreográficos, salas de concerto, centros de referência, teatros, galerias, lonas circenses e centros culturais.',
    ]
];
?>

<div class="home-entities">
  <div class="home-entities__content">
    <label class="home-entities__content--title"><?= $this->text('title', i::__('ENCONTRE AS INFORMAÇÕES SOBRE A REDE DAS ARTES BRASILEIRAS')) ?></label>
    <div class="home-entities__content--cards">
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
