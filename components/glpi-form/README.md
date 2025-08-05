# Componente `<glpi-form>`

O componente `glpi-form` implementa um formulário de ajuda flutuante que permite aos usuários enviar mensagens de suporte.

## Funcionalidades

- **Caixinha azul flutuante** visível no canto inferior direito
- **Formulário expansível** que abre com transição suave
- **Validação de campos** (nome, email obrigatórios, telefone opcional)
- **Máscara de telefone** brasileiro no formato (XX) 9XXXX-XXXX
- **Navegação por teclado** (Enter para próximo campo)
- **Envio para GLPI** baseado no domínio detectado
- **Feedback visual** de sucesso/erro
- **Reset automático** do formulário após envio

## Estrutura

O componente possui duas etapas principais:

1. **Caixinha azul** - Sempre visível inicialmente
2. **Formulário** - Abre ao clicar na caixinha azul

## Campos do Formulário

- **Nome** (obrigatório)
- **Email** (obrigatório, com validação)
- **Telefone** (opcional, com máscara brasileira)
- **Mensagem** (obrigatório)

## Eventos

- **submit** - disparado quando o formulário é enviado com sucesso
- **error** - disparado quando há erro no envio

### Importando componente
```PHP
<?php 
$this->import('glpi-form');
?>
```

### Exemplo de uso
```HTML
<!-- utilização básica -->
<glpi-form></glpi-form>

<!-- com classes adicionais -->
<glpi-form classes="minha-classe"></glpi-form>
```

## Arquivos do Componente

- `template.php` - Template HTML do componente
- `script.js` - Lógica Vue.js do componente
- `_glpi-form.scss` - Estilos SCSS (importado no tema)
