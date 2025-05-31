app.component('home-prosas-notices', {
    template: $TEMPLATES['home-prosas-notices'],

    setup(props) {
        // os textos estão localizados no arquivo texts.php deste componente 
        const text = Utils.getTexts('home-prosas-notices');
        const global = useGlobalState();
        
        // Adiciona os componentes que acessam a API do Prosas.
        let script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://cdn.prosas.com.br/front-sdk/prod/latest/webcomponents.bundle.js';
        document.body.appendChild(script);

        return { text, global }
    },

    props: {
        clientId: {
            type: String,
            required: true
        },
        
        idList: {
            type: String
        }
    }
});