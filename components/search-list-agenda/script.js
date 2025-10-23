app.component('search-list-agenda', {
    template: $TEMPLATES['search-list-agenda'],

    created() {
        this.currentDate = null;
        this.eventApi = new API('event');
        this.spaceApi = new API('space');
        this.fetchOccurrences();
    },

    data() {
        return {
            occurrences: [],
            loading: false,
            lastQueryHash: null,
            cachedData: {}
        }
    },

    watch: {
        pseudoQuery: {
            handler(){
                const queryHash = this.getQueryHash();

                // Se a query não mudou, não refaz a busca
                if (this.lastQueryHash === queryHash && this.occurrences.length > 0) {
                    return;
                }

                // Verifica se já existe no cache
                if (this.cachedData[queryHash]) {
                    this.occurrences = this.cachedData[queryHash].occurrences;
                    this.lastQueryHash = queryHash;
                    return;
                }

                clearTimeout(this.watchTimeout);
                this.loading = true;
                this.lastQueryHash = queryHash;

                this.watchTimeout = setTimeout(() => {
                    this.fetchOccurrences();
                }, 500)
            },
            deep: true,
        }
    },

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
        }
    },

    computed: {
        groupedEvents() {
            if (!this.groupByEvent) return [];
            const byId = {};
            for (const occ of this.occurrences) {
                const ev = occ.event;
                if (!ev || !ev.id) continue;
                const key = ev.id;
                if (!byId[key]) {
                    byId[key] = { event: ev, occurrences: [] };
                }
                byId[key].occurrences.push(occ);
            }
            return Object.values(byId);
        }
    },

    methods: {
        getQueryHash() {
            return JSON.stringify(this.pseudoQuery) + '_' + this.select + '_' + this.spaceSelect + '_' + this.limit + '_' + this.groupByEvent + '_' + this.perEventLimit;
        },

        async fetchOccurrences() {
            const query = Utils.parsePseudoQuery(this.pseudoQuery);

            this.loading = true;

            if(query['@keyword']) {
                query['event:@keyword'] = query['@keyword'];
                delete query['@keyword'];
            }
            query['event:@select'] = this.select;
            query['space:@select'] = this.spaceSelect;
            query['@limit'] = this.limit;
            query['@page'] = 1;

            const occurrences = await this.eventApi.fetch('occurrences', query, {
                raw: true,
                rawProcessor: (rawData) => Utils.occurrenceRawProcessor(rawData, this.eventApi, this.spaceApi)
            });

            this.occurrences = occurrences;

            // Cache dos dados
            const queryHash = this.getQueryHash();
            this.cachedData[queryHash] = {
                occurrences: [...this.occurrences]
            };

            this.loading = false;
        },



        newDate(occurrence) {
            if (this.currentDate?.date('long') != occurrence.starts.date('long')) {
                this.currentDate = occurrence.starts;
                return true;
            } else {
                return false;
            }
        }
    },
});
