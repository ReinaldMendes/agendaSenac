
# Agenda Senac

Agenda Senac é uma aplicação CRUD (Create, Read, Update, Delete) para gerenciar usuários e contatos. Este projeto foi desenvolvido utilizando PHP e estilizado com o framework Bootstrap.

## Funcionalidades

- **Gerenciamento de Usuários:**
  - Criar novos usuários
  - Listar usuários existentes
  - Editar informações de usuários
  - Deletar usuários

- **Gerenciamento de Contatos:**
  - Criar novos contatos
  - Listar contatos existentes
  - Editar informações de contatos
  - Deletar contatos

## Estrutura do Projeto

A tabela `contato` contém os seguintes atributos:

- **NOME**: Nome do contato
- **EMAIL**: Email do contato
- **TELEFONE**: Telefone do contato
- **CIDADE**: Cidade do contato
- **RUA**: Rua do contato
- **NÚMERO**: Número da residência do contato
- **BAIRRO**: Bairro do contato
- **CEP**: CEP do contato
- **PROFISSÃO**: Profissão do contato
- **FOTO**: Foto do contato
- **DATA NASC**: Data de nascimento do contato
- **AÇÕES**: Ações disponíveis para o contato (editar/deletar)

## Tecnologias Utilizadas

- **Linguagem de Programação**: PHP
- **Framework de Estilização**: Bootstrap

## Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina:

- [PHP](https://www.php.net/downloads)
- [Servidor Apache](https://httpd.apache.org/download.cgi) ou [XAMPP](https://www.apachefriends.org/download.html)
- [MySQL](https://www.mysql.com/downloads/) ou outro banco de dados relacional

## Como Rodar a Aplicação

1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/agenda-senac.git
   ```

2. Navegue até o diretório do projeto:
   ```bash
   cd agenda-senac
   ```

3. Configure o banco de dados:
   - Crie um banco de dados chamado `agenda_senac`.
   - Importe o arquivo `database.sql` localizado na raiz do projeto para o seu banco de dados.

4. Configure as credenciais do banco de dados:
   - No arquivo `config.php`, defina as credenciais do seu banco de dados.

5. Inicie o servidor Apache:
   - Se estiver usando o XAMPP, abra o painel de controle do XAMPP e inicie o Apache.
   - Se estiver usando outro servidor, certifique-se de que ele está configurado corretamente.

6. Acesse a aplicação:
   - Abra o navegador e digite `http://localhost/agenda-senac`.

## Contribuição

1. Faça um fork deste repositório.
2. Crie uma branch com a sua feature: `git checkout -b minha-feature`
3. Commit suas mudanças: `git commit -m 'Minha nova feature'`
4. Push para a branch: `git push origin minha-feature`
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

## Contato

Para mais informações, entre em contato pelo email: [reinald_30_2009@hotmail.com](mailto:reinald_30_2009@hotmail.com)

---

Feito com ❤️ por [Reinald Mendes](https://github.com/seu-usuario](https://github.com/ReinaldMendes)


