<div class="row" id="slide">
    <?php
    $this->widget(
            'booster.widgets.TbCarousel', array(
        'items' => array(
            array(
                'image' => (Yii::app()->request->baseUrl . '/images/slide01.jpg'),
            //'label' => 'First Thumbnail label',
            //'caption' => 'First Caption.'
            ),
            array(
                'image' => (Yii::app()->request->baseUrl . '/images/slide02.jpg'),
            //'label' => 'Second Thumbnail label',
            //'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
            ),
            array(
                'image' => (Yii::app()->request->baseUrl . '/images/slide03.jpg'),
            //'label' => 'Third Thumbnail label',
            //'caption' => 'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.'
            ),
        ),
            )
    );
    ?>
</div>
<div class="row" id="conteudo">
    <div class="col-xs-12" id="criador">
        <h1 class="text-center">Criador</h1>
        <p>Graduado em Ciência da Computação pela Universidade de Itaúna-MG, 
            atualmente cursando Pós-Graduação em desenvolvimento de aplicações WEB 
            pela PUC Minas. Concursado pela Câmara Municipal de Nova Serrana, cargo 
            de Auxiliar Administrativo, onde desempenha as funções de auxílio na realização 
            de processos licitatórios, digitação de documentos, atendimento ao público, 
            confecção de relatórios e de técnico em informática. Possui conhecimentos 
            de programação, tendo como especialidade as linguagens CSS, HTML, PHP, 
            Javascript, JQuery, Yii Framework, Java e C. O trabalho de conclusão de 
            curso foi a criação de uma inovadora ferramenta de pesquisa de produtos 
            de supermercados, onde o cliente pode criar suas listas de compras e comparar 
            preços entre diversos supermercados de sua região.</p>
    </div>
    <div class="col-xs-12" id="como-funciona">
        <h1 class="text-center">Como funciona?</h1>   
        <p>A Avaliação de Desempenho é uma importante ferramenta de Gestão de Pessoas e corresponde a uma
            análise sistemática do desempenho do profissional em função das atividades que realiza, dos resultados que
            alcança, do seu comportamento e do seu potencial de desenvolvimento. A Avaliação de Desempenho 360° é
            uma forma de avaliação em que todos os profissionais avaliam todos os outros com quem se relacionam. O
            objetivo final da Avaliação de Desempenho é contribuir para o desenvolvimento das pessoas na organização.</p>
        <p>Faço o cadastro de sua empresa e comece a desfrutar dos benefícios
            que a avaliação de desempenho 360º proporciona ao seu negócio. 
        </p>
    </div>
</div>