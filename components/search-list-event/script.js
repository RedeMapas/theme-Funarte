app.component('search-list-event', {
    template: $TEMPLATES['search-list-event'],

    created() {
        this.currentDate = null;
        this.eventApi = new API('event');
        this.spaceApi = new API('space');
        this.fetchOccurrences();
    },

    data() {
        return {
            event: {},
            occurrences: [],
            loading: false,
            page: 1,
            showAllSeals: {},
            sectionNavigation: {},
            sealColors: ['#FF6B9D', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7', '#DDA0DD', '#98D8C8', '#F7DC6F']
        }
    },

    watch: {
        pseudoQuery: {
            handler(){
                clearTimeout(this.watchTimeout);
                this.loading = true;
                this.page = 1;

                this.watchTimeout = setTimeout(() => {
                    this.fetchOccurrences();
                }, 500)
            },
            deep: true,
        }
    },

    props: {
        limit: {
            type: Number,
            default: 20,
        },
        select: {
            type: String,
            default: 'id,name,subTitle,shortDescription,longDescription,registrationFrom,registrationTo,files.avatar,seals,terms,classificacaoEtaria,singleUrl,type'
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
            if (!this.occurrences || !Array.isArray(this.occurrences)) {
                return [];
            }

            const eventGroups = {};

            this.occurrences.forEach(occurrence => {
                const eventId = occurrence.event.id;
                if (!eventGroups[eventId]) {
                    eventGroups[eventId] = {
                        event: occurrence.event,
                        occurrences: []
                    };
                }
                eventGroups[eventId].occurrences.push(occurrence);
            });

            // Sort occurrences within each event by date
            Object.values(eventGroups).forEach(group => {
                group.occurrences.sort((a, b) => {
                    return new Date(a.starts.date()) - new Date(b.starts.date());
                });
            });

            return Object.values(eventGroups);
        }
    },

    methods: {
        // http://localhost/api/event/findOccurrences?@from=2022-08-19&@to=2022-09-19&space:@select=id,name,shortDescription,endereco&@select=
        async fetchOccurrences() {
            const query = Utils.parsePseudoQuery(this.pseudoQuery);

            this.loading = true;
            // clearTimeout(this.timeout);
            // this.timeout = setTimeout(() => {

            // }, 500)
            if(query['@keyword']) {
                query['event:@keyword'] = query['@keyword'];
                delete query['@keyword'];
            }

            query['event:@select'] = this.select;
            query['space:@select'] = this.spaceSelect;
            query['@limit'] = this.limit;
            query['@page'] = this.page;

            const occurrences = await this.eventApi.fetch('occurrences', query, {
                raw: true,
                rawProcessor: (rawData) => Utils.occurrenceRawProcessor(rawData, this.eventApi, this.spaceApi)
            });

            const metadata = occurrences.metadata;

            if(this.page === 1) {
                this.occurrences = occurrences;
            } else {
                this.occurrences = this.occurrences.concat(occurrences);
                this.occurrences.metadata = metadata;
            }
            this.loading = false;
        },

        loadMore() {
            this.page++;
            this.fetchOccurrences();
        },

        newDate(occurrence) {
            if (this.currentDate?.date('long') != occurrence.starts.date('long')) {
                this.currentDate = occurrence.starts;
                return true;
            } else {
                return false;
            }
        },

        toggleSeals(eventId) {
            this.$set(this.showAllSeals, eventId, !this.showAllSeals[eventId]);
        },

        getSealColor(index) {
            return this.sealColors[index % this.sealColors.length];
        },

        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { 
                day: '2-digit', 
                month: 'long', 
                year: 'numeric' 
            });
        },

        groupEventsBySection(occurrences) {
            // Group occurrences into sections (for EVENTO A, EVENTO B, etc.)
            const sectionsPerEvent = 6; // Maximum occurrences per section
            const sections = [];
            
            for (let i = 0; i < occurrences.length; i += sectionsPerEvent) {
                sections.push(occurrences.slice(i, i + sectionsPerEvent));
            }
            
            return sections;
        },

        navigateSection(eventId, sectionIndex, direction) {
            if (!this.sectionNavigation[eventId]) {
                this.$set(this.sectionNavigation, eventId, {});
            }
            if (!this.sectionNavigation[eventId][sectionIndex]) {
                this.$set(this.sectionNavigation[eventId], sectionIndex, { currentPage: 0 });
            }
            
            const currentPage = this.sectionNavigation[eventId][sectionIndex].currentPage;
            this.sectionNavigation[eventId][sectionIndex].currentPage = Math.max(0, currentPage + direction);
        },

        getVisibleOccurrences(sectionOccurrences, eventId, sectionIndex) {
            const itemsPerPage = 3; // Show 3 cards at a time
            const currentPage = this.sectionNavigation[eventId]?.[sectionIndex]?.currentPage || 0;
            const startIndex = currentPage * itemsPerPage;
            
            return sectionOccurrences.slice(startIndex, startIndex + itemsPerPage);
        }
    },
});