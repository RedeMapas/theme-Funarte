<?php
use \MapasCulturais\i;

return [
    /*
    Define o nome do asset da imagem da logo do site - Substituirá a logo padrão

    ex: `img/meu-mapa-logo.jpg` (pasta assets/img/meu-mapa-logo.jpg do tema)
    */
    'app.siteName' => 'Rede das Artes',
    'app.siteDescription' => 'Aqui você encontra e participa de uma rede artística de eventos, circuitos, grupos, coletivos e espaços, de todas as regiões do Brasil.',
    'logo.image' => './img/logo-site.png',
    'logo.hideLabel' => env('LOGO_HIDELABEL', true),

    /*
    Define o nome do asset da imagem do background e banner no header da home - Substituirá o background padrão
    ex: `img/meu-home-header-background.jpg` (pasta assets/img/meu-home-header-background.jpg do tema)
    */
    //'homeHeader.background' => 'img/banner.png',

    'text:home-header.title' => 'Boas-vindas à Plataforma Rede das Artes',
    'text:home-header.description' => 'Aqui você encontra e participa de uma rede artística de eventos, circuitos, grupos, coletivos e espaços, entre outros elos das artes visuais, do circo, da dança, da música, do teatro e das artes integradas, de todas as regiões do Brasil.<br><br>🚧 Versão Beta – Teste e Avalie 🚧<br><br>Esta é uma versão preliminar da plataforma, disponível para testes. Se encontrar qualquer divergência ou tiver dúvidas, entre em contato com o suporte. Seu feedback é essencial para melhorias!',
    
    'mailer.templates' => [
        'welcome' => [
            'title' => i::__("Bem-vindo(a) ao Rede das Artes"),
            'template' => 'welcome.html'
        ],
        'last_login' => [
            'title' => i::__("Acesse à Rede das Artes"),
            'template' => 'last_login.html'
        ],
        'new' => [
            'title' => i::__("Novo registro"),
            'template' => 'new.html'
        ],
        'update_required' => [
            'title' => i::__("Acesse à Rede das Artes"),
            'template' => 'update_required.html'
        ],
        'compliant' => [
            'title' => i::__("Denúncia - Rede das Artes"),
            'template' => 'compliant.html'
        ],
        'suggestion' => [
            'title' => i::__("Mensagem - Rede das Artes"),
            'template' => 'suggestion.html'
        ],
        'seal_toexpire' => [
            'title' => i::__("Selo Certificador Expirando"),
            'template' => 'seal_toexpire.html'
        ],
        'seal_expired' => [
            'title' => i::__("Selo Certificador Expirado"),
            'template' => 'seal_expired.html'
        ],
        'opportunity_claim' => [
            'title' => i::__("Solicitação de Recurso de Oportunidade"),
            'template' => 'opportunity_claim.html'
        ],
        'request_relation' => [
            'title' => i::__("Solicitação de requisição"),
            'template' => 'request_relation.html'
        ],
        'start_registration' => [
            'title' => i::__("Inscrição iniciada"),
            'template' => 'start_registration.html'
        ],
        'start_data_collection_phase' => [
            'title' => i::__("Sua inscrição avaçou de fase"),
            'template' => 'start_data_collection_phase.html'
        ],
        'export_spreadsheet' => [
            'title' => i::__("Planilha disponível"),
            'template' => 'export_spreadsheet.html'
        ],
        'export_spreadsheet_error' => [
            'title' => i::__("Houve um erro com o arquivo"),
            'template' => 'export_spreadsheet_error.html'
        ],
        'send_registration' => [
            'title' => i::__("Inscrição enviada"),
            'template' => 'send_registration.html'
        ],
        'claim_form' => [
            'title' => i::__("Solicitação de recurso"),
            'template' => 'claim_form.html'
        ],
        'claim_certificate' => [
            'title' => i::__("Certificado de solicitação de recurso"),
            'template' => 'claim_certificate.html'
        ],

    ],


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
    'routes' => [
        'default_controller_id' => 'site',
        'default_action_name' => 'index',
        'shortcuts' => [
            // busca
            'agentes'           => ['search', 'agents'],
            'eventos'           => ['search', 'events'],
            'espacos'           => ['search', 'spaces'],
            'oportunidades'     => ['search', 'opportunities'],
            'iniciativas'          => ['search', 'projects'],

            // entidades
            'evento'            => ['event', 'single'],
            'usuario'           => ['user', 'single'],
            'agente'            => ['agent', 'single'],
            'espaco'            => ['space', 'single'],
            'iniciativa'        => ['project', 'single'],
            'selo'              => ['seal', 'single'],
            'oportunidade'      => ['opportunity', 'single'],
            'instalacao'        => ['subsite', 'single'],

            'edicao-de-evento'            => ['event', 'edit'],
            'edicao-de-usuario'           => ['user', 'edit'],
            'edicao-de-agente'            => ['agent', 'edit'],
            'edicao-de-espaco'            => ['space', 'edit'],
            'edicao-de-iniciativa'        => ['project', 'edit'],
            'edicao-de-selo'              => ['seal', 'edit'],
            'gestao-de-oportunidade'      => ['opportunity', 'edit'],
            'edicao-de-instalacao'        => ['subsite', 'edit'],

            'configuracao-de-formulario'  => ['opportunity', 'formBuilder'],
            'lista-de-inscricoes'  => ['opportunity', 'registrations'],
            'lista-de-avaliacoes'  => ['opportunity', 'allEvaluations'],

            'avaliacoes'  => ['opportunity', 'userEvaluations'],

            'suporte/lista-de-inscricoes'  => ['support', 'list'],
            'suporte/formulario'  => ['support', 'form'],
            'suporte/configuracao' => ['support', 'supportConfig'],

            'baixar-rascunhos' => ['opportunity', 'reportDrafts'],
            'baixar-inscritos' => ['opportunity', 'report'],
            'baixar-avaliacoes' => ['opportunity', 'reportEvaluations'],

            'avaliacao' => ['registration', 'evaluation'],


            'historico'         => ['entityRevision','history'],

            'sair'              => ['auth', 'logout'],
            'busca'             => ['site', 'search'],
            'sobre'             => ['site', 'page', ['sobre']],
            'como-usar'         => ['site', 'page', ['como-usar']],

            // LGPD
            'termos-de-uso'             => ['lgpd', 'view', ['termsOfUsage']],
            'politica-de-privacidade'   => ['lgpd','view', ['privacyPolicy']],
            'uso-de-imagem'             =>['lgpd', 'view', ['termsUse']],
            'termos-e-condicoes'        => ['lgpd','accept'],

            // painel
            'meus-agentes'             => ['panel', 'agents'],
            'meus-espacos'             => ['panel', 'spaces'],
            'meus-eventos'             => ['panel', 'events'],
            'minhas-iniciativas'       => ['panel', 'projects'],
            'minhas-oportunidades'     => ['panel', 'opportunities'],
            'minhas-inscricoes'        => ['panel', 'registrations'],
            'minhas-avaliacoes'        => ['panel', 'evaluations'],
            'minhas-prestacoes-de-contas'        => ['panel', 'prestacoes-de-conta'],

            'aparencia'               => ['theme-customizer', 'index'],

            'conta-e-privacidade'        => ['panel', 'my-account'],

            'inscricao' => ['registration', 'edit'],
            'inscricao' => ['registration', 'single'],
            'inscricao' => ['registration', 'view'],

            'visualizacao-de-formulario' => ['opportunity', 'formPreview'],

            'gestao-de-usuarios' => ['panel', 'user-management'],

            'certificado' => ['relatedSeal','single'],

            'perguntas-frequentes' => ['faq', 'index'],

            'file/arquivo-privado' => ['file', 'privateFile'],

        ],
        'controllers' => [
            'painel'         => 'panel',
            'inscricoes'     => 'registration',
            'inscricoes'     => 'registration',
            'autenticacao'   => 'auth',
            'anexos'         => 'registrationfileconfiguration',
            'revisoes'       => 'entityRevision',
            'historico'      => 'entityRevision',
            'suporte'        => 'support',
        ],
        'actions' => [
            'acesso'         => 'single',
            'lista'         => 'list',
            'apaga'         => 'delete',
            'edita'         => 'edit',
            'espacos'       => 'spaces',
            'agentes'       => 'agents',
            'eventos'       => 'events',
            'projetos'      => 'projects',
            'oportunidades' => 'oportunities',
            'subsite'       => 'subsite',
            'selos'         => 'seals',
            'inscricoes'    => 'registrations',
            'agente'        => 'agent',
            'evento'        => 'event',
            'inscricao'     => 'registration',
            'prestacoes-de-contas' => 'accountability'
        ],

        'readableNames' => [
            //controllers

            'panel'         => i::__('Painel'),
            'auth'          => i::__('Autenticação'),
            'site'          => i::__('Site'),
            'event'         => i::__('Evento'),       'events'        => i::__('Eventos'),
            'agent'         => i::__('Agente'),       'agents'        => i::__('Agentes'),
            'space'         => i::__('Espaço'),       'spaces'        => i::__('Espaços'),
            'project'       => i::__('Projeto'),      'projects'      => i::__('Projetos'),
            'opportunity'   => i::__('Oportunidade'), 'opportunities' => i::__('Oportunidades'),
            'registration'  => i::__('Inscrição'),    'registrations' => i::__('Inscrições'),
            'file'          => i::__('Arquivo'),      'files'         => i::__('Arquivos'),
            'seal'          => i::__('Selo'),         'seals'         => i::__('Selos'),
            'entityRevision'=> i::__('Histórico'),    'revisions'     => i::__('Revisões'),
            'sealrelation'  => i::__('Certificado'),
            //actions
            'subsite'       => i::__('Subsite'),
            'list'          => i::__('Listando'),
            'index'         => i::__('Índice'),
            'delete'        => i::__('Apagando'),
            'edit'          => i::__('Editando'),
            'create'        => i::__('Criando novo'),
            'search'        => i::__('Busca')
        ]
    ]
];
