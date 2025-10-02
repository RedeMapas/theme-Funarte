<?php

/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('mc-captcha');

?>

<!-- Container principal -->
<div class="glpi-form-container">
  <!-- Status message container -->
  <div id="helpStatusContainer" class="help-status-container">
    <div v-if="statusMessage" :class="['help-status-' + statusType]">
      {{ statusMessage }}
    </div>
  </div>

  <!-- Help footer tag - sempre visível inicialmente -->
  <div 
    class="help-footer-tag" 
    :class="{ 'help-footer-tag-hidden': isOptionsCurtainOpen || isFormCurtainOpen }"
    @click="openOptionsCurtain"
  >
    Precisa de ajuda?
  </div>

  <div
    class="help-options-curtain"
    :class="{ 'help-options-open': isOptionsCurtainOpen }"
  >
    <div class="help-options-content">
      <div class="help-curtain-header">
        <h2 class="help-form-title">Precisa de ajuda?</h2>
        <button class="help-curtain-close-button" @click="closeOptionsCurtain">&times;</button>
      </div>
      
      <p class="help-options-subtitle">Quer entender melhor como utilizar os recursos e as configurações dessa página?</p>
      
      <a href="https://redemapas.github.io/manual/" target="_blank" class="help-options-button help-options-button-primary">
        Acesse o Manual
      </a>
      
      <p class="help-options-subtitle" style="border-top: 1px solid #bbbbbb; padding-top: 20px;">Ainda ficou com dúvida?</p>
      
      <button
        class="help-options-button help-options-button-secondary"
        @click="openFormCurtain"
      >
        Fale com o nosso time
      </button>
    </div>
  </div>

  <!-- Help curtain container - sempre no DOM, controlado por classe CSS -->
  <div 
    class="help-form-curtain" 
    :class="{ 'help-form-curtain-open': isFormCurtainOpen }"
    @click="handleCurtainClick"
  >
    <div
      class="help-form-panel"
      :class="{ 'help-form-open': isHelpFormOpen }"
    >
      <div class="help-curtain-header">
        <h2 class="help-form-title">Como podemos ajudar?</h2>
        <button class="help-curtain-close-button" @click="closeFormCurtain">&times;</button>
      </div>

      <div class="help-form-message" :class="formMessageClass">
        {{ formMessage }}
      </div>

      <form class="help-form" @submit.prevent="submitForm" autocomplete="off">
        <input
          type="text"
          v-model="formData.nome"
          placeholder="Seu nome"
          class="help-form-input"
          autocomplete="off"
          required
        />
        <input
          type="email"
          v-model="formData.email"
          placeholder="Seu e-mail"
          class="help-form-input"
          autocomplete="off"
          required
        />
        <input
          type="tel"
          v-model="formData.telefone"
          placeholder="Telefone (opcional - ex: +55 11 91234-5678)"
          maxlength="19"
          class="help-form-input"
          autocomplete="off"
          @input="formatPhone"
        />
        <textarea
          v-model="formData.mensagem"
          placeholder="Digite sua mensagem..."
          class="help-form-textarea"
          autocomplete="off"
          required
        ></textarea>
        
        <!-- Captcha -->
        <mc-captcha 
          @captcha-verified="verifyCaptcha" 
          @captcha-expired="expiredCaptcha"
          :error="error"
          class="help-form-captcha"
        ></mc-captcha>
        
        <button type="submit" class="help-form-button" :disabled="isSubmitting">
          {{ isSubmitting ? 'Enviando...' : 'Enviar mensagem' }}
        </button>
      </form>
    </div>
  </div>
</div>