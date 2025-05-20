<?php
$this->layout = 'default';
$this->bodyClasses[] = 'not-found';
?>

<div class="container">
    <div class="panel">
        <h1>Página não encontrada</h1>
        <p>A página que você está procurando não foi encontrada.</p>
        <a href="<?php echo $app->createUrl('site', 'index') ?>" class="btn btn-primary">Voltar para a página inicial</a>
    </div>
</div>
