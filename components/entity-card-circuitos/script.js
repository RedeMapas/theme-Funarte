app.component('entity-card-circuitos', {
    template: $TEMPLATES['entity-card-circuitos'],

    setup(props, { slots }) {
        const hasSlot = name => !!slots[name];

        // os textos estão localizados no arquivo texts.php deste componente
        const text = Utils.getTexts('entity-card-circuitos')
        return { text, hasSlot }
    },

    data() {
        return {
            // Agenda
            agendaOccurrences: [],
            agendaLoading: false,
            agendaPage: 1,
        }
    },

    created() {
        this.eventApi = new API('event');
        this.spaceApi = new API('space');
    },

    mounted() {
        this.loadAgenda();
    },

    props: {
        class: {
            type: [String, Object, Array],
            default: ''
        },
        entity: {
            type: Entity,
            required: true
        },
        portrait: {
            type: Boolean,
            default: false
        },
        sliceDescription: {
            type: Boolean,
            default: false,
        },
        tag: {
            type: String,
            default: 'h2',
        },
        agendaLimit: {
            type: Number,
            default: 999999
        },
        agendaPerEventLimit: {
            type: Number,
            default: 3
        },
    },

    computed: {
        classes() {
            return [this.class, {'portrait': this.portrait}]
        },
        showShortDescription() {
            if (this.entity.shortDescription) {
                if (this.entity.shortDescription.length > 400) {
                    return this.entity.shortDescription.substring(0, 400) + '...';
                } else {
                    return this.entity.shortDescription;
                }
            }
        },
        seals() {
            return (this.entity.seals.length > 0 ? this.entity.seals.slice(0, 2) : false);
        },
        areas() {
            return (Array.isArray(this.entity.terms.area) ? this.entity.terms.area.join(", ") : false);
        },
        tags() {
            return (Array.isArray(this.entity.terms.tag) ? this.entity.terms.tag.join(", ") : false);
        },
        linguagens() {
            return (Array.isArray(this.entity.terms.linguagem) ? this.entity.terms.linguagem.join(", ") : false);
        },
        openSubscriptions() {
            if (this.entity.__objectType == "opportunity") {

                if (this.entity.registrationFrom && this.entity.registrationTo) {
                    if (this.entity.isContinuousFlow) {
                        if (!this.entity.hasEndDate && this.entity.registrationFrom.isFuture()) {
                            return false;
                        }

                        if (!this.entity.hasEndDate && this.entity.registrationFrom.isPast()) {
                            return true;
                        }
                    }
                    return this.entity.registrationFrom.isPast() && this.entity.registrationTo.isFuture();
                } else {
                    return false;
                }
            }
            return false;
        },

        showEndDateText() {
            if (this.entity.__objectType == "opportunity") {
                if (this.entity.registrationFrom && this.entity.registrationTo) {
                    if (this.entity.isContinuousFlow && !this.entity.hasEndDate) {
                        return false;
                    }
                    return this.entity.registrationFrom.isPast() && this.entity.registrationTo.isFuture();
                }
                return false;
            }
            return false;
        },

        useLabels() {
            return this.openSubscriptions || this.hasSlot('labels')
        },

        // Agenda computed properties
        agendaPseudoQuery() {
            // Carregar todas as ocorrências do projeto dentro de um intervalo amplo.
            // Preferir datas do próprio projeto quando disponíveis.
            const now = new Date();
            let from = `${now.getFullYear() - 10}-01-01`;
            let to = `${now.getFullYear() + 1}-12-31`; // Inclui sempre o próximo ano

            try {
                if (this.entity.startsOn) {
                    const y0 = this.entity.startsOn.year();
                    from = `${y0}-01-01`;
                }
                if (this.entity.endsOn) {
                    const y1 = this.entity.endsOn.year();
                    // Garante que o intervalo inclua pelo menos o próximo ano
                    const maxYear = Math.max(y1, now.getFullYear() + 1);
                    to = `${maxYear}-12-31`;
                }
            } catch (e) {
                // fallback mantém o intervalo amplo
            }

            return {
                'event:project': this.entity.id,
                '@from': from,
                '@to': to
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

        hasAgendaLoaded() {
            return !this.agendaLoading && this.agendaOccurrences !== null;
        }
    },
    methods: {
        slice(text, qtdChars) {
            if (text && text.length > qtdChars) {
                let slicedText = text.slice(0, qtdChars);

                let _text = text.split(' ');
                let _slicedText = slicedText.split(' ');

                let _textLastWord = _text[_slicedText.length - 1];
                let _slicedTextLastWord = _slicedText[_slicedText.length - 1];

                /* se palavra for cortada, remove */
                if (_slicedTextLastWord  !== _textLastWord ) {
                    _slicedText.pop();
                    _textLastWord = _slicedText.at(-1);
                };

                /* verifica pontuações ao final da ultima palavra */
                let especialChars = ['.', ',', '!', '?'];
                especialChars.forEach(function(symbol) {
                    if (typeof _textLastWord == 'string' && _textLastWord.indexOf(symbol) !== -1) {
                        _slicedText[_slicedText.indexOf(_textLastWord)] = _textLastWord.slice(0, -1);
                    };
                });

                return _slicedText.join(' ') + '...';
            }
            return text;
        },

        // Agenda methods


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


    }
});
