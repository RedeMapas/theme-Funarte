app.component('glpi-form', {
    template: $TEMPLATES['glpi-form'],

    props: {
        classes: {
            type: [String, Array, Object],
            required: false
        },
    },

    data() {
        return {
            isCurtainOpen: false,
            isSubmitting: false,
            statusMessage: '',
            statusType: 'success',
            formMessage: '',
            formMessageType: 'success',
            formData: {
                nome: '',
                email: '',
                telefone: '',
                mensagem: ''
            }
        }
    },

    mounted() {
        this.setupEventListeners();
    },

    computed: {
        formMessageClass() {
            if (!this.formMessage) return 'help-form-message';
            return `help-form-message help-form-message-${this.formMessageType}`;
        }
    },

    methods: {
        setupEventListeners() {
            // Close curtain with ESC key
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && this.isCurtainOpen) {
                    this.closeCurtain();
                }
            });

            // Prevent form submission on Enter in input fields (except textarea)
            this.$nextTick(() => {
                const helpForm = this.$el.querySelector('.help-form');
                if (helpForm) {
                    const helpInputs = helpForm.querySelectorAll('input');
                    helpInputs.forEach(input => {
                        input.addEventListener('keydown', (event) => {
                            if (event.key === 'Enter') {
                                event.preventDefault();
                                // Move to next field or submit if it's the last field
                                const formElements = Array.from(helpForm.elements);
                                const currentIndex = formElements.indexOf(event.target);
                                const nextElement = formElements[currentIndex + 1];

                                if (nextElement && nextElement.type !== 'submit') {
                                    nextElement.focus();
                                } else {
                                    this.submitForm();
                                }
                            }
                        });
                    });
                }
            });
        },

        openCurtain() {
            this.isCurtainOpen = true;
            document.body.style.overflow = 'hidden';
            this.clearFormMessage();
        },

        closeCurtain() {
            this.isCurtainOpen = false;
            document.body.style.overflow = '';
            this.clearFormMessage();
        },

        handleCurtainClick(event) {
            if (event.target.classList.contains('help-curtain')) {
                this.closeCurtain();
            }
        },

        showFormMessage(message, isError = false) {
            this.formMessage = message;
            this.formMessageType = isError ? 'error' : 'success';

            // Auto-hide after 4 seconds
            setTimeout(() => {
                this.clearFormMessage();
            }, 4000);
        },

        clearFormMessage() {
            this.formMessage = '';
            this.formMessageType = 'success';
        },

        formatPhone(event) {
            let value = event.target.value.replace(/\D/g, '');

            // Remove country code if present
            if (value.startsWith('55')) {
                value = value.slice(2);
            }

            // Limit to 11 digits
            if (value.length > 11) {
                value = value.slice(0, 11);
            }

            // Apply mask
            let formatted = '';
            if (value.length > 0) {
                formatted += '(' + value.substring(0, 2);
            }
            if (value.length >= 2) {
                formatted += ') ';
            }
            if (value.length >= 3) {
                formatted += value.substring(2, 7);
            }
            if (value.length >= 7) {
                formatted += '-' + value.substring(7, 11);
            }

            this.formData.telefone = formatted;
        },

        validateForm() {
            // Basic validation for required fields
            if (!this.formData.nome || !this.formData.email || !this.formData.mensagem) {
                this.showFormMessage('Por favor, preencha todos os campos obrigatórios (nome, email e mensagem).', true);
                return false;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.formData.email)) {
                this.showFormMessage('Por favor, insira um e-mail válido.', true);
                return false;
            }

            // Phone validation (Brazilian format) - only if provided
            if (this.formData.telefone && this.formData.telefone.trim() !== '') {
                const phoneRegex = /^\([1-9]{2}\)\s9[0-9]{4}-[0-9]{4}$/;
                if (!phoneRegex.test(this.formData.telefone)) {
                    this.showFormMessage('Por favor, insira um telefone válido no formato (XX) 9XXXX-XXXX ou deixe em branco.', true);
                    return false;
                }
            }

            return true;
        },

        async submitForm() {
            if (!this.validateForm()) {
                return;
            }

            this.isSubmitting = true;

            try {
                const currentDomain = window.location.hostname;
                const timestamp = new Date().toISOString();
                const source = window.location.href;

                // Append timestamp and source to the message content
                const mensagemCompleta = `${this.formData.mensagem}\n\n---\nTimestamp: ${timestamp}\nSource: ${source}`;

                // Prepare form data for external submission
                const formData = new FormData();
                formData.append('nome', this.formData.nome);
                formData.append('email', this.formData.email);
                formData.append('telefone', this.formData.telefone || '');
                formData.append('mensagem', mensagemCompleta);
                formData.append('timestamp', timestamp);
                formData.append('source', source);

                let urlGlpi = 'http://localhost4242/index_old.php'; // Default URL for local testing

                // Choose the urlGlpi based on the detected domain using regular expressions
                if (/cultura.gov.br$/.test(currentDomain)) {
                    urlGlpi = 'https://sistema.funarte.gov.br/cotic/rededasartes/processa-chamado.php';
                } else if (/funarte.gov.br$/.test(currentDomain)) {
                    urlGlpi = 'https://l0ow08gcs8w48gogsggc0skk.rda-hmg.funarte.gov.br/index_old.php';
                }

                // Send data to external URL
                const response = await fetch(urlGlpi, {
                    method: 'POST',
                    body: formData,
                    credentials: 'omit' // Don't send credentials for cross-origin requests
                });

                // Check if the response status is not in the 200-299 range
                if (!response.ok) {
                    throw new Error(`HTTP Error: ${response.status} ${response.statusText}`);
                }

                // Show success message in form
                this.showFormMessage('Mensagem enviada com sucesso! Em breve nossa equipe responderá.');

                // Reset form
                this.formData = {
                    nome: '',
                    email: '',
                    telefone: '',
                    mensagem: ''
                };

                // Close curtain after a delay
                setTimeout(() => {
                    this.closeCurtain();
                }, 5000);

            } catch (error) {
                this.showFormMessage('Erro ao enviar mensagem. Tente novamente.', true);
            } finally {
                this.isSubmitting = false;
            }
        }
    },

});
