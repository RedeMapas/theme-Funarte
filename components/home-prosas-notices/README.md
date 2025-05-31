# Componente `<home-prosas-notices>`
Componente criado para tela inicial para listar editais da plataforma Prosas.
  
## Propriedades
- *String **client-id*** **(obrigatório)** - O client_id necessário para conexão do cliente com a API do Prosas.
- *String **id-list*** - IDs dos editais que devem ser exibidos separados por vírgula. Se o id-list não for passado ou for passado uma string vazia, então, por padrão, todos os editais disponíveis na plataforma são exibidos.

### Importando componente
```PHP
<?php 
$this->import('home-prosas-notices');
?>
```
### Exemplos de uso
```HTML
<!-- Utilizaçao básica -->
<home-prosas-notices client-id="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"></home-prosas-notices>

<!-- Selecionando editais -->
<home-prosas-notices client-id="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" id-list="20,2601,357"></home-prosas-notices>

```