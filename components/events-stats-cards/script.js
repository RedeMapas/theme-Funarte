app.component('events-stats-cards', {
    template: $TEMPLATES['events-stats-cards'],

    props: {
        pseudoQuery: {
            type: Object,
            required: true
        }
    },

    created () {
        this.eventApi = new API('event', 'default');
        this.areLastSevenDaysEventsFetched = false;

        this.fetchStats();
    },

    data () {
        return {
            countRegisteredEvents: '--',
            countOccurrences: '--',
            countFinishedOcurrences: '--',
            countLastSevenDaysEvents: '--'
        };
    },

    watch: {
        pseudoQuery: {
            async handler () {
                this.countRegisteredEvents = '--';
                this.countOccurrences = '--';
                this.countFinishedOcurrences = '--';
                this.fetchStats();
            },
            deep: true,
        }
    },

    methods: {
        async fetchStats () {
            // Checagem para evitar de consultar eventos cadastrados nos últimos 7 dias toda vez que a pseudoQuery atualizar.
            if (!this.areLastSevenDaysEventsFetched) {
                const now = Date.now();

                let sevenDaysAgo = new McDate(now);
                sevenDaysAgo.addDays(-7);

                const lastSevenDaysEvents = await this.eventApi.find({"createTimestamp": "BET(" + sevenDaysAgo.sql("full") + "," + (new McDate(now)).sql("full") + ")"});
                this.countLastSevenDaysEvents = lastSevenDaysEvents.length;

                areLastSevenDaysEventsFetched = true;
            }

            let query = Utils.parsePseudoQuery(this.pseudoQuery);

            if(query['@keyword']) {
                query['event:@keyword'] = query['@keyword'];
                delete query['@keyword'];
            }
            query['event:@select'] = 'id,name,subTitle,files.avatar,seals,terms,classificacaoEtaria,singleUrl';

            const occurrences = await this.eventApi.fetch('occurrences', query, {
                raw: true,
                rawProcessor: (rawData) => this.occurrenceRawProcessor(rawData)
            });

            this.countRegisteredEvents = (new Set(occurrences.map(occurrence => occurrence.event_id))).size;

            this.countOccurrences = occurrences.length;

            this.countFinishedOcurrences = occurrences.filter((occurrence) => occurrence.ends.isPast()).length;
        },

        occurrenceRawProcessor (rawData) {
            let data = {
                event_id: rawData.event.id,
                ends: new McDate(rawData.ends.date)
            };
    
            return data;
        }
    }   
});