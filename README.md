# Desafio Revvo - Sistema de Gestão de Cursos

Sistema web para o gerenciamento de cursos, desenvolvido como parte de um case técnico.

## Descrição

Este é um sistema simples para cadastro, edição e exclusão de cursos, desenvolvido como parte de um desafio técnico. Ele inclui funcionalidades como upload de imagens, listagem de cursos e integração com banco de dados. Foi projetado com foco na clareza, boas práticas e uma interface amigável.

## Instalação

Para rodar este projeto localmente, siga os seguintes passos:

1. Clone este repositório:
   ```bash
   git clone https://github.com/marcellacamara/desafio_revvo.git
   ```
2. Entre no diretório do projeto:

   ```bash
   cd desafio_revvo
   ```

3. Instale as dependências do projeto:

   ```bash
   npm install
   ```

4. Suba um servidor PHP local (pode ser o embutido do PHP):

   ```bash
   php -S localhost:8000
   ```

5. Certifique-se de que o banco de dados está configurado corretamente (mais detalhes abaixo).

## Uso

1. Abra o navegador e acesse: `http://localhost:8000`.
2. Na página inicial, você verá uma lista de cursos cadastrados.
3. Utilize os botões para **Adicionar**, após adicionar você verá **Editar** e **Excluir** curso.
4. Para cada curso, você pode visualizar o curso clicando no botão "Ver Curso".

## Funcionalidades

- Cadastro de cursos com upload de imagem
- Edição e exclusão de cursos
- Exibição de uma lista de cursos
- Validação de formulários
- Interface amigável e responsiva

## Banco de Dados e Seeder

1. No diretório `db/`, você encontrará o arquivo `cursos.sql`. Execute-o no seu banco de dados MySQL para criar a tabela necessária:

   ```sql
   mysql -u root -p desafio_revvo < db/cursos.sql
   ```

2. Depois de criar a tabela, rode o seeder para popular o banco com os cursos iniciais:
   ```bash
   php ./courses/CursosSeeder.php
   ```

Este comando irá copiar as imagens necessárias e inserir os cursos automaticamente no banco de dados.

## Tecnologias Usadas

- **PHP** - Backend
- **MySQL** - Banco de Dados
- **Gulp.js** - Automatização de tarefas
- **JavaScript (Vanilla)** - Scripts no front-end
- **CSS3** - Estilização

## Contato

Caso tenha dúvidas ou sugestões, você pode me contatar em:

- **E-mail**: marcellacamara@live.com
- **LinkedIn**: [Marcella Câmara](https://linkedin.com/in/marcellacamara)
