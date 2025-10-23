app.component('project-occurrences', {
    template: $TEMPLATES['project-occurrences'],

    props: {
        projectId: {
            type: [Number, String],
            required: true,
        },
        from: {
            type: String,
            default: null, // ISO yyyy-mm-dd; se null, usa hoje
        },
        to: {
            type: String,
            default: null, // ISO yyyy-mm-dd; se null, usa fim do ano
        },
        maxOccurrences: {
            type: Number,
            default: 3,
        },
    },

    data() {
        return {
            loading: true,
            occurrences: [],
        }
    },

    computed: {},

    created() {
        this.eventApi = new API('event');
        this.spaceApi = new API('space');
        this.fetchOccurrences();
    },

    methods: {
        async fetchOccurrences() {
            // período: props.from/to ou [hoje .. fim do ano]
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const from = this.from ?? `${yyyy}-01-01`;
            const to = this.to ?? `${yyyy}-12-31`;

            const query = {
                '@from': from,
                '@to': to,
                '@limit': this.maxOccurrences,
                '@order': 'starts ASC',
                'event:@select': 'id,name,subTitle,files.avatar,seals,terms,classificacaoEtaria,singleUrl,project',
                'space:@select': 'id,name,endereco,files.avatar,singleUrl',
                'event:project': `EQ(${this.projectId})`,
                'event:@permissions': 'view',
                'event:status': 'GTE(0)',
            };

            this.loading = true;
            try {
                const occs = await this.eventApi.fetch('occurrences', query, {
                    raw: true,
                    rawProcessor: (rawData) => Utils.occurrenceRawProcessor(rawData, this.eventApi, this.spaceApi)
                });
                this.occurrences = occs;
            } finally {
                this.loading = false;
            }
        },
    },
});
