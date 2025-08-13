app.component('home-prosas-notices', {
    template: `
        <div v-show="isReady">
            ${$TEMPLATES['home-prosas-notices']}
        </div>
    `,

    mounted() {
        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://cdn.prosas.com.br/front-sdk/prod/latest/webcomponents.bundle.js';
        document.body.appendChild(script);

        const replaceShadowLabel = () => {
            let changed = false;
            const components = document.querySelectorAll('prosas-listagem-editais');

            components.forEach(el => {
                const shadow = el.shadowRoot;
                if (shadow) {
                    const paragraphs = shadow.querySelectorAll('p');
                    paragraphs.forEach(p => {
                        if (p.textContent.trim() === 'Desenvolvido por') {
                            p.textContent = 'Seção exibida por';
                            changed = true;
                        }
                    });
                }
            });

            if (changed) {
                this.isReady = true;
                observer.disconnect();
            }
        };

        const observer = new MutationObserver(() => replaceShadowLabel());
        observer.observe(document.body, { childList: true, subtree: true });

        const timeoutId = setTimeout(() => replaceShadowLabel(), 1000);

        setTimeout(() => {
            if (!this.isReady) {
                this.isReady = true;
            }
            observer.disconnect();
            clearTimeout(timeoutId);
        }, 8000);
    },

    setup() {
        const text = Utils.getTexts('home-prosas-notices');
        const global = useGlobalState();
        const isReady = Vue.ref(false);
        return { text, global, isReady };
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
