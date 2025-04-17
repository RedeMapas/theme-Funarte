<?php 
use \MapasCulturais\i;

return [
    /* 
    Define o nome do asset da imagem da logo do site - Substituirá a logo padrão

    ex: `img/meu-mapa-logo.jpg` (pasta assets/img/meu-mapa-logo.jpg do tema) 
    */
    'logo.image' => './img/logo-site.png',
    'logo.hideLabel' => env('LOGO_HIDELABEL', true),

    /* 
    Define o nome do asset da imagem do background e banner no header da home - Substituirá o background padrão
    ex: `img/meu-home-header-background.jpg` (pasta assets/img/meu-home-header-background.jpg do tema)
    */
    //'homeHeader.background' => 'img/banner.png',

    'text:home-header.title' => 'Boas-vindas à Plataforma Rede das Artes',
    'text:home-header.description' => 'Aqui você encontra e participa de uma rede artística de eventos, circuitos, grupos, coletivos e espaços, entre outros elos das artes visuais, do circo, da dança, da música, do teatro e das artes integradas, de todas as regiões do Brasil.<br><br>🚧 Versão Beta – Teste e Avalie 🚧<br><br>Esta é uma versão preliminar da plataforma, disponível para testes. Se encontrar qualquer divergência ou tiver dúvidas, entre em contato com o suporte. Seu feedback é essencial para melhorias!',

    /*
    Define as configurações de ícones de redes sociais do componente main-footer.
    */
    'social-media' => [
        'facebook-icon' => [
            'title' => 'facebook',
            'link' => 'https://www.facebook.com/funarte'
        ],
        'twitter-icon' => [
            'title' => 'twitter',
            'link' => 'https://twitter.com/Funarte'
        ],
        'instagram-icon' => [
            'title' => 'instagram',
            'link' => 'https://www.instagram.com/funarte/'
        ],
        'youtube-icon' => [
            'title' => 'youtube',
            'link' => 'https://www.youtube.com/funarte'
        ]
    ],
];