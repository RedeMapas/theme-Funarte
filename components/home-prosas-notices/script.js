app.component('home-prosas-notices', {
    template: $TEMPLATES['home-prosas-notices'],

    mounted() {
        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://cdn.prosas.com.br/front-sdk/prod/latest/webcomponents.bundle.js';
        document.body.appendChild(script);

        const replaceShadowLabel = () => {
            const components = document.querySelectorAll('prosas-listagem-editais');

            components.forEach(el => {
                const shadow = el.shadowRoot;
                if (shadow) {
                    const paragraphs = shadow.querySelectorAll('p');
                    paragraphs.forEach(p => {
                        if (p.textContent.trim() === 'Desenvolvido por') {
                            p.textContent = 'Seção exibida por';
                        }
                    });
                }
            });
        };

        const observer = new MutationObserver(() => replaceShadowLabel());
        observer.observe(document.body, { childList: true, subtree: true });

        const timeoutId = setTimeout(() => replaceShadowLabel(), 1000);

        setTimeout(() => {
            observer.disconnect();
            clearTimeout(timeoutId);
        }, 5000);
    },

    setup(props) {
        const text = Utils.getTexts('home-prosas-notices');
        const global = useGlobalState();
        return { text, global };
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
