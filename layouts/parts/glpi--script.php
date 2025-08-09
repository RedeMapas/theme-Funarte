<!--Start of GLPI Script-->
<style>
  /* Status message styling */
  .help-status-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 10px;
    margin: 20px;
    border-radius: 4px;
  }

  .help-status-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 10px;
    margin: 20px;
    border-radius: 4px;
  }

  /* Help footer tag styling */
  .help-footer-tag {
    position: fixed;
    bottom: 0;
    right: 0;
    transform: translateX(-50%);
    background-color: #007bff;
    color: white;
    padding: 6px 24px;
    border-radius: 8px 8px 0 0;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    z-index: 1000;
    user-select: none;
  }

  .help-footer-tag:hover {
    background-color: #0056b3;
    transform: translateX(-50%) translateY(-2px);
    box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.3);
  }

  .help-footer-tag.help-footer-tag-hidden {
    transform: translateX(-50%) translateY(100%);
    opacity: 0;
    pointer-events: none;
  }


  .help-popup {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: 999;
    transform: translateY(100%);
    transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }

  .help-popup.help-popup-open {
    transform: translateY(0);
  }

  .help-popup-content {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 90%;
    max-width: 350px;
    background-color: #ffffff;
    border-radius: 12px 12px 0 0;
    box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.3);
    padding: 24px;
    max-height: 80vh;
    overflow-y: auto;
  }

  .help-popup-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: none;
    border: none;
    font-size: 24px;
    color: #aaa;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
  }

  .help-popup-close:hover {
    background-color: #f8f9fa;
    color: #333;
  }

  .help-popup-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin: 0 0 20px 0;
    text-align: center;
  }

  .help-popup-divider {
    height: 1px;
    background-color: #e9ecef;
    margin: 20px 0;
  }

  .help-popup-text {
    font-size: 16px;
    color: #333;
    margin: 20px 0;
    text-align: center;
    line-height: 1.5;
  }

  .help-popup-button {
    display: block;
    width: 100%;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    text-align: center;
    margin: 10px 0;
  }

  .help-popup-button-primary {
    background-color: #007bff;
    color: white;
  }

  .help-popup-button-primary:hover {
    background-color: #0056b3;
  }

  .help-popup-button-secondary {
    background-color: white;
    color: #007bff;
    border: 1px solid #007bff;
  }

  .help-popup-button-secondary:hover {
    background-color: #f8f9fa;
  }

  /* Help curtain container */
  .help-curtain {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    /* background-color: rgba(0, 0, 0, 0.5); */
    z-index: 999;
    transform: translateY(100%);
    transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }

  .help-curtain.help-curtain-open {
    transform: translateY(0);
  }

  /* Help form panel */
  .help-form-panel {
    position: absolute;
    bottom: 0;
    right: 0;
    /* transform: translateX(-50%); */
    width: 90%;
    max-width: 350px;
    background-color: #ffffff;
    border-radius: 12px 12px 0 0;
    box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.3);
    padding: 24px;
    max-height: 80vh;
    overflow-y: auto;
  }

  /* Help form header */
  .help-form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid #e9ecef;
  }

  .help-form-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  .help-form-close {
    background: none;
    border: none;
    font-size: 24px;
    color: #aaa;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
  }

  .help-form-close:hover {
    background-color: #f8f9fa;
    color: #333;
  }

  /* Help form message area for validation feedback */
  .help-form-message {
    margin-bottom: 16px;
    padding: 12px;
    border-radius: 6px;
    font-size: 14px;
    display: none;
  }

  .help-form-message.help-form-message-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    display: block;
  }

  .help-form-message.help-form-message-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    display: block;
  }

  /* Help form styling */
  .help-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .help-form-input,
  .help-form-textarea {
    padding: 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    transition: border-color 0.2s ease;
    font-family: inherit;
  }

  .help-form-input:focus,
  .help-form-textarea:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.1);
  }

  .help-form-textarea {
    resize: vertical;
    min-height: 80px;
  }

  .help-form-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s ease;
  }

  .help-form-button:hover {
    background-color: #0056b3;
  }

  .help-form-button:disabled {
    background-color: #6c757d;
    cursor: not-allowed;
  }

  /* Status message container */
  .help-status-container {
    margin: 20px;
  }
