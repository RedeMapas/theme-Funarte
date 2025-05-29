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
        placeholder="Telefone (ex: +55 11 91234-5678)"
        maxlength="19"
        class="help-form-input"
        autocomplete="off"
        required
      />
      <textarea
        id="helpDescription"
        name="description"
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
  const helpCurtain = document.getElementById('helpCurtain');
  const helpFormClose = document.getElementById('helpFormClose');
  const helpForm = document.getElementById('helpForm');
  const helpStatusContainer = document.getElementById('helpStatusContainer');
  const helpFormMessage = document.getElementById('helpFormMessage');
  const helpTelefoneInput = document.getElementById('helpTelefone');

  // Open curtain when footer tag is clicked
  helpFooterTag.addEventListener('click', () => {
    helpCurtain.classList.add('help-curtain-open');
    helpFooterTag.classList.add('help-footer-tag-hidden'); // Hide footer tag
    document.body.style.overflow = 'hidden'; // Prevent background scroll
    clearFormMessage(); // Clear any previous form messages
  });

  // Close curtain when close button is clicked
  helpFormClose.addEventListener('click', () => {
    closeCurtain();
  });

  // Close curtain when clicking outside the form panel
  helpCurtain.addEventListener('click', (event) => {
    if (event.target === helpCurtain) {
      closeCurtain();
    }
  });

  // Close curtain with ESC key
  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && helpCurtain.classList.contains('help-curtain-open')) {
      closeCurtain();
    }
  });

  // Function to close curtain
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

    const email = document.getElementById('helpEmail').value;
    const telefone = document.getElementById('helpTelefone').value;
    const description = document.getElementById('helpDescription').value;

    // Basic validation
    if (!email || !telefone || !description) {
      showFormMessage('Por favor, preencha todos os campos.', true);
      return;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      showFormMessage('Por favor, insira um e-mail válido.', true);
      return;
    }

    // Phone validation (Brazilian format)
    const phoneRegex = /^\([1-9]{2}\)\s9[0-9]{4}-[0-9]{4}$/;
    if (!phoneRegex.test(telefone)) {
      showFormMessage('Por favor, insira um telefone válido no formato (XX) 9XXXX-XXXX.', true);
      return;
    }

    // Disable submit button during submission
    const submitButton = helpForm.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.textContent = 'Enviando...';

    try {
      const currentDomain = window.location.hostname;
      // Prepare form data for external submission
      const formData = new FormData();
      formData.append('email', email);
      formData.append('telefone', telefone);
      formData.append('description', description);
      formData.append('timestamp', new Date().toISOString());
      formData.append('source', window.location.href);

      let urlGlpi = 'http://localhost4242/index_old.php'; // Default URL for local testing

      // Choose the urlGlpi based on the detected domain using regular expressions
      if (/cultura.gov.br$/.test(currentDomain)) {
          urlGlpi = 'https://glpi-rede-das-artes.funarte.gov.br/index_old.php';
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
