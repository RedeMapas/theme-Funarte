app.component('search-filter-project', {
    template: $TEMPLATES['search-filter-project'],

    setup() {
        // os textos estão localizados no arquivo texts.php deste componente
        const text = Utils.getTexts('search-filter-project')
        return { text }
    },

    props: {
        position: {
            type: String,
            default: 'list'
        },
        pseudoQuery: {
            type: Object,
            required: true
        }
    },

    data() {
        const allowedSealIds = $MAPAS.config.funarteCircuitoSeals;
        const filteredSeals = $MAPAS.config.entityTable.seals.filter(seal =>
            allowedSealIds.includes(seal.id)
        );
        return {
            types: $DESCRIPTIONS.project.type.options,
            sealsNames: filteredSeals.map(seal => ({
                // use string values to match mc-multiselect's internal key handling
                value: String(seal.id),
                label: seal.name
            })),
            // keep labels indexed by stringified id for consistency
            sealsLabels: Object.fromEntries(filteredSeals.map(seal => [String(seal.id), seal.name])),
        }
    },

    computed: {
    },

    methods: {
        normalizeSelectedSeals() {
            if (Array.isArray(this.pseudoQuery['@seals'])) {
                // ensure all values are strings and remove duplicates
                const normalized = Array.from(new Set(this.pseudoQuery['@seals'].map(v => String(v))));
                this.pseudoQuery['@seals'] = normalized;
            }
        },
        clearFilters() {
            const types = ['string', 'boolean'];
            for (const key in this.pseudoQuery) {
                if (Array.isArray(this.pseudoQuery[key])) {
                    this.pseudoQuery[key] = [];
                } else if (types.includes(typeof this.pseudoQuery[key])) {
                    delete this.pseudoQuery[key];
                }
            }
        }
    },

    mounted() {
        // Normalize on mount so preselected seals appear checked and non-duplicable
        this.normalizeSelectedSeals();
    },
});