</style>
<!-- Status message container -->
<div id="helpStatusContainer" class="help-status-container"><!--STATUS_MESSAGE--></div>

<!-- Help footer tag -->
<div id="helpFooterTag" class="help-footer-tag">
  Precisa de ajuda?
</div>

<!-- help popup container -->
<div id="helpPopup" class="help-popup">
  <div class="help-popup-content">
    <button id="helpPopupClose" class="help-popup-close">&times;</button>
    
    <h2 class="help-popup-title">Precisa de ajuda?</h2>
    
    <div class="help-popup-divider"></div>
    
    <p class="help-popup-text">Quer entender melhor como utilizar os recursos e as configurações dessa página?</p>
    
    <a href="https://redemapas.github.io/manual/" target="_blank" class="help-popup-button help-popup-button-primary">
      Acesse o Manual
    </a>
    
    <div class="help-popup-divider"></div>
    
    <p class="help-popup-text">Ainda ficou com dúvida?</p>
    
    <button id="helpPopupContactButton" class="help-popup-button help-popup-button-secondary">
      Fale com nosso time
    </button>
  </div>
</div>

<!-- Help curtain container -->
<div id="helpCurtain" class="help-curtain">
  <div class="help-form-panel">
    <div class="help-form-header">
      <h2 class="help-form-title">Como podemos ajudar?</h2>
      <button id="helpFormClose" class="help-form-close">&times;</button>
    </div>

    <div id="helpFormMessage" class="help-form-message"></div>

    <form id="helpForm" class="help-form" autocomplete="off">
      <input
        type="text"
        id="helpNome"
        name="nome"
        placeholder="Seu nome"
        class="help-form-input"
        autocomplete="off"
        required
      />
      <input
        type="email"
        id="helpEmail"
        name="email"
        placeholder="Seu e-mail"
        class="help-form-input"
        autocomplete="off"
        required
      />
      <input
        type="tel"
        id="helpTelefone"
        name="telefone"
        placeholder="Telefone (opcional - ex: +55 11 91234-5678)"
        maxlength="19"
        class="help-form-input"
        autocomplete="off"
      />
      <textarea
        id="helpMensagem"
        name="mensagem"
        placeholder="Digite sua mensagem..."
        class="help-form-textarea"
        autocomplete="off"
        required
      ></textarea>
      <button type="submit" class="help-form-button">Enviar mensagem</button>
    </form>
  </div>
</div>

