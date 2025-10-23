app.component('search-list-agenda-lazy', {
    template: $TEMPLATES['search-list-agenda-lazy'],

    data() {
        return {
            isVisible: false,
            hasLoaded: false,
            observerInitialized: false,
        }
    },

    mounted() {
        // Aguardar múltiplos ticks para garantir que o DOM esteja completamente renderizado
        this.$nextTick(() => {
            setTimeout(() => {
                this.initializeObserver();
            }, 100);
        });
    },

    beforeUnmount() {
        if (this.observer) {
            this.observer.disconnect();
            this.observer = null;
        }
    },

    computed: {},

    props: {
        groupByEvent: {
            type: Boolean,
            default: false,
        },
        perEventLimit: {
            type: Number,
            default: 999999,
        },
        limit: {
            type: Number,
            default: 999999,
        },
        select: {
            type: String,
            default: 'id,name,subTitle,files.avatar,seals,terms,classificacaoEtaria,singleUrl'
        },
        spaceSelect: {
            type: String,
            default: 'id,name,endereco,files.avatar,singleUrl'
        },
        pseudoQuery: {
            type: Object,
            required: true
        },
        loadOnMount: {
            type: Boolean,
            default: false
        }
    },

    created() {
        // Se loadOnMount for true, carrega imediatamente
        if (this.loadOnMount) {
            this.isVisible = true;
            this.hasLoaded = true;
        }
    },

    methods: {
        initializeObserver() {
            const element = this.$refs.lazyContainer || this.$el;

            console.log('Inicializando observer para elemento:', element);

            if (!element) {
                console.warn('Nenhum elemento encontrado, tentando novamente...');
                setTimeout(() => this.initializeObserver(), 200);
                return;
            }

            if (!(element instanceof Element)) {
                console.warn('Elemento não é uma instância de Element:', typeof element, element);
                this.fallbackLoad();
                return;
            }

            if (this.observerInitialized) {
                return;
            }

            try {
                // Verificar se IntersectionObserver está disponível
                if (typeof IntersectionObserver === 'undefined') {
                    console.warn('IntersectionObserver não disponível, carregando imediatamente');
                    this.fallbackLoad();
                    return;
                }

                this.observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        console.log('Intersection Observer triggered:', entry.isIntersecting, this.hasLoaded);
                        if (entry.isIntersecting && !this.hasLoaded) {
                            this.isVisible = true;
                            this.hasLoaded = true;
                            if (this.observer && entry.target) {
                                this.observer.unobserve(entry.target);
                            }
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '100px'
                });

                this.observer.observe(element);
                this.observerInitialized = true;
                console.log('Observer inicializado com sucesso');

            } catch (error) {
                console.error('Erro ao inicializar IntersectionObserver:', error);
                this.fallbackLoad();
            }
        },

        fallbackLoad() {
            console.log('Usando fallback - carregando imediatamente');
            this.isVisible = true;
            this.hasLoaded = true;
        },

        forceLoad() {
            this.isVisible = true;
            this.hasLoaded = true;
        }
    }
});
