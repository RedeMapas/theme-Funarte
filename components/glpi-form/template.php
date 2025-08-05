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
    :class="{ 'help-footer-tag-hidden': isCurtainOpen }"
    @click="openCurtain"
  >
    Precisa de ajuda?
  </div>

  <!-- Help curtain container - sempre no DOM, controlado por classe CSS -->
  <div 
    class="help-curtain" 
    :class="{ 'help-curtain-open': isCurtainOpen }"
    @click="handleCurtainClick"
  >
    <div class="help-form-panel">
      <div class="help-form-header">
        <h2 class="help-form-title">Como podemos ajudar?</h2>
        <button class="help-form-close" @click="closeCurtain">&times;</button>
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