app.component('agenda-section', {
    template: $TEMPLATES['agenda-section'],

    props: {
        entity: {
            type: Entity,
            required: true,
        },
        agendaLimit: {
            type: Number,
            default: 999999,
        },
        agendaPerEventLimit: {
            type: Number,
            default: 3,
        },
    },

    data() {
        return {
            agendaOccurrences: [],
            agendaLoading: false,
            agendaPage: 1,
            hasAgendaLoaded: false,
        }
    },

    created() {
        this.eventApi = new API('event');
        this.spaceApi = new API('space');
    },

    mounted() {
        this.loadAgenda();
    },

    computed: {
        agendaPseudoQuery() {
            const now = new Date();
            let from = `${now.getFullYear() - 10}-01-01`;
            let to = `${now.getFullYear() + 1}-12-31`;

            try {
                if (this.entity.startsOn) {
                    const y0 = this.entity.startsOn.year();
                    from = `${y0}-01-01`;
                }
                if (this.entity.endsOn) {
                    const y1 = this.entity.endsOn.year();
                    const maxYear = Math.max(y1, now.getFullYear() + 1);
                    to = `${maxYear}-12-31`;
                }
            } catch (e) {}

            return {
                'event:project': this.entity.id,
                '@from': from,
                '@to': to,
            };
        },

        groupedEvents() {
            const byId = {};
            for (const occ of this.agendaOccurrences) {
                const ev = occ.event;
                if (!ev || !ev.id) continue;
                const key = ev.id;
                if (!byId[key]) {
                    byId[key] = { event: ev, occurrences: [] };
                }
                byId[key].occurrences.push(occ);
            }
            return Object.values(byId);
        },

        hasAgendaEvents() {
            return this.agendaOccurrences && this.agendaOccurrences.length > 0;
        },
    },

    methods: {
        async loadAgenda() {
            if (this.agendaLoading) return;

            const query = Utils.parsePseudoQuery(this.agendaPseudoQuery);

            this.agendaLoading = true;

            if (query['@keyword']) {
                query['event:@keyword'] = query['@keyword'];
                delete query['@keyword'];
            }

            query['event:@select'] = 'id,name,subTitle,files.avatar,seals,terms,classificacaoEtaria,singleUrl,project';
            query['space:@select'] = 'id,name,endereco,files.avatar,singleUrl';
            query['@limit'] = this.agendaLimit;
            query['@page'] = 1;

            try {
                const occurrences = await this.eventApi.fetch('occurrences', query, {
                    raw: true,
                    rawProcessor: (rawData) => Utils.occurrenceRawProcessor(rawData, this.eventApi, this.spaceApi)
                });

                this.agendaOccurrences = occurrences;
                this.hasAgendaLoaded = true;
            } catch (error) {
                console.error('Erro ao carregar agenda:', error);
            } finally {
                this.agendaLoading = false;
            }
        },
    },
});

