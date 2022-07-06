# MVCPROJECT
Este é um simples sistema em PHP criado baseado no padrão de projeto MVC.

## Objetivos
Colocar em prática meus conhecimentos adquiridos em PHP e desenvolvimento em estrutura MVC. A idéia base é construir todo o sistema sem uso
de componentes PHP externo, como componentes de rotas, componentes de manipulação de banco de dados, etc.

## O que construi?
Toda a parte PHP do sistema foram construídas do zero, sem uso de componentes PHP externos. As classes mais significativas e desafiadoras construídas estão em <b>\source\Components</b>, neste diretório estão todas as classes que dependem unicamente delas, de suas super classes e de suas traits, ambas agrupadas no mesmo diretório. Destas, para mim é interessante destacar a:

- classe de gerenciamento de rotas (<b><i>\source\Components\Router\Router</i></b>);
- classe de gerenciamento de banco de dados (<b><i>\source\Components\Base\Base</i></b>);
- classe de gerenciamento de template (<b><i>\source\Components\Template\Template</i></b>);
- classe de gerenciamento de thumbnails (<b><i>\source\Components\Thumb\Thumb</i></b>);
- classe de gerenciamento de uploads (<b><i>\source\Components\Uploader\Uploader</i></b>) e
- as classes mais simples, porém muito úteis <b><i>\source\Components\Message\Message</i></b> e <b><i>\source\Components\Session\Session</i></b>.

## Como rodar este projeto localmente
Para rodar ele localmente é simples! Com um servidor local devidamente instalado e configurado, o composer e npm e seguir os seguintes passo:
1. Obtenha o projeto por meio de alguma forma disponível pelo Github.
2. Mova a pasta contendo as pastas do projeto para dentro do seu servidor local.
3. Na pasta extras abra o arquivo <b>database.mwb</b> no MySQL Workbench e importe o banco de dados.
4. Copie e renomeie o arquivo '<b>env.env</b>' para '<b>.env</b>' abra-o e configure todos as variáveis. Todas são importantes!
5. Executes os comandos: npm install e composer install para instalar as dependências principais.
6. Basta acessar o link do seu servidor local no navegador.