<script>
  // Get DOM element references
  const helpFooterTag = document.getElementById('helpFooterTag');
  const helpPopup = document.getElementById('helpPopup');
  const helpPopupClose = document.getElementById('helpPopupClose');
  const helpPopupContactButton = document.getElementById('helpPopupContactButton');
  const helpCurtain = document.getElementById('helpCurtain');
  const helpFormClose = document.getElementById('helpFormClose');
  const helpForm = document.getElementById('helpForm');
  const helpStatusContainer = document.getElementById('helpStatusContainer');
  const helpFormMessage = document.getElementById('helpFormMessage');
  const helpTelefoneInput = document.getElementById('helpTelefone');

  // Open popup 
  helpFooterTag.addEventListener('click', () => {
    helpPopup.classList.add('help-popup-open');
    helpFooterTag.classList.add('help-footer-tag-hidden'); // Hide footer tag
    document.body.style.overflow = 'hidden'; // Prevent background scroll
  });

  // Close popup when close button is clicked
  helpPopupClose.addEventListener('click', () => {
    closePopup();
  });

  // Close popup when clicking outside 
  helpPopup.addEventListener('click', (event) => {
    if (event.target === helpPopup) {
      closePopup();
    }
  });

  // Close popup with ESC 
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && helpPopup.classList.contains('help-popup-open')) {
      closePopup();
    }
  });

  function closePopup() {
    helpPopup.classList.remove('help-popup-open');
    helpFooterTag.classList.remove('help-footer-tag-hidden'); // Show footer tag
    document.body.style.overflow = ''; // Restore background scroll
  }

  // Open curtain 
  helpPopupContactButton.addEventListener('click', () => {
    closePopup(); // Close the popup first
    helpCurtain.classList.add('help-curtain-open');
    helpFooterTag.classList.add('help-footer-tag-hidden'); // Hide footer tag
    document.body.style.overflow = 'hidden'; // Prevent background scroll
    clearFormMessage(); // Clear any previous form messages
  });

  // Close curtain when close button is clicked
  helpFormClose.addEventListener('click', () => {
    closeCurtain();
  });

  // Close curtain when clicking outside 
  helpCurtain.addEventListener('click', (event) => {
    if (event.target === helpCurtain) {
      closeCurtain();
    }
  });

  // Close curtain with ESC 
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && helpCurtain.classList.contains('help-curtain-open')) {
      closeCurtain();
    }
  });

  function closeCurtain() {
    helpCurtain.classList.remove('help-curtain-open');
    helpFooterTag.classList.remove('help-footer-tag-hidden'); // Show footer tag
    document.body.style.overflow = ''; // Restore background scroll
    clearFormMessage(); // Clear form messages when closing
  }

  // Show form validation message function (inside the form panel)
  function showFormMessage(message, isError = false) {
    helpFormMessage.textContent = message;
    helpFormMessage.className = 'help-form-message ' + (isError ? 'help-form-message-error' : 'help-form-message-success');

    // Auto-hide after 4 seconds
    setTimeout(() => {
      clearFormMessage();
    }, 4000);
  }

  // Clear form message
  function clearFormMessage() {
    helpFormMessage.textContent = '';
    helpFormMessage.className = 'help-form-message';
  }

  // Handle form submission
  helpForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const nome = document.getElementById('helpNome').value;
    const email = document.getElementById('helpEmail').value;
    const telefone = document.getElementById('helpTelefone').value;
    const mensagem = document.getElementById('helpMensagem').value;

    // Basic validation for required fields
    if (!nome || !email || !mensagem) {
      showFormMessage('Por favor, preencha todos os campos obrigatórios (nome, email e mensagem).', true);
      return;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      showFormMessage('Por favor, insira um e-mail válido.', true);
      return;
    }

    // Phone validation (Brazilian format) - only if provided
    if (telefone && telefone.trim() !== '') {
      const phoneRegex = /^\([1-9]{2}\)\s9[0-9]{4}-[0-9]{4}$/;
      if (!phoneRegex.test(telefone)) {
        showFormMessage('Por favor, insira um telefone válido no formato (XX) 9XXXX-XXXX ou deixe em branco.', true);
        return;
      }
    }

    // Disable submit button during submission
    const submitButton = helpForm.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.textContent = 'Enviando...';

    try {
      const currentDomain = window.location.hostname;
      const timestamp = new Date().toISOString();
      const source = window.location.href;
      
      // Append timestamp and source to the message content
      const mensagemCompleta = `${mensagem}\n\n---\nTimestamp: ${timestamp}\nSource: ${source}`;
      
      // Prepare form data for external submission
      const formData = new FormData();
      formData.append('nome', nome);
      formData.append('email', email);
      formData.append('telefone', telefone || '');
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
      showFormMessage('Mensagem enviada com sucesso! Em breve nossa equipe responderá.');

      // Reset form
      helpForm.reset();

      // Close curtain after a delay
      setTimeout(() => {
        closeCurtain();
      }, 5000);

    } catch (error) {
      console.error('Erro ao enviar formulário:', error);
      showFormMessage('Erro ao enviar mensagem. Tente novamente.', true);
    } finally {
      // Re-enable submit button
      submitButton.disabled = false;
      submitButton.textContent = originalText;
    }
  });

  // Brazilian phone number input mask
  helpTelefoneInput.addEventListener('input', function(event) {
    let value = this.value.replace(/\D/g, '');

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

    this.value = formatted;
  });

  // Prevent form submission on Enter in input fields (except textarea)
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
          helpForm.requestSubmit();
        }
      }
    });
  });
</script>
<!--End of GLPI Script-->
